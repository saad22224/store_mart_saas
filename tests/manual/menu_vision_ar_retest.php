<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuVisionService;
use Illuminate\Http\UploadedFile;

$vision = app(MenuVisionService::class);
$path = storage_path('app/menu_ocr/diagnose/el-demshkey_menu_1.jpg');
$upload = new UploadedFile($path, basename($path), 'image/jpeg', null, true);
$parsed = $vision->extractFromImage($upload);
echo "model={$parsed['model']}\n";
echo 'categories: '.json_encode($parsed['categories'], JSON_UNESCAPED_UNICODE)."\n";
echo 'products='.count($parsed['products']).' priced='.count(array_filter($parsed['products'], fn ($p) => $p['price'] !== null))."\n";
foreach ($parsed['products'] as $p) {
    echo sprintf(
        "  - %s | %s | %s | cat=%s\n",
        $p['name'],
        $p['price'] ?? 'NO_PRICE',
        $p['description'] ?: '-',
        $p['category_name'] ?? '-'
    );
}
echo "\n--- raw head ---\n";
echo substr($parsed['raw_text'], 0, 1800)."\n";
