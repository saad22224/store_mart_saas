<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

echo "views:\n";
foreach ([
    'front.template-16.home',
    'front.template-16.category',
    'front.template-16.detail',
    'front.template-16._product_card',
] as $v) {
    echo ($v.' => '.(View::exists($v) ? 'yes' : 'no')).PHP_EOL;
}

$rows = DB::table('settings')->where('template', 16)->limit(5)->get(['vendor_id', 'template']);
echo "\ntheme16 vendors:\n";
foreach ($rows as $r) {
    $u = DB::table('users')->where('id', $r->vendor_id)->first(['id', 'slug', 'name']);
    if (! $u) {
        continue;
    }
    echo "id={$u->id} slug={$u->slug}\n";

    $noImg = DB::table('items')
        ->leftJoin('product_images', 'product_images.item_id', '=', 'items.id')
        ->where('items.vendor_id', $u->id)
        ->where('items.is_deleted', 2)
        ->whereNull('product_images.id')
        ->select('items.id', 'items.slug', 'items.item_name', 'items.image')
        ->first();
    if ($noImg) {
        echo "  no_gallery_item slug={$noImg->slug} image={$noImg->image}\n";
    }
}

// Compile blades
try {
    $blade = app('blade.compiler');
    foreach ([
        resource_path('views/front/view-cart-bar.blade.php'),
        resource_path('views/front/template-16/home.blade.php'),
        resource_path('views/front/template-16/category.blade.php'),
        resource_path('views/front/template-16/detail.blade.php'),
    ] as $file) {
        $blade->compile($file);
        echo 'compiled '.basename($file).PHP_EOL;
    }
} catch (Throwable $e) {
    echo 'COMPILE_FAIL '.$e->getMessage().PHP_EOL;
}

echo "ok\n";
