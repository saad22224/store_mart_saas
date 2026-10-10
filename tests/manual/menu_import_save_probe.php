<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

$vendorId = (int) (Category::query()->value('vendor_id') ?? Item::query()->value('vendor_id') ?? 0);
if ($vendorId < 1) {
    echo "NO_VENDOR\n";
    exit(1);
}

echo "vendor={$vendorId}\n";

DB::beginTransaction();
try {
    $cat = new Category();
    $cat->vendor_id = $vendorId;
    $cat->name = 'probe-cat-'.uniqid();
    $cat->slug = 'probe-cat-'.uniqid();
    $cat->image = 'default.png';
    $cat->is_available = 1;
    $cat->is_deleted = 2;
    // intentionally omit reorder_id
    $cat->save();
    echo "category_saved id={$cat->id} reorder=".var_export($cat->reorder_id, true)."\n";

    $item = new Item();
    $item->vendor_id = $vendorId;
    $item->cat_id = (string) $cat->id;
    $item->item_name = 'probe-item-'.uniqid();
    $item->slug = 'probe-item-'.uniqid();
    $item->item_price = 10;
    $item->item_original_price = 10;
    $item->description = '';
    $item->image = 'default.png';
    $item->has_variants = 2;
    $item->variants_json = '';
    $item->stock_management = 2;
    $item->is_available = 1;
    $item->is_deleted = 2;
    $item->is_imported = 1;
    $item->save();
    echo "item_saved id={$item->id} reorder=".var_export($item->reorder_id, true)."\n";
    echo "OK\n";
} catch (Throwable $e) {
    echo 'FAIL: '.$e->getMessage()."\n";
}
DB::rollBack();
echo "rolled_back\n";
