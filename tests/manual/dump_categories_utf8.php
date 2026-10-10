<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rows = [];
foreach (App\Models\StoreCategory::orderBy('id')->get(['id', 'name']) as $c) {
    $name = (string) $c->name;
    $rows[] = [
        'id' => $c->id,
        'name' => $name,
        'hex' => bin2hex($name),
        'has_mat3am' => str_contains($name, 'مطعم'),
        'has_cafe' => str_contains(mb_strtolower($name), 'كافيه') || str_contains(mb_strtolower($name), 'cafe'),
    ];
}
file_put_contents(__DIR__.'/categories_dump.json', json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo "Wrote categories_dump.json\n";
