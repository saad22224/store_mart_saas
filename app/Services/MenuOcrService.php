<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Local Tesseract OCR (no external AI).
 * Pipeline: decode → OSD rotate → preprocess → multi-pass OCR → script-aware pick.
 */
class MenuOcrService
{
    protected int $timeoutSeconds = 90;

    public function isAvailable(): bool
    {
        return $this->resolveBinary() !== null;
    }

    public function availableLanguages(): array
    {
        $binary = $this->resolveBinary();
        if (! $binary) {
            return [];
        }

        $tessdata = $this->resolveTessdataDir();
        $cmd = $this->quote($binary).' --list-langs';
        if ($tessdata) {
            $cmd .= ' --tessdata-dir '.$this->quote($tessdata);
        }

        $output = [];
        $code = 0;
        @exec($cmd.' 2>&1', $output, $code);
        if ($code !== 0) {
            return [];
        }

        $langs = [];
        foreach ($output as $line) {
            $line = trim($line);
            if ($line === '' || stripos($line, 'list of available') !== false) {
                continue;
            }
            $langs[] = $line;
        }

        return $langs;
    }

    /**
     * Prefer tessdata_best, then storage/app/tessdata, then TESSDATA_PREFIX.
     */
    protected function resolveTessdataDir(): ?string
    {
        foreach ([
            storage_path('app/tessdata_best'),
            storage_path('app/tessdata'),
        ] as $dir) {
            if (is_dir($dir) && (is_file($dir.DIRECTORY_SEPARATOR.'eng.traineddata') || is_file($dir.DIRECTORY_SEPARATOR.'ara.traineddata'))) {
                return $dir;
            }
        }

        $configured = env('TESSDATA_PREFIX');
        if ($configured && is_dir($configured)) {
            return rtrim($configured, DIRECTORY_SEPARATOR);
        }

        return null;
    }

    /**
     * @throws RuntimeException
     */
    public function extractText(UploadedFile $file): string
    {
        $binary = $this->resolveBinary();
        if (! $binary) {
            throw new RuntimeException('ocr_not_installed');
        }

        $tmpDir = storage_path('app/menu_ocr');
        if (! is_dir($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (! in_array($ext, $allowed, true)) {
            throw new RuntimeException('ocr_unsupported_image');
        }

        $srcPath = $tmpDir.DIRECTORY_SEPARATOR.'src_'.uniqid('', true).'.'.$ext;
        // Copy (do not move) so re-tests and failed requests keep the upload temp/original intact
        $origin = $file->getRealPath() ?: $file->getPathname();
        if (! $origin || ! @copy($origin, $srcPath)) {
            $file->move(dirname($srcPath), basename($srcPath));
        }
        $workFiles = [];

        try {
            $oriented = $this->autoOrient($binary, $srcPath, $tmpDir);
            $workFiles[] = $oriented['path'];
            $scriptHint = $oriented['script']; // latin|arabic|unknown

            $prepared = $this->preprocessImage($oriented['path'], $tmpDir);
            if ($prepared !== $oriented['path']) {
                $workFiles[] = $prepared;
            }

            $candidates = $this->buildCandidates($this->availableLanguages(), $scriptHint);
            $bestText = '';
            $bestScore = -INF;
            $lastError = null;

            foreach ($candidates as $candidate) {
                try {
                    $text = $this->runTesseract($binary, $prepared, $candidate['langs'], $candidate['psm']);
                    $score = $this->scoreOcrText($text, $candidate['langs'], $scriptHint);
                    if ($score > $bestScore) {
                        $bestScore = $score;
                        $bestText = $text;
                    }
                } catch (RuntimeException $e) {
                    $lastError = $e;
                }
            }

            if (trim($bestText) === '') {
                throw $lastError ?: new RuntimeException('ocr_empty');
            }

            return $bestText;
        } finally {
            @unlink($srcPath);
            foreach ($workFiles as $f) {
                if ($f !== $srcPath) {
                    @unlink($f);
                }
            }
        }
    }

    /**
     * Use Tesseract OSD; rotate with GD. PHP imagerotate is CCW;
     * OSD "Rotate" is degrees clockwise → php = (360 - rotate) % 360.
     *
     * @return array{path: string, script: string}
     */
    protected function autoOrient(string $binary, string $path, string $tmpDir): array
    {
        $script = 'unknown';
        $rotateCw = 0;

        $tessdata = $this->resolveTessdataDir();
        $cmd = $this->quote($binary).' '.$this->quote($path).' stdout --psm 0';
        if ($tessdata && is_file($tessdata.DIRECTORY_SEPARATOR.'osd.traineddata')) {
            $cmd .= ' --tessdata-dir '.$this->quote($tessdata);
        } elseif (is_file('C:\\Program Files\\Tesseract-OCR\\tessdata\\osd.traineddata')) {
            $cmd .= ' --tessdata-dir '.$this->quote('C:\\Program Files\\Tesseract-OCR\\tessdata');
        }

        $out = [];
        $code = 0;
        @exec($cmd.' 2>&1', $out, $code);
        $blob = implode("\n", $out);
        if (preg_match('/Rotate:\s*(\d+)/i', $blob, $m)) {
            $rotateCw = (int) $m[1] % 360;
        }
        if (preg_match('/Script:\s*(\w+)/i', $blob, $m)) {
            $s = strtolower($m[1]);
            if (str_contains($s, 'arabic')) {
                $script = 'arabic';
            } elseif (str_contains($s, 'latin')) {
                $script = 'latin';
            }
        }

        if ($rotateCw === 0 || ! function_exists('imagecreatefromstring')) {
            return ['path' => $path, 'script' => $script];
        }

        $phpAngle = (360 - $rotateCw) % 360;
        if ($phpAngle === 0) {
            return ['path' => $path, 'script' => $script];
        }

        $raw = @file_get_contents($path);
        $img = $raw !== false ? @imagecreatefromstring($raw) : false;
        if (! $img) {
            return ['path' => $path, 'script' => $script];
        }

        $rotated = imagerotate($img, $phpAngle, 0);
        imagedestroy($img);
        if (! $rotated) {
            return ['path' => $path, 'script' => $script];
        }

        $outPath = $tmpDir.DIRECTORY_SEPARATOR.'orient_'.uniqid('', true).'.png';
        imagepng($rotated, $outPath);
        imagedestroy($rotated);

        return ['path' => $outPath, 'script' => $script];
    }

    /**
     * Upscale small menus, grayscale, contrast, white border.
     */
    protected function preprocessImage(string $path, string $tmpDir): string
    {
        if (! function_exists('imagecreatefromstring')) {
            return $path;
        }

        $raw = @file_get_contents($path);
        if ($raw === false) {
            return $path;
        }
        $img = @imagecreatefromstring($raw);
        if (! $img) {
            return $path;
        }

        $w = imagesx($img);
        $h = imagesy($img);
        $minSide = min($w, $h);
        $targetMin = 1600;
        if ($minSide < $targetMin) {
            $scale = $targetMin / $minSide;
            $nw = (int) round($w * $scale);
            $nh = (int) round($h * $scale);
            $up = imagecreatetruecolor($nw, $nh);
            imagecopyresampled($up, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
            imagedestroy($img);
            $img = $up;
            $w = $nw;
            $h = $nh;
        }

        imagefilter($img, IMG_FILTER_GRAYSCALE);
        imagefilter($img, IMG_FILTER_CONTRAST, -30);
        imagefilter($img, IMG_FILTER_BRIGHTNESS, 6);

        $border = 20;
        $canvas = imagecreatetruecolor($w + $border * 2, $h + $border * 2);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $w + $border * 2, $h + $border * 2, $white);
        imagecopy($canvas, $img, $border, $border, 0, 0, $w, $h);
        imagedestroy($img);

        $out = $tmpDir.DIRECTORY_SEPARATOR.'prep_'.uniqid('', true).'.png';
        imagepng($canvas, $out);
        imagedestroy($canvas);

        return $out;
    }

    /**
     * @return array<int, array{langs: string, psm: int}>
     */
    protected function buildCandidates(array $available, string $scriptHint): array
    {
        $hasAra = in_array('ara', $available, true);
        $hasEng = in_array('eng', $available, true);
        $langSets = [];

        if ($scriptHint === 'latin') {
            // Latin menus: eng only — ara+eng often injects RTL garbage
            if ($hasEng) {
                $langSets[] = 'eng';
            }
        } elseif ($scriptHint === 'arabic') {
            if ($hasAra) {
                $langSets[] = 'ara';
            }
            if ($hasAra && $hasEng) {
                $langSets[] = 'ara+eng';
            }
        } else {
            if ($hasEng) {
                $langSets[] = 'eng';
            }
            if ($hasAra) {
                $langSets[] = 'ara';
            }
            if ($hasAra && $hasEng) {
                $langSets[] = 'ara+eng';
            }
        }

        if (! $langSets) {
            $langSets[] = 'eng';
        }

        // PSM 4 (column) first for menus; then block / auto
        $psms = $scriptHint === 'latin' ? [4, 3, 6] : [4, 6, 3];
        $out = [];
        foreach ($langSets as $langs) {
            foreach ($psms as $psm) {
                $out[] = ['langs' => $langs, 'psm' => $psm];
            }
        }

        return $out;
    }

    protected function runTesseract(string $binary, string $imagePath, string $langs, int $psm): string
    {
        $tessdata = $this->resolveTessdataDir();
        $cmd = $this->quote($binary).' '.$this->quote($imagePath).' stdout -l '.$langs.
            ' --oem 1 --psm '.$psm.' -c preserve_interword_spaces=1';
        if ($tessdata) {
            $cmd .= ' --tessdata-dir '.$this->quote($tessdata);
        }

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        $process = proc_open($cmd, $descriptors, $pipes, null, null, ['bypass_shell' => false]);
        if (! is_resource($process)) {
            throw new RuntimeException('ocr_failed');
        }

        fclose($pipes[0]);
        stream_set_timeout($pipes[1], $this->timeoutSeconds);
        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        $exit = proc_close($process);

        if ($exit !== 0 && trim((string) $stdout) === '') {
            Log::warning('Menu OCR failed', ['exit' => $exit, 'stderr' => $stderr, 'langs' => $langs, 'psm' => $psm]);
            throw new RuntimeException('ocr_failed');
        }

        $text = trim((string) $stdout);
        if ($text === '') {
            throw new RuntimeException('ocr_empty');
        }

        return $text;
    }

    /**
     * Script-aware quality score — avoids preferring Arabic gibberish on Latin menus.
     */
    protected function scoreOcrText(string $text, string $langs, string $scriptHint): float
    {
        $arabic = preg_match_all('/\p{Arabic}/u', $text);
        $latin = preg_match_all('/[A-Za-z]/', $text);
        $letters = $arabic + $latin;
        if ($letters < 8) {
            return -100;
        }

        $score = 0.0;
        $score += min(80, $letters * 0.15);
        $score += preg_match_all('/\R/u', $text) * 0.5;

        $arRatio = $arabic / max(1, $letters);
        $latRatio = $latin / max(1, $letters);

        if ($langs === 'eng') {
            $score += $latRatio * 40;
            $score -= $arRatio * 50;
            if (preg_match('/\b(menu|bowl|salad|chicken|beef|drinks?|food|bowls)\b/i', $text)) {
                $score += 35;
            }
            // Prefer columnar segmentation when many dish titles appear
            if (preg_match_all('/\b\w+\s+bowl\b/i', $text) >= 2) {
                $score += 20;
            }
        } elseif ($langs === 'ara') {
            $score += $arRatio * 45;
            $score -= $latRatio * 25;
            if (preg_match('/\p{Arabic}{3,}/u', $text)) {
                $score += 15;
            }
        } else { // ara+eng
            // Prefer balanced or matching hint; penalize near-zero of both scripts' usefulness
            if ($scriptHint === 'latin') {
                $score += $latRatio * 30;
                $score -= max(0, $arRatio - 0.15) * 40;
            } elseif ($scriptHint === 'arabic') {
                $score += $arRatio * 35;
                $score -= max(0, $latRatio - 0.2) * 20;
            } else {
                $score += min($arRatio, $latRatio) * 20;
                $score += max($arRatio, $latRatio) * 15;
            }
        }

        // Sideways / garbage: many single-char lines
        $lines = preg_split('/\R/u', $text) ?: [];
        $short = 0;
        foreach ($lines as $line) {
            $t = trim($line);
            if ($t !== '' && mb_strlen($t) <= 2) {
                $short++;
            }
        }
        if (count($lines) > 0) {
            $score -= ($short / count($lines)) * 35;
        }

        // Bidi noise
        $score -= substr_count($text, "\u{200F}") * 1.5;
        $score -= substr_count($text, "\u{200E}") * 1.5;

        return $score;
    }

    protected function resolveBinary(): ?string
    {
        $configured = env('TESSERACT_PATH');
        if ($configured && is_file($configured)) {
            return $configured;
        }

        $candidates = [
            'C:\\Program Files\\Tesseract-OCR\\tesseract.exe',
            'C:\\Program Files (x86)\\Tesseract-OCR\\tesseract.exe',
            '/usr/bin/tesseract',
            '/usr/local/bin/tesseract',
        ];
        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        $whereOut = [];
        $code = 0;
        @exec('where tesseract 2>NUL', $whereOut, $code);
        if ($code === 0 && ! empty($whereOut[0]) && is_file(trim($whereOut[0]))) {
            return trim($whereOut[0]);
        }

        $which = [];
        $code = 0;
        @exec('which tesseract 2>/dev/null', $which, $code);
        if ($code === 0 && ! empty($which[0]) && is_file(trim($which[0]))) {
            return trim($which[0]);
        }

        return null;
    }

    protected function quote(string $path): string
    {
        return '"'.str_replace('"', '\"', $path).'"';
    }
}
