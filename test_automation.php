<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$automation = App\Models\Automation::where('trigger_type', 'after_registration')->first();
$delay = $automation->delay_in_hours;
$users = App\Models\User::where('type', 2)
    ->where('created_at', '<=', \Carbon\Carbon::now()->subHours($delay))
    ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
        $query->where('automation_id', $automation->id);
    })->get();

echo "Users older than $delay hours: " . count($users) . "\n";
echo Carbon\Carbon::now() . "\n";
foreach($users as $user) {
    $products = App\Models\Item::where('vendor_id', $user->id)->count();
    echo "User {$user->id} has $products products\n";
    if ($products == 1) {
        echo "Will dispatch job for User {$user->id}\n";
    }
}
