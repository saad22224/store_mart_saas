<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Automation;
use App\Models\AutomationLog;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWhatsAppMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $message;
    public $automationId;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $message
     * @param int|null $automationId
     */
    public function __construct(User $user, string $message, ?int $automationId = null)
    {
        $this->user = $user;
        $this->message = $message;
        $this->automationId = $automationId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(WhatsAppService $whatsAppService)
    {
        // Avoid duplicate sending for the same automation
        if ($this->automationId) {
            $alreadySent = AutomationLog::where('user_id', $this->user->id)
                ->where('automation_id', $this->automationId)
                ->exists();

            if ($alreadySent) {
                Log::info("Automation message already sent to user {$this->user->id} for automation {$this->automationId}");
                return;
            }
        }

        if (empty($this->user->mobile)) {
            Log::warning("User {$this->user->id} has no mobile number for WhatsApp message.");
            return;
        }

        // Send the message via service
        $response = $whatsAppService->sendMessage($this->user->mobile, $this->message);

        // If sent successfully and it's part of an automation rule, log it
        if ($response['success'] && $this->automationId) {
            AutomationLog::create([
                'user_id' => $this->user->id,
                'automation_id' => $this->automationId,
                'sent_at' => now(),
            ]);
        }
    }
}
