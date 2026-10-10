<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use RuntimeException;

/**
 * Menu image → structured products via Gemini Vision (same models/keys as Support).
 * Does not use Tesseract.
 */
class MenuVisionService
{
    public function __construct(
        protected GeminiClient $gemini
    ) {
    }

    public function isAvailable(): bool
    {
        return $this->gemini->isConfigured();
    }

    /**
     * @return array{categories: array<int, string>, products: array<int, array>, raw_text: string, model: string}
     *
     * @throws RuntimeException
     */
    public function extractFromImage(UploadedFile $file): array
    {
        if (! $this->isAvailable()) {
            throw new RuntimeException('gemini_not_configured');
        }

        $mime = $this->resolveMime($file);
        $bytes = file_get_contents($file->getRealPath() ?: $file->getPathname());
        if ($bytes === false || $bytes === '') {
            throw new RuntimeException('menu_image_unreadable');
        }

        // Soft size guard for API (~4MB inline is comfortable; reject huge payloads)
        if (strlen($bytes) > 8 * 1024 * 1024) {
            throw new RuntimeException('menu_image_too_large');
        }

        $base64 = base64_encode($bytes);
        // Clear binary from memory ASAP
        unset($bytes);

        $system = <<<'PROMPT'
You are a restaurant menu extraction engine. Analyze the provided menu IMAGE only.
Return STRICT JSON (no markdown, no commentary) with this exact schema:
{
  "categories": ["string"],
  "products": [
    {
      "name": "string",
      "description": "string",
      "price": number|null,
      "price_text": "string|null",
      "category": "string|null",
      "needs_review": boolean,
      "price_note": "string|null"
    }
  ]
}

Rules:
- Extract only what is visible in the image. Never invent products, prices, or categories.
- Support Arabic, English, and mixed menus. Preserve original wording and category headings.
- Arabic-Indic digits MUST be converted carefully: ٠=0 ١=1 ٢=2 ٣=3 ٤=4 ٥=5 ٦=6 ٧=7 ٨=8 ٩=9.
  Examples: ٨٥٠ => 850, ٣٥٠ => 350, ٣٤٠ => 340, ٥٢٠ => 520, ٣٠ => 30, ٤٠ => 40. Never drop trailing zeros.
- price is a Western-digit number or null. ALSO set price_text to the digits as seen (after conversion), e.g. "850" or "30".
- RTL menus often put the price LEFT of the item name — still associate it with that item.
- Two size columns (س/ك or S/K): set price to the smaller/first column value and price_note to both, e.g. "س:30 ك:40".
- Single large bundle prices (family meals) go in price (full value, e.g. 850 not 85).
- Do NOT treat grams, calories, phone numbers, QR codes, or quantity prefixes (١ك, 1/2) as prices.
- If a field is unclear, leave it empty/null and set needs_review=true.
- Ignore watermarks, logos, and footer marketing text unless they are real menu items.
- categories = distinct section headings on the menu.
PROMPT;

        $userText = 'Extract all menu categories and products from this image into the required JSON schema. '
            .'Read price columns carefully (Eastern Arabic digits and س/ك size columns). '
            .'Never invent a price. Prefer null over a guessed value. Never use 0 unless the menu literally shows free/0.';

        $result = $this->gemini->generateContent(
            [
                ['text' => $userText],
                [
                    'inline_data' => [
                        'mime_type' => $mime,
                        'data' => $base64,
                    ],
                ],
            ],
            $system,
            [
                'temperature' => 0.1,
                'maxOutputTokens' => 8192,
                'responseMimeType' => 'application/json',
            ],
            120
        );

        unset($base64);

        $decoded = $this->decodeJson($result['text']);
        $normalized = $this->normalizePayload($decoded);

        if ($normalized['products'] === []) {
            throw new RuntimeException('menu_import_no_products');
        }

        $normalized['raw_text'] = json_encode($decoded, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?: '';
        $normalized['model'] = $result['model'];

        return $normalized;
    }

    protected function resolveMime(UploadedFile $file): string
    {
        $mime = strtolower((string) ($file->getMimeType() ?: ''));
        $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (in_array($mime, $allowed, true)) {
            return $mime === 'image/jpg' ? 'image/jpeg' : $mime;
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: '');
        return match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            default => throw new RuntimeException('ocr_unsupported_image'),
        };
    }

    /**
     * @return array<string, mixed>
     */
    protected function decodeJson(string $text): array
    {
        $text = trim($text);
        if (preg_match('/```(?:json)?\s*(\{.*?\})\s*```/is', $text, $m)) {
            $text = $m[1];
        }
        // Strip BOM / leading junk before first {
        $start = strpos($text, '{');
        $end = strrpos($text, '}');
        if ($start === false || $end === false || $end <= $start) {
            throw new RuntimeException('gemini_bad_json');
        }
        $text = substr($text, $start, $end - $start + 1);

        $data = json_decode($text, true);
        if (! is_array($data)) {
            throw new RuntimeException('gemini_bad_json');
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array{categories: array<int, string>, products: array<int, array>}
     */
    protected function normalizePayload(array $data): array
    {
        $categories = [];
        foreach ($data['categories'] ?? [] as $cat) {
            $name = trim((string) $cat);
            if ($name !== '' && ! in_array($name, $categories, true)) {
                $categories[] = mb_substr($name, 0, 120);
            }
        }

        $products = [];
        foreach ($data['products'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $name = trim((string) ($row['name'] ?? ''));
            if ($name === '') {
                continue;
            }

            $priceNote = trim((string) ($row['price_note'] ?? ''));
            $priceText = trim((string) ($row['price_text'] ?? ''));
            $price = $this->normalizePrice($row['price'] ?? null);
            // Prefer price_text when numeric price looks truncated vs a longer digit string
            $fromText = $priceText !== '' ? $this->normalizePrice($priceText) : null;
            if ($fromText !== null) {
                if ($price === null || ($fromText >= 100 && $price < 100 && abs($fromText - $price * 10) < 1)) {
                    $price = $fromText;
                } elseif ($price === null) {
                    $price = $fromText;
                }
            }
            if ($price === null && $priceNote !== '') {
                $price = $this->normalizePrice($priceNote);
            }

            $description = trim((string) ($row['description'] ?? ''));
            if ($priceNote !== '') {
                $description = trim($description === '' ? $priceNote : $description.' | '.$priceNote);
            }

            $category = trim((string) ($row['category'] ?? ''));
            if ($category !== '' && ! in_array($category, $categories, true)) {
                $categories[] = mb_substr($category, 0, 120);
            }

            $needsReview = ! empty($row['needs_review']) || $price === null || $name === '';

            $products[] = [
                'name' => mb_substr($name, 0, 190),
                'description' => mb_substr($description, 0, 5000),
                'price' => $price,
                'category_name' => $category !== '' ? mb_substr($category, 0, 120) : null,
                'confidence' => $needsReview ? 0.5 : 0.9,
                'needs_review' => $needsReview,
                'include' => true,
            ];
        }

        return [
            'categories' => $categories,
            'products' => $products,
        ];
    }

    /**
     * Normalize a price value or pull the first plausible number from a note string.
     */
    protected function normalizePrice(mixed $price): ?float
    {
        if ($price === null || $price === '' || $price === false) {
            return null;
        }

        if (is_string($price)) {
            $price = strtr($price, [
                '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
                '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
            ]);
            if (preg_match('/(\d+(?:[.,]\d+)?)/u', $price, $m)) {
                $price = str_replace(',', '.', $m[1]);
            } else {
                return null;
            }
        }

        if (! is_numeric($price)) {
            return null;
        }

        $value = round((float) $price, 3);

        // 0 is almost never a real printed menu price; treat as missing (avoids ٥→0 misreads)
        return $value > 0 ? $value : null;
    }
}
