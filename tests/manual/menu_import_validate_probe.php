<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

$maxKb = helper::imagesize();
echo "maxKb={$maxKb}\n";

// Simulate empty file input (browser sends no-file upload)
$emptyFile = UploadedFile::fake()->create('empty.jpg', 0, 'image/jpeg');
// Better: real NO_FILE style
$tmp = tempnam(sys_get_temp_dir(), 'up');
$noFile = new UploadedFile($tmp, '', 'application/octet-stream', UPLOAD_ERR_NO_FILE, true);

$data = [
    'products' => [
        0 => [
            'include' => '1',
            'name' => 'Test Product',
            'price' => '10',
            'category_id' => '',
            'new_category' => 'مقبلات',
            'description' => '',
            'image' => $noFile,
        ],
        1 => [
            'include' => '1',
            'name' => 'No Price',
            'price' => '',
            'new_category' => 'سلطات',
            'image' => $noFile,
        ],
    ],
];

$validator = Validator::make($data, [
    'products' => 'required|array|min:1',
    'products.*.include' => 'nullable',
    'products.*.name' => 'nullable|string|max:190',
    'products.*.description' => 'nullable|string|max:5000',
    'products.*.price' => 'nullable|numeric|min:0',
    'products.*.category_id' => 'nullable|integer',
    'products.*.new_category' => 'nullable|string|max:120',
    'products.*.image' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:'.$maxKb,
]);

echo 'fails='.($validator->fails() ? 'yes' : 'no')."\n";
if ($validator->fails()) {
    echo $validator->errors()->toJson(JSON_UNESCAPED_UNICODE)."\n";
}

// Without image key
$data2 = $data;
unset($data2['products'][0]['image'], $data2['products'][1]['image']);
$v2 = Validator::make($data2, [
    'products' => 'required|array|min:1',
    'products.*.price' => 'nullable|numeric|min:0',
    'products.*.image' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:'.$maxKb,
]);
echo 'without_image_fails='.($v2->fails() ? 'yes' : 'no')."\n";
if ($v2->fails()) {
    echo $v2->errors()->toJson(JSON_UNESCAPED_UNICODE)."\n";
}

@unlink($tmp);
