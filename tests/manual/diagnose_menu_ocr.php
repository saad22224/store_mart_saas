<?php

/**
 * Compare Tesseract configs / preprocessing on fixture images.
 * Separates RAW OCR from structured parse.
 *
 * Usage:
 *   php tests/manual/diagnose_menu_ocr.php
 *   php tests/manual/diagnose_menu_ocr.php path/to/menu1.jpg path/to/menu2.png
 */

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\MenuParserService;

$binary = 'C:\\Program Files\\Tesseract-OCR\\tesseract.exe';
if (! is_file($binary)) {
    fwrite(STDERR, "Tesseract not found\n");
    exit(2);
}

$tessdata = storage_path('app/tessdata');
$parser = new MenuParserService();
$outDir = storage_path('app/menu_ocr/diagnose');
if (! is_dir($outDir)) {
    mkdir($outDir, 0755, true);
}

$inputs = array_slice($argv, 1);
if (! $inputs) {
    $fixtureDir = __DIR__.'/fixtures';
    if (! is_dir($fixtureDir) || ! glob($fixtureDir.'/*.{png,jpg,jpeg,webp}', GLOB_BRACE)) {
        passthru('php '.escapeshellarg(__DIR__.'/generate_menu_samples.php'));
        passthru('php '.escapeshellarg(__DIR__.'/generate_arabic_menu.php'));
    }
    $inputs = glob($fixtureDir.'/*.{png,jpg,jpeg,webp}', GLOB_BRACE) ?: [];
}

if (! $inputs) {
    fwrite(STDERR, "No images. Pass real menu image paths as arguments.\n");
    exit(1);
}

function preprocessVariants(string $src, string $outDir): array
{
    $variants = ['raw' => $src];
    if (! function_exists('imagecreatefromstring')) {
        return $variants;
    }
    $raw = file_get_contents($src);
    $img = @imagecreatefromstring($raw);
    if (! $img) {
        return $variants;
    }
    $w = imagesx($img);
    $h = imagesy($img);

    // current production: gray + contrast
    $g = imagecreatetruecolor($w, $h);
    imagecopy($g, $img, 0, 0, 0, 0, $w, $h);
    imagefilter($g, IMG_FILTER_GRAYSCALE);
    imagefilter($g, IMG_FILTER_CONTRAST, -15);
    $p1 = $outDir.'/prep_current.png';
    imagepng($g, $p1);
    imagedestroy($g);
    $variants['current_gray_contrast'] = $p1;

    // upscale 2x + gray + stronger contrast + border
    $nw = max(1200, $w * 2);
    $nh = (int) round($h * ($nw / $w));
    $up = imagecreatetruecolor($nw, $nh);
    imagecopyresampled($up, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
    imagefilter($up, IMG_FILTER_GRAYSCALE);
    imagefilter($up, IMG_FILTER_CONTRAST, -35);
    imagefilter($up, IMG_FILTER_BRIGHTNESS, 8);
    $border = 24;
    $canvas = imagecreatetruecolor($nw + $border * 2, $nh + $border * 2);
    $white = imagecolorallocate($canvas, 255, 255, 255);
    imagefilledrectangle($canvas, 0, 0, $nw + $border * 2, $nh + $border * 2, $white);
    imagecopy($canvas, $up, $border, $border, 0, 0, $nw, $nh);
    $p2 = $outDir.'/prep_upscale.png';
    imagepng($canvas, $p2);
    imagedestroy($up);
    imagedestroy($canvas);
    $variants['upscale_gray_border'] = $p2;

    imagedestroy($img);

    return $variants;
}

function runTess(string $binary, string $tessdata, string $image, string $langs, int $psm): array
{
    $cmd = '"'.$binary.'" "'.$image.'" stdout -l '.$langs.' --oem 1 --psm '.$psm.
        ' -c preserve_interword_spaces=1 --tessdata-dir "'.$tessdata.'" 2>&1';
    $out = [];
    $code = 0;
    exec($cmd, $out, $code);
    // tesseract may write warnings to stdout mixed; keep full text
    $text = trim(implode("\n", $out));
    // strip common stderr lines if mixed
    $lines = preg_split('/\R/u', $text) ?: [];
    $clean = [];
    foreach ($lines as $line) {
        if (preg_match('/^(Estimating|Warning|Tesseract|Detected|Image too)/i', $line)) {
            continue;
        }
        $clean[] = $line;
    }
    $text = trim(implode("\n", $clean));

    return ['exit' => $code, 'text' => $text, 'chars' => mb_strlen($text)];
}

function scoreLikeProduction(string $text): int
{
    $score = 0;
    $score += preg_match_all('/\d{1,6}(?:[.,]\d{1,3})?/', $text) * 3;
    $score += preg_match_all('/\p{L}{2,}/u', $text);
    $score -= substr_count($text, "\u{200F}") * 2;
    $lines = preg_split('/\R/u', $text) ?: [];
    $score += count(array_filter($lines, fn ($l) => trim($l) !== ''));

    return $score;
}

$langsList = ['eng', 'ara', 'ara+eng'];
$psms = [3, 4, 6];

foreach ($inputs as $input) {
    if (! is_file($input)) {
        echo "MISSING: {$input}\n";
        continue;
    }
    $base = pathinfo($input, PATHINFO_FILENAME);
    $sampleOut = $outDir.'/'.$base;
    if (! is_dir($sampleOut)) {
        mkdir($sampleOut, 0755, true);
    }

    echo "\n========== {$base} ==========\n";
    echo 'file='.$input.' size='.filesize($input)."\n";
    $info = @getimagesize($input);
    if ($info) {
        echo "dims={$info[0]}x{$info[1]} mime={$info['mime']}\n";
    }

    $variants = preprocessVariants($input, $sampleOut);
    $report = [];

    foreach ($variants as $vName => $path) {
        foreach ($langsList as $langs) {
            foreach ($psms as $psm) {
                $key = "{$vName}|{$langs}|psm{$psm}";
                $res = runTess($binary, $tessdata, $path, $langs, $psm);
                $parsed = $parser->parse($res['text']);
                $priced = count(array_filter($parsed['products'], fn ($p) => $p['price'] !== null));
                $row = [
                    'key' => $key,
                    'exit' => $res['exit'],
                    'chars' => $res['chars'],
                    'prod_score' => scoreLikeProduction($res['text']),
                    'products' => count($parsed['products']),
                    'priced' => $priced,
                    'categories' => count($parsed['categories']),
                    'raw' => $res['text'],
                    'parsed' => $parsed,
                ];
                $report[] = $row;
            }
        }
    }

    usort($report, fn ($a, $b) => ($b['priced'] * 100 + $b['prod_score']) <=> ($a['priced'] * 100 + $a['prod_score']));

    echo "--- Top configs by priced products + score ---\n";
    foreach (array_slice($report, 0, 8) as $row) {
        echo sprintf(
            "%-42s exit=%d chars=%d score=%d products=%d priced=%d cats=%d\n",
            $row['key'],
            $row['exit'],
            $row['chars'],
            $row['prod_score'],
            $row['products'],
            $row['priced'],
            $row['categories']
        );
    }

    // Current production-like: current prep + eng/ara+eng score pick + psm6
    $prodCandidates = array_values(array_filter($report, function ($r) {
        return str_starts_with($r['key'], 'current_gray_contrast|') && str_contains($r['key'], '|psm6');
    }));
    usort($prodCandidates, fn ($a, $b) => $b['prod_score'] <=> $a['prod_score']);
    $current = $prodCandidates[0] ?? null;

    $best = $report[0] ?? null;
    echo "\n--- CURRENT-LIKE pick ---\n";
    if ($current) {
        echo $current['key']."\nRAW:\n".$current['raw']."\n";
        echo "PARSED products:\n";
        foreach ($current['parsed']['products'] as $p) {
            echo sprintf("  - %s | %s | %s\n", $p['name'], $p['price'] ?? 'NO_PRICE', $p['category_name'] ?? '-');
        }
    }
    echo "\n--- BEST-IN-GRID pick ---\n";
    if ($best) {
        echo $best['key']."\nRAW:\n".$best['raw']."\n";
        echo "PARSED products:\n";
        foreach ($best['parsed']['products'] as $p) {
            echo sprintf("  - %s | %s | %s\n", $p['name'], $p['price'] ?? 'NO_PRICE', $p['category_name'] ?? '-');
        }
    }

    file_put_contents(
        $sampleOut.'/report.json',
        json_encode([
            'file' => $input,
            'current_like' => $current,
            'best' => $best,
            'all_keys_summary' => array_map(fn ($r) => [
                'key' => $r['key'],
                'score' => $r['prod_score'],
                'products' => $r['products'],
                'priced' => $r['priced'],
            ], $report),
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
    );
}

echo "\nReports written under {$outDir}\n";
echo "NOTE: Synthetic Arabic PNGs are NOT representative (no Arabic shaping). Provide real menu photos.\n";
