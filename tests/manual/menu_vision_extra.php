<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuVisionService;
use Illuminate\Http\UploadedFile;

$vision = app(MenuVisionService::class);

$files = [
    storage_path('app/menu_ocr/diagnose/menu_en_clear/prep_upscale.png'),
    storage_path('app/menu_ocr/diagnose/menu_ar_clear/prep_upscale.png'),
    storage_path('app/menu_ocr/diagnose/download.png'),
];

foreach ($files as $path) {
    if (! is_file($path)) {
        echo "MISSING {$path}\n";
        continue;
    }
    echo "\n========== ".basename(dirname($path)).'/'.basename($path)." ==========\n";
    $upload = new UploadedFile($path, basename($path), mime_content_type($path) ?: 'image/png', null, true);
    try {
        $parsed = $vision->extractFromImage($upload);
        echo "model={$parsed['model']}\n";
        echo 'categories: '.json_encode($parsed['categories'], JSON_UNESCAPED_UNICODE)."\n";
        echo 'products='.count($parsed['products']).' priced='.count(array_filter($parsed['products'], fn ($p) => $p['price'] !== null))."\n";
        foreach (array_slice($parsed['products'], 0, 12) as $p) {
            echo sprintf(
                "  - %s | %s | cat=%s\n",
                $p['name'],
                $p['price'] ?? 'NO_PRICE',
                $p['category_name'] ?? '-'
            );
        }
    } catch (Throwable $e) {
        echo 'ERROR: '.$e->getMessage().PHP_EOL;
    }
}

// Invalid MIME
$tmp = tempnam(sys_get_temp_dir(), 'mnu');
file_put_contents($tmp, 'not-an-image');
try {
    $bad = new UploadedFile($tmp, 'x.txt', 'text/plain', null, true);
    $vision->extractFromImage($bad);
    echo "invalid_mime=UNEXPECTED_OK\n";
} catch (Throwable $e) {
    echo 'invalid_mime='.$e->getMessage().PHP_EOL;
}
@unlink($tmp);

// Bad JSON path via normalize-like decode is covered by service; skip live API fail injection.
echo "done\n";
