<?php

namespace App\Jobs;

use App\Models\Automation;
use App\Models\User;
use App\Models\Item;
use App\Enums\AutomationTriggerType;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckAutomationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $activeAutomations = Automation::where('is_active', true)->get();

        foreach ($activeAutomations as $automation) {
            if ($automation->trigger_type === AutomationTriggerType::AFTER_REGISTRATION->value) {
                $this->processAfterRegistration($automation);
            } elseif ($automation->trigger_type === AutomationTriggerType::INACTIVE_USER->value) {
                $this->processInactiveUser($automation);
            }
        }
    }

    protected function processAfterRegistration(Automation $automation)
    {
        // Find users registered exactly `delay_in_hours` hours ago
        // We use a window of 1 hour to avoid missing users or processing them multiple times.
        // It's safer to check if they have NOT received this automation.
        
        $delay = $automation->delay_in_hours;
        
        // Users who registered at least $delay hours ago
        $users = User::where('type', 2) // Assuming 2 is Vendor based on helper.php
            ->where('created_at', '<=', Carbon::now()->subHours($delay))
            ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
                $query->where('automation_id', $automation->id);
            })
            ->get();

        foreach ($users as $user) {
            // Check if they only have exactly 1 product
            $productCount = Item::where('vendor_id', $user->id)->count();

            if ($productCount === 1) {
                // Dispatch job to send message
                SendWhatsAppMessageJob::dispatch($user, $automation->message, $automation->id);
            }
        }
    }

    protected function processInactiveUser(Automation $automation)
    {
        $delay = $automation->delay_in_hours;

        // Users who haven't been seen for $delay hours
        $users = User::where('type', 2)
            ->whereNotNull('last_seen_at')
            ->where('last_seen_at', '<=', Carbon::now()->subHours($delay))
            ->whereDoesntHave('automationLogs', function ($query) use ($automation) {
                // To avoid sending every minute, we check if we've sent it recently (e.g., in the last 24h)
                // Or if the automation is a one-time thing. Assuming one-time per automation.
                $query->where('automation_id', $automation->id);
            })
            ->get();

        foreach ($users as $user) {
            SendWhatsAppMessageJob::dispatch($user, $automation->message, $automation->id);
        }
    }
}
