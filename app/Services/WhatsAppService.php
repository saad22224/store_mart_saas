<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class WhatsAppService
{
    protected string $baseUrl;
    protected string $uid;
    protected string $deviceUid;

    public function __construct()
    {
        $this->baseUrl =  env('WHATSAPP_BASE_URL');
        $this->uid = env('UID');
        $this->deviceUid =  env('DEVICE_UID');
    }

    /**
     * Send a WhatsApp message.
     *
     * @param string $to
     * @param string $message
     * @return array
     */
    public function sendMessage(string $to, string $message): array
    {
        try {
            $throttleKey = 'global-whatsapp-api-limit';

            // Wait until we are under the limit of 50 messages per second
            while (RateLimiter::tooManyAttempts($throttleKey, 50)) {
                usleep(200000); // Wait 100ms before checking again
            }

            // Register the attempt with a 1-second decay
            RateLimiter::hit($throttleKey, 1);

            $response = Http::timeout(20)
                ->retry(3, 100)
                ->post($this->baseUrl, [
                    'uid' => $this->uid,
                    'device_uid' => $this->deviceUid,
                    'to' => $to,
                    'message' => $message,
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'message' => 'Message sent successfully.'
                ];
            }

            Log::error('WhatsApp API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'to' => $to,
            ]);

            return [
                'success' => false,
                'data' => $response->json(),
                'message' => 'Failed to send message.',
                'status' => $response->status()
            ];
        } catch (\Exception $e) {
            Log::error('WhatsApp Service Exception', [
                'exception' => $e->getMessage(),
                'to' => $to,
            ]);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
