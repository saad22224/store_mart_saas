<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Helpers\helper;
use App\Models\StoreCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "items has is_imported: ".(Schema::hasColumn('items', 'is_imported') ? 'yes' : 'no').PHP_EOL;

$counts = User::query()->where('type', 2)->select('store_id', DB::raw('count(*) as c'))
    ->groupBy('store_id')->orderByDesc('c')->get();
foreach ($counts as $row) {
    echo 'store_id='.$row->store_id.' vendors='.$row->c.PHP_EOL;
}

// Restore known restaurant/café label if the row is corrupted placeholders
$cat = StoreCategory::find(22);
if ($cat) {
    $name = (string) $cat->name;
    $isPlaceholder = $name === '' || preg_match('/^\?+$/u', str_replace(['/', ' ', '\\'], '', $name));
    echo 'cat22 before='.$name.' placeholder='.($isPlaceholder ? 'Y' : 'n').PHP_EOL;
    if ($isPlaceholder) {
        $cat->name = 'مطعم/ كافيه';
        $cat->save();
        echo "Restored store_category #22 name to مطعم/ كافيه\n";
    }
}

$sample = User::where('type', 2)->where('store_id', 22)->first();
if ($sample) {
    echo 'sample vendor='.$sample->id.' is_restaurant='.(helper::is_restaurant_store($sample->id) ? 'Y' : 'n').
        ' is_menu='.(helper::is_menu_store($sample->id) ? 'Y' : 'n').PHP_EOL;
} else {
    echo "No vendor with store_id=22\n";
}

// Optionally mark one non-restaurant vendor as Theme 16 for OR-condition verification, then leave it
$themeProbe = User::where('type', 2)->where('store_id', '!=', 22)->orderBy('id')->first();
if ($themeProbe) {
    $settings = DB::table('settings')->where('vendor_id', $themeProbe->id)->first();
    if ($settings) {
        $old = $settings->template;
        DB::table('settings')->where('vendor_id', $themeProbe->id)->update(['template' => 16]);
        echo 'theme_probe vendor='.$themeProbe->id.' old_template='.$old.
            ' is_menu_now='.(helper::is_menu_store($themeProbe->id) ? 'Y' : 'n').PHP_EOL;
        // restore
        DB::table('settings')->where('vendor_id', $themeProbe->id)->update(['template' => $old]);
        echo 'restored template='.$old.' is_menu_after='.(helper::is_menu_store($themeProbe->id) ? 'Y' : 'n').PHP_EOL;
    }
}
