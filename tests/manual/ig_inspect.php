<?php
// php tests/manual/ig_inspect.php [username]
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$svc = new App\Services\InstagramService();
$user = $argv[1] ?? 'nike';

$r = $svc->fetchPosts($user);
if (isset($r['error'])) { echo "ERROR: {$r['error']}\n"; exit; }
echo 'page1 edges=', count($r['result']['edges']), ' has_next=', var_export($r['result']['page_info']['has_next_page'], true), "\n";

$r2 = $svc->fetchPosts($user, $r['result']['page_info']['end_cursor']);
echo 'page2 edges=', count($r2['result']['edges'] ?? []), ' first=', $r2['result']['edges'][0]['node']['id'] ?? '-', "\n";

foreach ($r['result']['edges'] as $e) {
    if (($e['node']['media_type'] ?? 0) == 1) {
        $img = file_get_contents($e['node']['image_versions2']['candidates'][0]['url']);
        echo 'image download bytes=', strlen($img), ' jpeg=', substr($img, 0, 2) === "\xFF\xD8" ? 'yes' : 'no', "\n";
        break;
    }
}

$bad = $svc->fetchPosts('zzqq_no_such_user_98123x');
echo 'bad user: ', $bad['error'] ?? 'no error?!', "\n";
