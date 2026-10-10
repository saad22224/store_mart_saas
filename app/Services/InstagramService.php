<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    private const API_HOST = 'instagram-scraper-stable-api.p.rapidapi.com';
    private const POSTS_PER_PAGE = 12;

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
     *
     * The response is normalized to ['result' => ['edges' => [...], 'page_info' => [...]]]
     * which is the shape the admin import modal consumes.
     */
    public function fetchPosts(string $username, ?string $maxId = null)
    {
        if (empty($this->apiKeys)) {
            Log::error('Instagram API: No API keys configured.');
            return ['error' => 'No API keys configured.'];
        }

        $params = [
            'username_or_url' => $username,
            'amount' => (string) self::POSTS_PER_PAGE,
        ];
        if (!empty($maxId)) {
            $params['pagination_token'] = $maxId;
        }

        foreach ($this->apiKeys as $index => $apiKey) {
            try {
                Log::info("Instagram API: Trying API Key #" . ($index + 1) . " for user {$username}");

                $response = Http::withHeaders([
                    'x-rapidapi-key' => $apiKey,
                    'x-rapidapi-host' => self::API_HOST,
                ])->asMultipart()->timeout(60)->post('https://' . self::API_HOST . '/get_ig_user_posts.php', $params);

                $data = $response->json();

                if ($response->successful() && isset($data['posts']) && is_array($data['posts'])) {
                    Log::info("Instagram API: Successfully fetched posts using API Key #" . ($index + 1));
                    $token = $data['pagination_token'] ?? null;
                    return [
                        'result' => [
                            'edges' => $data['posts'],
                            'page_info' => [
                                'has_next_page' => !empty($token),
                                'end_cursor' => $token,
                            ],
                        ],
                    ];
                }

                $status = $response->status();
                $body = $response->body();
                Log::warning("Instagram API: API Key #" . ($index + 1) . " failed with status {$status} and response: " . $body);

                // The API reports unknown users as HTTP 200 with an "error" field; don't fail over for those.
                $error = is_array($data) ? ($data['error'] ?? '') : '';
                if (str_contains(strtolower($error), 'user') || in_array($status, [400, 404])) {
                    if (!str_contains(strtolower($body), 'quota')) {
                        return ['error' => 'Invalid username or user not found.'];
                    }
                }

            } catch (\Exception $e) {
                Log::warning("Instagram API: API Key #" . ($index + 1) . " threw exception: " . $e->getMessage());
            }
        }

        Log::error("Instagram API: All API keys failed for user {$username}");
        return ['error' => 'Failed to fetch Instagram posts after trying all available API keys.'];
    }
}
