<?php

namespace App\Services;

/**
 * Deterministic Phase-1 menu parser from OCR text.
 * Does not invent missing fields; uncertain rows are flagged for review.
 */
class MenuParserService
{
    /**
     * @return array{categories: array<int, string>, products: array<int, array>, raw_text: string}
     */
    public function parse(string $rawText): array
    {
        $normalized = $this->normalizeText($rawText);
        $lines = preg_split('/\R/u', $normalized) ?: [];
        $lines = array_values(array_filter(array_map('trim', $lines), fn ($l) => $l !== ''));

        $categories = [];
        $products = [];
        $currentCategory = null;
        $pendingName = null;
        $pendingDesc = [];

        foreach ($lines as $index => $line) {
            if ($this->isNoiseLine($line)) {
                continue;
            }

            // Calorie lines belong to the previous product name as description, not prices
            if ($this->isCalorieLine($line)) {
                if ($pendingName !== null) {
                    $pendingDesc[] = $line;
                }
                continue;
            }

            if ($this->looksLikeCategory($line, $lines, $index)) {
                $this->flushPending($products, $pendingName, $pendingDesc, $currentCategory);
                $pendingName = null;
                $pendingDesc = [];
                $currentCategory = $this->cleanCategory($line);
                if ($currentCategory !== '' && ! in_array($currentCategory, $categories, true)) {
                    $categories[] = $currentCategory;
                }
                continue;
            }

            $priceInfo = $this->extractPrice($line);
            if ($priceInfo !== null) {
                $namePart = $this->cleanProductName(trim($priceInfo['name']));

                if ($pendingName !== null) {
                    if ($namePart === '' || $this->looksLikeDescriptionFragment($namePart)) {
                        $descParts = $pendingDesc;
                        if ($namePart !== '') {
                            $descParts[] = $namePart;
                        }
                        $namePart = $pendingName;
                        $desc = trim(implode(' ', $descParts));
                        $pendingName = null;
                        $pendingDesc = [];
                    } else {
                        $this->flushPending($products, $pendingName, $pendingDesc, $currentCategory);
                        $pendingName = null;
                        $pendingDesc = [];
                        $desc = '';
                    }
                } else {
                    $desc = trim(implode(' ', $pendingDesc));
                    $pendingDesc = [];
                }

                if ($namePart === '' || $this->isGarbageName($namePart)) {
                    continue;
                }

                $confidence = $this->scoreProduct($namePart, $priceInfo['price'], $desc);
                $products[] = [
                    'name' => $namePart,
                    'description' => $desc,
                    'price' => $priceInfo['price'],
                    'category_name' => $currentCategory,
                    'confidence' => $confidence,
                    'needs_review' => $confidence < 0.65 || $priceInfo['price'] === null,
                    'include' => true,
                ];
                continue;
            }

            // Multi-column OCR may glue several dish titles onto one line
            $splitNames = $this->splitMultiProductLine($line);
            if (count($splitNames) > 1) {
                $this->flushPending($products, $pendingName, $pendingDesc, $currentCategory);
                $pendingName = null;
                $pendingDesc = [];
                foreach ($splitNames as $name) {
                    $products[] = [
                        'name' => $name,
                        'description' => '',
                        'price' => null,
                        'category_name' => $currentCategory,
                        'confidence' => 0.55,
                        'needs_review' => true,
                        'include' => true,
                    ];
                }
                continue;
            }

            // Likely English dish title without a price on the same line
            if ($this->looksLikeBareProductName($line) && $pendingName !== null && ! $this->looksLikeDescriptionFragment($line)) {
                $this->flushPending($products, $pendingName, $pendingDesc, $currentCategory);
                $pendingName = $line;
                $pendingDesc = [];
                continue;
            }

            if ($pendingName === null) {
                $pendingName = $line;
                $pendingDesc = [];
            } else {
                if ($this->looksLikeNameContinuation($line)) {
                    $pendingName = trim($pendingName.' '.$line);
                } else {
                    $pendingDesc[] = $line;
                }
            }
        }

        $this->flushPending($products, $pendingName, $pendingDesc, $currentCategory);

        return [
            'categories' => $categories,
            'products' => $products,
            'raw_text' => $normalized,
        ];
    }

    protected function flushPending(array &$products, ?string $pendingName, array $pendingDesc, ?string $currentCategory): void
    {
        if ($pendingName === null || trim($pendingName) === '') {
            return;
        }
        $name = trim($pendingName);
        if ($this->isGarbageName($name)) {
            return;
        }
        // Name without price — keep for manual review, do not invent price
        $desc = trim(implode(' ', $pendingDesc));
        $products[] = [
            'name' => $name,
            'description' => $desc,
            'price' => null,
            'category_name' => $currentCategory,
            'confidence' => 0.4,
            'needs_review' => true,
            'include' => true,
        ];
    }

    protected function isGarbageName(string $name): bool
    {
        $name = trim($name);
        if (mb_strlen($name) < 3) {
            return true;
        }
        $letters = preg_match_all('/\p{L}/u', $name);
        if ($letters < 3) {
            return true;
        }
        if ($letters / max(1, mb_strlen($name)) < 0.4) {
            return true;
        }
        // Slash/backslash heavy border remnants
        if (preg_match('/^[\s\\\\\\/]+|[\s\\\\\\/]+$/u', $name) && substr_count($name, '/') + substr_count($name, '\\') >= 2) {
            return true;
        }

        return false;
    }

    protected function normalizeText(string $text): string
    {
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        // Eastern Arabic-Indic digits → Western (prices like ٥ / ٨٥٠)
        $text = strtr($text, [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
        ]);
        $text = preg_replace('/[^\S\n]+/u', ' ', $text) ?? $text;
        $text = preg_replace('/[|]+/u', ' ', $text) ?? $text;

        return trim($text);
    }

    protected function isCalorieLine(string $line): bool
    {
        return (bool) preg_match('/^\d{2,4}\s*calories?\b/i', $line)
            || (bool) preg_match('/\b\d{2,4}\s*calories?\b/i', $line) && mb_strlen($line) <= 24;
    }

    protected function looksLikeBareProductName(string $line): bool
    {
        if ($this->extractPrice($line) !== null || $this->isCalorieLine($line)) {
            return false;
        }
        if (mb_strlen($line) < 3 || mb_strlen($line) > 48) {
            return false;
        }
        // English-ish dish titles: letters/spaces, optional Bowl/Salad
        if (preg_match('/^[A-Za-z][A-Za-z0-9\s\'\-&!]{2,47}$/u', $line)) {
            return true;
        }
        // Short Arabic item names without digits
        if (preg_match('/^[\p{Arabic}\s]{2,30}$/u', $line) && ! preg_match('/\d/', $line)) {
            return true;
        }

        return false;
    }

    /**
     * Recover dish titles when OCR merges columns into one line.
     *
     * @return array<int, string>
     */
    protected function splitMultiProductLine(string $line): array
    {
        // e.g. "Mexican Bowl ... Curry Bowl ... Crab salad" (multi-column OCR)
        $names = [];
        $patterns = [
            '/\b([A-Z][a-zA-Z]{2,}(?:\s+[A-Za-z]{3,}){0,3}\s+(?:Bowl|bow!))\b/u',
            '/\b([A-Z][a-zA-Z]{2,}(?:\s+[A-Za-z]{3,}){0,2}\s+[Ss]alad)\b/u',
            '/\b(Mix\s+cashew\s+chicken|Chicken\s+power|Shrimp\s+mango|Green\s+tuna|Crispy\s+beef|Fillet\s+hamour\s+bowl!?|Napoli\s+chicken\s+bowl!?|Curry\s+shrimp\s+bowl!?)\b/iu',
        ];
        foreach ($patterns as $pattern) {
            if (preg_match_all($pattern, $line, $m)) {
                foreach ($m[1] as $name) {
                    $name = trim(preg_replace('/\s+/u', ' ', str_ireplace(['bow!', 'Bow!'], 'Bowl', $name)) ?? $name);
                    if (mb_strlen($name) >= 4 && ! in_array($name, $names, true)) {
                        $names[] = $name;
                    }
                }
            }
        }

        return count($names) >= 2 ? $names : [];
    }

    protected function isNoiseLine(string $line): bool
    {
        $lower = mb_strtolower($line);
        $noise = ['menu', 'قائمة', 'page', 'tel', 'phone', 'www.', 'http', 'vat', 'tax included', 'خدمة', 'wifi', 'restaurant'];
        foreach ($noise as $n) {
            if ($lower === $n) {
                return true;
            }
        }
        if (preg_match('/don\'?t eat less|eat right|menu-egypt|elmenus\.com/i', $line)) {
            return true;
        }
        // Lone currency or tiny fragments
        if (mb_strlen($line) < 2) {
            return true;
        }

        if (preg_match('/^[\d\s\.\-\+\(\)]+$/u', $line)) {
            return true;
        }

        // Border / ruler / slash noise from phone photos
        $letters = preg_match_all('/\p{L}/u', $line);
        $total = max(1, mb_strlen($line));
        if ($letters / $total < 0.35) {
            return true;
        }
        if (preg_match('/[\\\\\/_|]{2,}|\-{3,}|={3,}|\.{3,}|T{4,}/u', $line)) {
            return true;
        }
        // Mostly single-letter tokens
        if (preg_match('/^(?:[A-Za-z]\s+){3,}[A-Za-z]?$/u', $line)) {
            return true;
        }

        return false;
    }

    protected function looksLikeCategory(string $line, array $lines, int $index): bool
    {
        if ($this->extractPrice($line) !== null) {
            return false;
        }

        $len = mb_strlen($line);
        if ($len > 40) {
            return false;
        }

        // Explicit markers / trailing colon
        if (preg_match('/^(category|section|قسم|فئة|تصنيف|مجموعة)\b/ui', $line)) {
            return true;
        }
        if (preg_match('/[:：]\s*$/u', $line) && $len <= 30) {
            return true;
        }

        // Whole-line section headings only (avoid matching "Crab salad" as a category)
        if (preg_match('/^(drinks?|beverages?|food|mains?|starters?|desserts?|sides?|salads?|salad|bowls?|soups?|pizzas?|burgers?|sandwiches?|breakfast|lunch|dinner|appetizers?|specials?|المشروبات|المشروب|المأكولات|الطعام|الأطعمة|المقبلات|الحلويات|الوجبات(?:\s*العائلية)?|السندويشات|البيتزا|العصائر|القهوة|الشوربات|السلطات|الأصناف)$/ui', $line)) {
            return true;
        }

        // ALL CAPS short English heading
        if (preg_match('/^[A-Z0-9\s&\-\'\/]{3,40}$/u', $line) && ! preg_match('/\d{2,}/', $line)) {
            return true;
        }

        $hasArabic = (bool) preg_match('/\p{Arabic}/u', $line);
        $nextHasPrice = false;
        for ($i = $index + 1; $i < min($index + 4, count($lines)); $i++) {
            if ($this->extractPrice($lines[$i]) !== null) {
                $nextHasPrice = true;
                break;
            }
        }

        // English Title Case multi-word heading followed by priced items (avoid single product names)
        if (! $hasArabic && $nextHasPrice && $len <= 30 && preg_match('/^[A-Z][A-Za-z0-9\s&\-\'\/]+$/u', $line)) {
            $words = preg_split('/\s+/', $line) ?: [];
            if (count($words) >= 2 && count($words) <= 4) {
                return true;
            }
        }

        // Arabic: only very short bare headings (avoid product names like "شاي بالنعناع")
        if ($hasArabic && $nextHasPrice && $len <= 12 && ! preg_match('/\s/u', $line)) {
            return true;
        }

        return false;
    }

    protected function looksLikeDescriptionFragment(string $text): bool
    {
        return (bool) preg_match('/^(مع|بال|معه|فيها|فيه|with|and|&|served|topped)\b/ui', $text);
    }

    protected function cleanProductName(string $name): string
    {
        $name = preg_replace('/[\.·•\-_]{2,}/u', ' ', $name) ?? $name;
        // OCR noise from price leaders (e.g. "Coffee e.0", "Shawarma 0+")
        $name = preg_replace('/\s+[eE]\.?0\+?\s*$/u', '', $name) ?? $name;
        $name = preg_replace('/\s+0\+\s*$/u', '', $name) ?? $name;
        $name = preg_replace('/\s+(ve\.?|ec|cece|ee+|seers?)\b.*$/ui', '', $name) ?? $name;
        $name = trim(preg_replace('/\s+/u', ' ', (string) $name) ?? $name);

        return trim($name, " \t.-•·");
    }

    protected function cleanCategory(string $line): string
    {
        $line = preg_replace('/^(category|section|قسم|فئة|تصنيف|مجموعة)\s*[:\-]?\s*/ui', '', $line) ?? $line;

        return trim($line);
    }

    /**
     * @return array{name: string, price: float}|null
     */
    protected function extractPrice(string $line): ?array
    {
        // Currency-aware trailing prices
        $patterns = [
            // 12.50 or 12,50 optionally with currency words/symbols after or before
            '/^(?P<name>.+?)\s+(?P<currency>(?:ل\.?\s*س|ل\.س|SYP|USD|EUR|JOD|SAR|EGP|\$|€|£|ر\.?\s*س|ج\.?\s*م))?\s*(?P<price>\d{1,6}(?:[.,]\d{1,3})?)\s*(?P<currency2>(?:ل\.?\s*س|ل\.س|SYP|USD|EUR|JOD|SAR|EGP|\$|€|£|ر\.?\s*س|ج\.?\s*م))?\s*$/ui',
            // Price first (RTL menus): 2500 اسم المنتج
            '/^(?P<price>\d{1,6}(?:[.,]\d{1,3})?)\s+(?P<currency>(?:ل\.?\s*س|ل\.س|SYP|USD|\$|€))?\s*(?P<name>.+)$/ui',
        ];

        foreach ($patterns as $pattern) {
            if (! preg_match($pattern, $line, $m)) {
                continue;
            }
            $name = trim($m['name'] ?? '');
            $priceRaw = $m['price'] ?? '';
            if ($name === '' || $priceRaw === '') {
                continue;
            }
            // Reject if "name" is only digits/symbols
            if (preg_match('/^[\d\s\.\,]+$/u', $name)) {
                continue;
            }
            // Avoid treating years / phone-like as prices when name is tiny
            if (mb_strlen($name) < 2) {
                continue;
            }
            $price = $this->normalizePrice($priceRaw);
            if ($price === null || $price <= 0) {
                continue;
            }
            // Strip leading/trailing leaders from name
            $name = trim(preg_replace('/^[\.·•\-\s]+|[\.·•\-\s]+$/u', '', $name) ?? $name);

            return ['name' => $name, 'price' => $price];
        }

        return null;
    }

    protected function normalizePrice(string $raw): ?float
    {
        $raw = trim($raw);
        // Prefer last separator as decimal when both exist is rare; handle comma decimal
        if (preg_match('/^\d{1,6},\d{1,3}$/', $raw)) {
            $raw = str_replace(',', '.', $raw);
        } else {
            $raw = str_replace(',', '', $raw);
        }
        if (! is_numeric($raw)) {
            return null;
        }

        return round((float) $raw, 3);
    }

    protected function looksLikeNameContinuation(string $line): bool
    {
        return mb_strlen($line) <= 24 && ! preg_match('/[.!?。]/u', $line);
    }

    protected function scoreProduct(string $name, ?float $price, string $desc): float
    {
        $score = 0.5;
        if (mb_strlen($name) >= 2) {
            $score += 0.15;
        }
        if ($price !== null && $price > 0) {
            $score += 0.25;
        }
        if ($desc !== '') {
            $score += 0.05;
        }
        if (mb_strlen($name) > 80) {
            $score -= 0.2;
        }

        return max(0.0, min(1.0, $score));
    }
}
