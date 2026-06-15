<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    private array $apiKeys;

    public function __construct()
    {
        $this->apiKeys = array_filter([
            env('x_rapidapi_key1'),
            env('x_rapidapi_key2'),
            env('x_rapidapi_key3'),
        ]);
    }

    /**
     * Fetch posts for a given username with failover mechanism.
     */
    public function fetchPosts(string $username, ?string $maxId = null)
    {
        if (empty($this->apiKeys)) {
            Log::error('Instagram API: No API keys configured.');
            return ['error' => 'No API keys configured.'];
        }

        foreach ($this->apiKeys as $index => $apiKey) {
            try {
                Log::info("Instagram API: Trying API Key #" . ($index + 1) . " for user {$username}");

                $response = Http::withHeaders([
                    'x-rapidapi-key' => $apiKey,
                    'x-rapidapi-host' => 'instagram120.p.rapidapi.com',
                    'Content-Type' => 'application/json'
                ])->timeout(15)->post('https://instagram120.p.rapidapi.com/api/instagram/posts', [
                    'username' => $username,
                    'maxId' => $maxId ?? ''
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    // Basic validation of expected response structure
                    if (isset($data['result']['edges'])) {
                        Log::info("Instagram API: Successfully fetched posts using API Key #" . ($index + 1));
                        return $data;
                    }
                }

                $status = $response->status();
                Log::warning("Instagram API: API Key #" . ($index + 1) . " failed with status {$status} and response: " . $response->body());

                // Don't failover for non-existent users (e.g., 404 or bad request due to username)
                // However, the Instagram API might return 403 or 429 for rate limits/quota which we should failover on.
                if (in_array($status, [400, 404]) && !str_contains(strtolower($response->body()), 'quota')) {
                    return ['error' => 'Invalid username or user not found.'];
                }

            } catch (\Exception $e) {
                Log::warning("Instagram API: API Key #" . ($index + 1) . " threw exception: " . $e->getMessage());
            }
        }

        Log::error("Instagram API: All API keys failed for user {$username}");
        return ['error' => 'Failed to fetch Instagram posts after trying all available API keys.'];
    }
}
