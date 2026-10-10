<?php

$path = __DIR__.'/../../resources/views/front/theme/footer.blade.php';
$lines = file($path);
$out = [];
$i = 0;
$n = count($lines);

// Pass 1: rebuild features switch — keep T16 empty, drop dead false branch, keep 17/else
while ($i < $n) {
    $line = $lines[$i];

    // Start of file: template 16 features
    if ($i === 0 && str_contains($line, 'template == 16)')) {
        $out[] = "@if (helper::appdata(@\$storeinfo->id)->template == 16)\n";
        $out[] = "    {{-- Theme 16: no features strip --}}\n";
        // Skip until @elseif template == 17
        $i++;
        while ($i < $n && ! preg_match('/@elseif \(helper::appdata\(@\$storeinfo->id\)->template == 17\)/', $lines[$i])) {
            $i++;
        }
        continue;
    }

    // T16 footer block
    if (preg_match('/^@if \(helper::appdata\(@\$storeinfo->id\)->template == 16\)\s*$/', $line)
        && isset($lines[$i + 1])
        && str_contains($lines[$i + 1], '@php')) {
        $out[] = "@if (helper::appdata(@\$storeinfo->id)->template == 16)\n";
        $out[] = "    {{-- Theme 16: no storefront footer --}}\n";
        $i++;
        while ($i < $n && ! preg_match('/@elseif \(in_array\(helper::appdata\(@\$storeinfo->id\)->template/', $lines[$i])) {
            $i++;
        }
        continue;
    }

    // Copyright hide for T16
    if (str_contains($line, 'copy-right-sec') && str_contains($line, 't16-copy')) {
        $line = str_replace(
            "helper::appdata(@\$storeinfo->id)->template == 16 ? 't16-copy' : ''",
            "helper::appdata(@\$storeinfo->id)->template == 16 ? 'd-none' : ''",
            $line
        );
    }

    $out[] = $line;
    $i++;
}

file_put_contents($path, implode('', $out));
echo "lines_before={$n} lines_after=".count($out)."\n";
echo substr_count(implode('', $out), 't16-footer')." t16-footer mentions\n";
echo (str_contains(implode('', $out), "d-none' : ''") ? "copyright_ok\n" : "copyright_miss\n");
