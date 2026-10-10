<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Helpers\helper;
use Illuminate\Support\Facades\DB;

$vendorId = 288;
$row = DB::table('settings')->where('vendor_id', $vendorId)->first();
echo 'db_template='.var_export($row->template ?? null, true).PHP_EOL;

$appdata = helper::appdata($vendorId);
echo 'appdata_null='.($appdata ? 'no' : 'yes').PHP_EOL;
if ($appdata) {
    echo 'appdata_template='.var_export($appdata->template ?? null, true).PHP_EOL;
    echo 'appdata_vendor_id='.var_export($appdata->vendor_id ?? null, true).PHP_EOL;
}

echo 'uses_theme_7='.var_export(helper::uses_storefront_theme($vendorId, 7), true).PHP_EOL;

DB::table('settings')->where('vendor_id', $vendorId)->update(['template' => 7]);
// clear any static caches if present by re-fetching
$appdata2 = helper::appdata($vendorId);
echo 'after_update appdata_template='.var_export($appdata2->template ?? null, true).PHP_EOL;
echo 'after_update uses_theme_7='.var_export(helper::uses_storefront_theme($vendorId, 7), true).PHP_EOL;
echo 'after_update is_menu='.var_export(helper::is_menu_store($vendorId), true).PHP_EOL;

DB::table('settings')->where('vendor_id', $vendorId)->update(['template' => 16]);
echo "restored\n";
