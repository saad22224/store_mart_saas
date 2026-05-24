<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== WhatsApp Direct Test ===\n";
echo "QUEUE_CONNECTION: " . config('queue.default') . "\n";
echo "WHATSAPP_BASE_URL: " . env('WHATSAPP_BASE_URL') . "\n";
echo "UID: " . env('UID') . "\n";
echo "DEVICE_UID: " . env('DEVICE_UID') . "\n\n";

// Step 1: Test API directly
$user = App\Models\User::find(87);
echo "User mobile: " . $user->mobile . "\n\n";

$service = new App\Services\WhatsAppService();
echo "Sending test message...\n";
$response = $service->sendMessage($user->mobile, 'رسالة اختبار من النظام - Test Message');
echo "Response: " . json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n\n";

// Step 2: Dispatch automation job directly
echo "Dispatching CheckAutomationsJob synchronously...\n";
$job = new App\Jobs\CheckAutomationsJob();
$job->handle();
echo "Done! Check jobs table:\n";
echo "Jobs in queue: " . \Illuminate\Support\Facades\DB::table('jobs')->count() . "\n";
echo "AutomationLogs: " . App\Models\AutomationLog::count() . "\n";
