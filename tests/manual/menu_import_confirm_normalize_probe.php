<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\admin\MenuImportController;
use App\Services\MenuVisionService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

$tmp = tempnam(sys_get_temp_dir(), 'up');
$noFile = new UploadedFile($tmp, '', 'application/octet-stream', UPLOAD_ERR_NO_FILE, true);

$request = Request::create('/admin/products/menu-import/confirm/test', 'POST', [
    'products' => [
        0 => [
            'include' => '1',
            'name' => 'ورق عنب',
            'price' => '30',
            'category_id' => '',
            'new_category' => 'المقبلات',
            'description' => '',
        ],
    ],
], [], [
    'products' => [
        0 => ['image' => $noFile],
    ],
]);

$controller = app(MenuImportController::class);
$ref = new ReflectionClass($controller);
$method = $ref->getMethod('normalizeConfirmProducts');
$method->setAccessible(true);
$products = $method->invoke($controller, $request);

echo 'has_image_key='.(array_key_exists('image', $products[0]) ? 'yes' : 'no').PHP_EOL;

$validator = Validator::make(['products' => $products], [
    'products' => 'required|array|min:1',
    'products.*.name' => 'nullable|string|max:190',
    'products.*.price' => 'nullable|numeric|min:0',
    'products.*.category_id' => 'nullable|integer',
    'products.*.new_category' => 'nullable|string|max:120',
    'products.*.image' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:'.helper::imagesize(),
]);

echo 'fails='.($validator->fails() ? 'yes' : 'no').PHP_EOL;
if ($validator->fails()) {
    echo $validator->errors()->toJson(JSON_UNESCAPED_UNICODE).PHP_EOL;
} else {
    echo "validation_ok\n";
}

@unlink($tmp);
