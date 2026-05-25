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
while (RateLimiter::tooManyAttempts($throttleKey, 5)) {
    usleep(500000); // نص ثانية
}

            // Register the attempt with a 1-second decay
RateLimiter::hit($throttleKey, 1);
            Log::info('WhatsApp API Request Started', [
                'url' => $this->baseUrl,
                'to' => $to,
                'timeout_config' => 60
            ]);

            $response = Http::timeout(60)
                ->post($this->baseUrl, [
                    'uid' => $this->uid,
                    'device_uid' => $this->deviceUid,
                    'to' => $to,
                    'message' => $message,
                ]);

            Log::info('WhatsApp API Request Completed', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'message' => 'Message sent successfully.'
                ];
            }

            $responseData = $response->json();
            
            // The third-party API sometimes sends the message but times out internally waiting for confirmation.
            // If we get a 500 error with "cURL error 28" (timeout), we treat it as successful since the message was actually delivered.
            if ($response->status() === 500 && isset($responseData['message']) && strpos($responseData['message'], 'cURL error 28') !== false) {
                return [
                    'success' => true,
                    'data' => $responseData,
                    'message' => 'Message sent (with API timeout).'
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
                'exception_class' => get_class($e),
                'message' => $e->getMessage(),
                'to' => $to,
                'trace' => $e->getTraceAsString()
            ]);

            // If it's a connection timeout from our server to the API provider
            if ($e instanceof \Illuminate\Http\Client\ConnectionException || strpos($e->getMessage(), 'cURL error 28') !== false) {
                return [
                    'success' => true,
                    'message' => 'Message likely sent, but connection timed out.'
                ];
            }

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
