<?php

/**
 * OCR smoke test against synthetic/real menu images.
 * Requires Tesseract installed. Run: php tests/manual/menu_ocr_smoke.php
 */

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuOcrService;
use App\Services\MenuParserService;
use Illuminate\Http\UploadedFile;

$ocr = new MenuOcrService();
$parser = new MenuParserService();

echo 'OCR available: '.($ocr->isAvailable() ? 'yes' : 'no').PHP_EOL;
echo 'Languages: '.implode(', ', $ocr->availableLanguages()).PHP_EOL;

if (! $ocr->isAvailable()) {
    fwrite(STDERR, "Tesseract not found. Install UB-Mannheim Tesseract-OCR and optionally set TESSERACT_PATH in .env\n");
    exit(2);
}

$fixtureDir = __DIR__.'/fixtures';
if (! is_dir($fixtureDir) || count(glob($fixtureDir.'/*.png') ?: []) === 0) {
    passthru('php '.escapeshellarg(__DIR__.'/generate_menu_samples.php'));
}

$files = glob($fixtureDir.'/*.{png,jpg,jpeg,webp}', GLOB_BRACE) ?: [];
if (! $files) {
    fwrite(STDERR, "No fixture images in {$fixtureDir}\n");
    exit(1);
}

foreach ($files as $path) {
    echo "\n=== ".basename($path)." ===\n";
    $upload = new UploadedFile($path, basename($path), mime_content_type($path) ?: 'image/png', null, true);
    try {
        $text = $ocr->extractText($upload);
        echo "RAW:\n{$text}\n";
        $parsed = $parser->parse($text);
        echo 'categories: '.json_encode($parsed['categories'], JSON_UNESCAPED_UNICODE)."\n";
        echo 'products: '.count($parsed['products'])."\n";
        foreach ($parsed['products'] as $p) {
            echo sprintf(
                "- %s | %s | %s\n",
                $p['name'],
                $p['price'] ?? 'NO_PRICE',
                $p['category_name'] ?? '-'
            );
        }
    } catch (Throwable $e) {
        echo 'ERROR: '.$e->getMessage().PHP_EOL;
    }
}

echo "\nDone.\n";
