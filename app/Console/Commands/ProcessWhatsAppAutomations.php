<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Automation;
use App\Models\User;
use App\Models\Item;
use App\Models\AutomationLog;
use App\Enums\AutomationTriggerType;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessWhatsAppAutomations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:process-automations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process WhatsApp automations as a cron job instead of queued jobs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(WhatsAppService $whatsAppService)
    {
        // Log::info('ProcessWhatsAppAutomations: Started.');
        $activeAutomations = Automation::where('is_active', true)->get();
        // Log::info('ProcessWhatsAppAutomations: Found ' . $activeAutomations->count() . ' active automations.');

        foreach ($activeAutomations as $automation) {
            // Log::info("ProcessWhatsAppAutomations: Processing automation ID {$automation->id} of type {$automation->trigger_type}.");
            if ($automation->trigger_type === AutomationTriggerType::AFTER_REGISTRATION->value) {
                $this->processAfterRegistration($automation, $whatsAppService);
            } elseif ($automation->trigger_type === AutomationTriggerType::INACTIVE_USER->value) {
                $this->processInactiveUser($automation, $whatsAppService);
            }
        }

        // Log::info('ProcessWhatsAppAutomations: Finished.');

        
        return Command::SUCCESS;
    }

    protected function processAfterRegistration(Automation $automation, WhatsAppService $whatsAppService)
    {
        $delay = $automation->delay_in_hours;
        // Log::info("processAfterRegistration: Checking for users registered between {$delay} and " . ($delay + 1) . " hours ago.");
        
        // The user must have registered exactly between (delay) hours ago and (delay + 1) hours ago
        // This ensures we do not send messages for users who registered a long time ago.
        $users = User::where('type', 2)
            ->where('created_at', '<=', Carbon::now()->subHours($delay))
            ->where('created_at', '>', Carbon::now()->subHours($delay + 1))
            ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
                $query->where('automation_id', $automation->id);
            })
            ->get();

        // Log::info("processAfterRegistration: Found {$users->count()} eligible users for automation {$automation->id}.");

        foreach ($users as $user) {
            $productCount = Item::where('vendor_id', $user->id)->count();
//             Log::info("processAfterRegistration: User {$user->id} has {$productCount} products.");
// Log::info('Automation Time Debug', [
//     'now' => now(),
//     'one_hour_ago' => now()->copy()->subHour(),
//     'two_hours_ago' => now()->copy()->subHours(2),
//     'user_created_at' => $user->created_at,
// ]);
            if ($productCount === 1) {
                // Log::info("processAfterRegistration: Sending message to user {$user->id}.");
                $this->sendWhatsAppMessage($user, $automation, $whatsAppService);
            } else {
                // Log::info("processAfterRegistration: Skipping user {$user->id} because product count is {$productCount} (not exactly 1).");
            }
        }
    }

    protected function processInactiveUser(Automation $automation, WhatsAppService $whatsAppService)
    {
        $delay = $automation->delay_in_hours;
        // Log::info("processInactiveUser: Checking for inactive users between {$delay} and " . ($delay + 1) . " hours ago.");

        // Same 1 hour window limit applied here
        $users = User::where('type', 2)
            ->whereNotNull('last_seen_at')
            ->where('last_seen_at', '<=', Carbon::now()->subHours($delay))
            ->where('last_seen_at', '>', Carbon::now()->subHours($delay + 1))
            ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
                $query->where('automation_id', $automation->id);
            })
            ->get();

        // Log::info("processInactiveUser: Found {$users->count()} eligible inactive users for automation {$automation->id}.");

        foreach ($users as $user) {
            // Log::info("processInactiveUser: Sending message to user {$user->id}.");
            $this->sendWhatsAppMessage($user, $automation, $whatsAppService);
        }
    }

    protected function sendWhatsAppMessage(User $user, Automation $automation, WhatsAppService $whatsAppService)
    {
        if (empty($user->mobile)) {
            // Log::warning("sendWhatsAppMessage: User {$user->id} has no mobile number. Skipping.");
            return;
        }

        // Avoid duplicate sending
        $alreadySent = AutomationLog::where('user_id', $user->id)
            ->where('automation_id', $automation->id)
            ->exists();

        if ($alreadySent) {
            // Log::info("sendWhatsAppMessage: Automation {$automation->id} already sent to user {$user->id}. Skipping.");
            return;
        }

        try {
            // Log::info("sendWhatsAppMessage: Attempting to send message to user {$user->id} at {$user->mobile}.");
            $response = $whatsAppService->sendMessage($user->mobile, $automation->message);

            if (isset($response['success']) && $response['success']) {
                // Log::info("sendWhatsAppMessage: Successfully sent message to user {$user->id}. Logging to DB.");
                AutomationLog::create([
                    'user_id' => $user->id,
                    'automation_id' => $automation->id,
                    'sent_at' => now(),
                ]);
            } else {
                $errorMsg = json_encode($response);
                // Log::error("sendWhatsAppMessage: API responded with failure for user {$user->id}. Response: {$errorMsg}");
            }
        } catch (\Exception $e) {
            // Log::error("sendWhatsAppMessage: Exception sending to user {$user->id}: " . $e->getMessage());
        }
    }
}
