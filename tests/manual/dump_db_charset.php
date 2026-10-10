<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo 'config charset='.config('database.connections.mysql.charset').PHP_EOL;
$rows = DB::select('SELECT id, name, HEX(name) as h FROM store_category ORDER BY id');
$out = [];
foreach ($rows as $r) {
    $out[] = ['id' => $r->id, 'name' => $r->name, 'hex' => $r->h];
}
file_put_contents(__DIR__.'/categories_hex.json', json_encode($out, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo "Wrote categories_hex.json\n";
foreach ($out as $row) {
    echo '#'.$row['id'].' hex_len='.strlen($row['hex']).' starts='.substr($row['hex'], 0, 24).PHP_EOL;
}

$theme7Count = DB::table('settings')->where('template', 7)->count();
echo 'theme7 count='.$theme7Count.PHP_EOL;
$templates = DB::table('settings')->select('template', DB::raw('count(*) as c'))->groupBy('template')->orderBy('c', 'desc')->limit(10)->get();
foreach ($templates as $t) {
    echo 'template='.$t->template.' count='.$t->c.PHP_EOL;
}
