<?php

/**
 * Manual smoke test for MenuParserService (no HTTP / no Tesseract required).
 * Run: php tests/manual/menu_parser_smoke.php
 */

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuParserService;

$parser = new MenuParserService();

$samples = [
    'arabic' => "المشروبات\nقهوة عربية 1500\nشاي بالنعناع\nمع أعشاب طازجة 1000\nالطعام\nشاورما دجاج 3500\n",
    'english' => "DRINKS\nArabic Coffee 3.50\nMint Tea with fresh herbs 2.00\nFOOD\nChicken Shawarma 7.50\n",
    'mixed' => "Beverages / المشروبات\nCappuccino كابتشينو 2500\nLatte لاتيه 3000\n",
    'missing_price' => "الحلويات\nكنافة نابلسية\nبقلاوة 2000\n",
    'multi_category' => "STARTERS\nHummus 4.00\nFattoush salad with crispy bread 5.50\nMAINS\nGrilled chicken plate 12.00\n",
];

foreach ($samples as $label => $text) {
    $result = $parser->parse($text);
    echo "=== {$label} ===\n";
    echo 'categories: '.json_encode($result['categories'], JSON_UNESCAPED_UNICODE)."\n";
    foreach ($result['products'] as $p) {
        echo sprintf(
            "- [%s] %s | %s | cat=%s | conf=%.2f%s\n",
            $p['needs_review'] ? 'REVIEW' : 'OK',
            $p['name'],
            $p['price'] === null ? 'NO_PRICE' : $p['price'],
            $p['category_name'] ?? '-',
            $p['confidence'],
            $p['description'] !== '' ? ' | desc='.$p['description'] : ''
        );
    }
    echo "\n";
}

echo "Done.\n";
