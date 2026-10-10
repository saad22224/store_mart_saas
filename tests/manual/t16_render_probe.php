<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$slug = 'saad-yasser';
$itemSlug = 'ork-aanb';

foreach ([
    "/{$slug}",
    "/{$slug}/detail-{$itemSlug}",
] as $uri) {
    $request = Illuminate\Http\Request::create($uri, 'GET');
    try {
        $response = $kernel->handle($request);
        $status = $response->getStatusCode();
        $body = $response->getContent();
        $hasContactCard = str_contains($body, 't16-contact-card');
        $hasFooter = str_contains($body, 'class="t16-footer"');
        $hasCrash = str_contains($body, 'Attempt to read property');
        $hasPlaceholder = str_contains($body, 'item-placeholder.png');
        $hasNewHeader = str_contains($body, 't16-header-search');
        echo "{$uri} status={$status} contact={$hasContactCard} footer={$hasFooter} crash={$hasCrash} placeholder={$hasPlaceholder} searchHdr={$hasNewHeader} len=".strlen($body).PHP_EOL;
        $kernel->terminate($request, $response);
    } catch (Throwable $e) {
        echo "{$uri} EXCEPTION ".$e->getMessage().PHP_EOL;
    }
}
