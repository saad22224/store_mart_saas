<?php

/**
 * Eligibility helper smoke test.
 * Run: php tests/manual/menu_eligibility_smoke.php
 */

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Helpers\helper;
use App\Models\Settings;
use App\Models\StoreCategory;
use App\Models\User;

echo "=== Store categories ===\n";
foreach (StoreCategory::orderBy('id')->get(['id', 'name']) as $c) {
    $isRestName = helper::is_restaurant_store(
        optional(User::where('store_id', $c->id)->where('type', 2)->first())->id ?? 0
    );
    // Evaluate category name the same way helper does
    $name = mb_strtolower(trim($c->name));
    $match = str_contains($name, 'restaurant') ||
        str_contains($name, 'cafe') ||
        str_contains($name, 'café') ||
        str_contains($name, 'مطعم') ||
        str_contains($name, 'كافيه');
    echo sprintf("#%d match=%s name=%s\n", $c->id, $match ? 'Y' : 'n', $c->name);
}

echo "\n=== Vendors (first restaurant/theme16/neither samples) ===\n";
$found = ['rest' => 0, 'theme16' => 0, 'neither' => 0, 'both' => 0];
foreach (User::query()->where('type', 2)->whereNotNull('store_id')->orderBy('id')->cursor() as $v) {
    $isRest = helper::is_restaurant_store($v->id);
    $isTheme16 = helper::uses_storefront_theme($v->id, 16);
    $isMenu = helper::is_menu_store($v->id);
    $tpl = optional(Settings::where('vendor_id', $v->id)->first())->template;

    $bucket = null;
    if ($isRest && $isTheme16) {
        $bucket = 'both';
    } elseif ($isRest) {
        $bucket = 'rest';
    } elseif ($isTheme16) {
        $bucket = 'theme16';
    } else {
        $bucket = 'neither';
    }

    if ($found[$bucket] >= 2) {
        continue;
    }
    $found[$bucket]++;
    echo sprintf(
        "vendor=%d bucket=%s rest=%s theme16=%s menu=%s template=%s store_id=%s\n",
        $v->id,
        $bucket,
        $isRest ? 'Y' : 'n',
        $isTheme16 ? 'Y' : 'n',
        $isMenu ? 'Y' : 'n',
        $tpl ?? '-',
        $v->store_id
    );

    if (array_sum($found) >= 8) {
        break;
    }
}

echo "\nCounts sampled: ".json_encode($found)."\nDone.\n";
