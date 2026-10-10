<?php

/**
 * Generate simple synthetic menu images (GD) for OCR testing.
 * Run: php tests/manual/generate_menu_samples.php
 */

$outDir = __DIR__.'/fixtures';
if (! is_dir($outDir)) {
    mkdir($outDir, 0755, true);
}

function makeMenuPng(string $path, array $lines, int $w = 800, int $h = 1100): void
{
    $im = imagecreatetruecolor($w, $h);
    $bg = imagecolorallocate($im, 255, 252, 245);
    $fg = imagecolorallocate($im, 20, 20, 20);
    $muted = imagecolorallocate($im, 80, 80, 80);
    imagefilledrectangle($im, 0, 0, $w, $h, $bg);

    $y = 40;
    foreach ($lines as $line) {
        $isHeading = ! empty($line['heading']);
        $text = $line['text'];
        // Built-in GD font (Latin only). Arabic will not render correctly with imagestring.
        imagestring($im, $isHeading ? 5 : 4, 40, $y, $text, $isHeading ? $fg : $muted);
        $y += $isHeading ? 40 : 28;
    }

    imagepng($im, $path);
    imagedestroy($im);
}

makeMenuPng($outDir.'/menu_en_clear.png', [
    ['text' => 'DRINKS', 'heading' => true],
    ['text' => 'Arabic Coffee ................ 3.50'],
    ['text' => 'Mint Tea with fresh herbs .... 2.00'],
    ['text' => 'FOOD', 'heading' => true],
    ['text' => 'Chicken Shawarma ............. 7.50'],
    ['text' => 'Grilled Halloumi ............. 6.00'],
]);

makeMenuPng($outDir.'/menu_en_missing.png', [
    ['text' => 'DESSERTS', 'heading' => true],
    ['text' => 'Kunafa'],
    ['text' => 'Baklava ...................... 4.00'],
]);

// Intentionally low quality / small
makeMenuPng($outDir.'/menu_en_blurry.png', [
    ['text' => 'STARTERS', 'heading' => true],
    ['text' => 'Hummus 4.00'],
    ['text' => 'Fattoush 5.50'],
], 320, 240);

echo "Wrote samples to {$outDir}\n";
