<?php

/**
 * Smoke-test Gemini vision menu extraction on real images.
 * php tests/manual/menu_vision_smoke.php
 */

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuVisionService;
use Illuminate\Http\UploadedFile;

$vision = app(MenuVisionService::class);
echo 'configured='.($vision->isAvailable() ? 'yes' : 'no').PHP_EOL;

$files = [
    storage_path('app/menu_ocr/diagnose/el-demshkey_menu_1.jpg'),
    storage_path('app/menu_ocr/diagnose/WhatsApp Image 2026-10-08 at 2.13.38 PM.jpeg'),
    storage_path('app/menu_ocr/diagnose/WhatsApp Image 2026-10-10 at 9.55.23 PM.jpeg'),
];

foreach ($files as $path) {
    if (! is_file($path)) {
        echo "MISSING {$path}\n";
        continue;
    }
    echo "\n========== ".basename($path)." ==========\n";
    $upload = new UploadedFile($path, basename($path), mime_content_type($path) ?: 'image/jpeg', null, true);
    $t0 = microtime(true);
    try {
        $parsed = $vision->extractFromImage($upload);
        $ms = (int) ((microtime(true) - $t0) * 1000);
        echo "model={$parsed['model']} time_ms={$ms}\n";
        echo 'categories: '.json_encode($parsed['categories'], JSON_UNESCAPED_UNICODE)."\n";
        echo 'products='.count($parsed['products']).' priced='.count(array_filter($parsed['products'], fn ($p) => $p['price'] !== null))."\n";
        foreach (array_slice($parsed['products'], 0, 15) as $p) {
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
