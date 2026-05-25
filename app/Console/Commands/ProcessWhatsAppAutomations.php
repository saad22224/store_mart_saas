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
        $activeAutomations = Automation::where('is_active', true)->get();

        foreach ($activeAutomations as $automation) {
            if ($automation->trigger_type === AutomationTriggerType::AFTER_REGISTRATION->value) {
                $this->processAfterRegistration($automation, $whatsAppService);
            } elseif ($automation->trigger_type === AutomationTriggerType::INACTIVE_USER->value) {
                $this->processInactiveUser($automation, $whatsAppService);
            }
        }

        return Command::SUCCESS;
    }

    protected function processAfterRegistration(Automation $automation, WhatsAppService $whatsAppService)
    {
        $delay = $automation->delay_in_hours;
        
        // The user must have registered exactly between (delay) hours ago and (delay + 1) hours ago
        // This ensures we do not send messages for users who registered a long time ago.
        $users = User::where('type', 2)
            ->where('created_at', '<=', Carbon::now()->subHours($delay))
            ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
                $query->where('automation_id', $automation->id);
            })
            ->get();

        foreach ($users as $user) {
            $productCount = Item::where('vendor_id', $user->id)->count();

            if ($productCount === 1) {
                $this->sendWhatsAppMessage($user, $automation, $whatsAppService);
            }
        }
    }

    protected function processInactiveUser(Automation $automation, WhatsAppService $whatsAppService)
    {
        $delay = $automation->delay_in_hours;

        // Same 1 hour window limit applied here
        $users = User::where('type', 2)
            ->whereNotNull('last_seen_at')
            ->where('last_seen_at', '<=', Carbon::now()->subHours($delay))
            ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
                $query->where('automation_id', $automation->id);
            })
            ->get();

        foreach ($users as $user) {
            $this->sendWhatsAppMessage($user, $automation, $whatsAppService);
        }
    }

    protected function sendWhatsAppMessage(User $user, Automation $automation, WhatsAppService $whatsAppService)
    {
        if (empty($user->mobile)) {
            Log::warning("User {$user->id} has no mobile number for WhatsApp message.");
            return;
        }

        // Avoid duplicate sending
        $alreadySent = AutomationLog::where('user_id', $user->id)
            ->where('automation_id', $automation->id)
            ->exists();

        if ($alreadySent) {
            return;
        }

        try {
            $response = $whatsAppService->sendMessage($user->mobile, $automation->message);

            if (isset($response['success']) && $response['success']) {
                AutomationLog::create([
                    'user_id' => $user->id,
                    'automation_id' => $automation->id,
                    'sent_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp automation to user {$user->id}: " . $e->getMessage());
        }
    }
}
