<?php

/**
 * Generate an Arabic menu PNG using a system TTF font when available.
 */

$outDir = __DIR__.'/fixtures';
if (! is_dir($outDir)) {
    mkdir($outDir, 0755, true);
}

$fontCandidates = [
    'C:\\Windows\\Fonts\\arial.ttf',
    'C:\\Windows\\Fonts\\tahoma.ttf',
    'C:\\Windows\\Fonts\\segoeui.ttf',
    'C:\\Windows\\Fonts\\tradbdo.ttf',
];
$font = null;
foreach ($fontCandidates as $candidate) {
    if (is_file($candidate)) {
        $font = $candidate;
        break;
    }
}

if (! $font || ! function_exists('imagettftext')) {
    fwrite(STDERR, "No TTF font / FreeType available for Arabic sample.\n");
    exit(1);
}

$w = 900;
$h = 1200;
$im = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($im, 255, 252, 245);
$fg = imagecolorallocate($im, 15, 15, 15);
$accent = imagecolorallocate($im, 30, 30, 30);
imagefilledrectangle($im, 0, 0, $w, $h, $bg);

$lines = [
    ['المشروبات', 28, true],
    ['قهوة عربية 1500', 22, false],
    ['شاي بالنعناع مع أعشاب 1000', 22, false],
    ['الطعام', 28, true],
    ['شاورما دجاج 3500', 22, false],
    ['فتوش 2000', 22, false],
];

$y = 80;
foreach ($lines as [$text, $size, $heading]) {
    // imagettftext draws LTR; Arabic shaping may be imperfect but often readable enough for OCR tests
    imagettftext($im, $size, 0, 60, $y, $heading ? $accent : $fg, $font, $text);
    $y += $heading ? 70 : 48;
}

$path = $outDir.'/menu_ar_clear.png';
imagepng($im, $path);
imagedestroy($im);
echo "Wrote {$path} using {$font}\n";
