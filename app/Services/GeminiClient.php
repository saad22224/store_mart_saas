<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Shared Gemini API client used by Support (text) and Menu import (vision).
 * Reuses the same env keys and primary/fallback models as LandingHomeController::aiAsk.
 */
class GeminiClient
{
    public const MODEL_PRIMARY = 'gemini-2.5-flash-lite';

    public const MODEL_FALLBACK = 'gemini-1.5-flash';

    /**
     * @return array<int, string>
     */
    public function apiKeys(): array
    {
        $apiKeys = [];
        foreach (['GEMINI_API', 'GEMINI_API2', 'GEMINI_API3', 'GEMINI_API4'] as $envKey) {
            $val = env($envKey);
            if (! empty($val)) {
                $apiKeys[] = trim($val);
            }
        }
        if (! empty(env('GEMINI_API_KEYS'))) {
            foreach (explode(',', (string) env('GEMINI_API_KEYS')) as $k) {
                if (trim($k) !== '') {
                    $apiKeys[] = trim($k);
                }
            }
        }

        return array_values(array_unique($apiKeys));
    }

    public function isConfigured(): bool
    {
        return count($this->apiKeys()) > 0;
    }

    /**
     * @param  array<int, array<string, mixed>>  $parts  Gemini content parts (text / inline_data)
     * @param  array<string, mixed>  $generationConfig
     * @return array{text: string, model: string}
     *
     * @throws RuntimeException
     */
    public function generateContent(
        array $parts,
        ?string $systemInstruction = null,
        array $generationConfig = [],
        int $timeout = 90
    ): array {
        $apiKeys = $this->apiKeys();
        if ($apiKeys === []) {
            throw new RuntimeException('gemini_not_configured');
        }

        $defaultConfig = [
            'temperature' => 0.2,
            'topK' => 40,
            'topP' => 0.95,
            'maxOutputTokens' => 8192,
        ];
        $generationConfig = array_merge($defaultConfig, $generationConfig);

        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => $parts,
                ],
            ],
            'generationConfig' => $generationConfig,
            'safetySettings' => [
                ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
            ],
        ];

        if ($systemInstruction !== null && $systemInstruction !== '') {
            $payload['system_instruction'] = [
                'parts' => [['text' => $systemInstruction]],
            ];
        }

        $lastError = '';
        foreach ($apiKeys as $index => $apiKey) {
            foreach ([self::MODEL_PRIMARY, self::MODEL_FALLBACK] as $model) {
                try {
                    $url = 'https://generativelanguage.googleapis.com/v1beta/models/'.
                        $model.':generateContent?key='.$apiKey;

                    // responseMimeType may be unsupported on older models — omit on fallback
                    $body = $payload;
                    if ($model === self::MODEL_FALLBACK) {
                        unset($body['generationConfig']['responseMimeType']);
                        unset($body['system_instruction']);
                        if ($systemInstruction) {
                            $body['contents'][0]['parts'] = array_merge(
                                [['text' => $systemInstruction."\n\n"]],
                                $parts
                            );
                        }
                    }

                    $response = Http::withHeaders(['Content-Type' => 'application/json'])
                        ->timeout($timeout)
                        ->post($url, $body);

                    if ($response->successful()) {
                        $data = $response->json();
                        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                        if (is_string($text) && trim($text) !== '') {
                            return ['text' => $text, 'model' => $model];
                        }
                        $lastError = 'empty_candidate';
                    } else {
                        $lastError = 'http_'.$response->status();
                        Log::warning('Gemini request failed', [
                            'model' => $model,
                            'key_index' => $index,
                            'status' => $response->status(),
                        ]);
                    }
                } catch (\Throwable $e) {
                    $lastError = 'exception';
                    Log::warning('Gemini request exception', [
                        'model' => $model,
                        'key_index' => $index,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        throw new RuntimeException('gemini_failed:'.$lastError);
    }
}
