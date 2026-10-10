<?php

/**
 * End-to-end OCR → parse on real menu images (before/after comparison helper).
 * php tests/manual/real_menu_pipeline_test.php
 */

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuOcrService;
use App\Services\MenuParserService;
use Illuminate\Http\UploadedFile;

$ocr = new MenuOcrService();
$parser = new MenuParserService();

$files = [
    storage_path('app/menu_ocr/diagnose/el-demshkey_menu_1.jpg'),
    storage_path('app/menu_ocr/diagnose/WhatsApp Image 2026-10-08 at 2.13.38 PM.jpeg'),
    storage_path('app/menu_ocr/diagnose/WhatsApp Image 2026-10-10 at 9.55.23 PM.jpeg'),
];

echo 'OCR available: '.($ocr->isAvailable() ? 'yes' : 'no').PHP_EOL;
echo 'Languages: '.implode(', ', $ocr->availableLanguages()).PHP_EOL;
echo 'Tessdata: '.(is_dir(storage_path('app/tessdata_best')) && is_file(storage_path('app/tessdata_best/ara.traineddata')) ? 'best' : 'fast').PHP_EOL;

foreach ($files as $path) {
    if (! is_file($path)) {
        echo "MISSING {$path}\n";
        continue;
    }
    echo "\n========== ".basename($path)." ==========\n";
    $upload = new UploadedFile($path, basename($path), mime_content_type($path) ?: 'image/jpeg', null, true);
    $t0 = microtime(true);
    try {
        $raw = $ocr->extractText($upload);
        $parsed = $parser->parse($raw);
        $ms = (int) ((microtime(true) - $t0) * 1000);
        echo "time_ms={$ms}\n";
        echo "RAW (first 800 chars):\n".mb_substr($raw, 0, 800)."\n---\n";
        echo 'categories: '.json_encode($parsed['categories'], JSON_UNESCAPED_UNICODE)."\n";
        echo 'products='.count($parsed['products']).' priced='.count(array_filter($parsed['products'], fn ($p) => $p['price'] !== null))."\n";
        foreach ($parsed['products'] as $i => $p) {
            if ($i >= 20) {
                echo "  ...\n";
                break;
            }
            echo sprintf(
                "  - [%s] %s | %s | cat=%s\n",
                ! empty($p['needs_review']) ? 'REVIEW' : 'OK',
                $p['name'],
                $p['price'] ?? 'NO_PRICE',
                $p['category_name'] ?? '-'
            );
        }
    } catch (Throwable $e) {
        echo 'ERROR: '.$e->getMessage().PHP_EOL;
    }
}
