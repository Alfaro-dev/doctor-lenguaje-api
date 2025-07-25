<?php
namespace App\Services;

use App\Http\Responses\HttpStatus;
use App\Http\Responses\Response;
use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function generateText($prompt): Response
    {
        try {
            $model = 'gpt-4-turbo';
            $temperature = 0.3;
            $topP = 1.0;
            $frequencyPenalty = 0.2;
            $presencePenalty = 0.0;

            $response = $this->client->post('chat/completions', [
                'json' => [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => $temperature,
                    'top_p' => $topP,
                    'frequency_penalty' => $frequencyPenalty,
                    'presence_penalty' => $presencePenalty,
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            if (!isset($body['choices'][0]['message']['content'])) {
                return new Response(
                    'Text generation failed',
                    HttpStatus::INTERNAL_SERVER_ERROR
                );
            }

            $bodyResponse = str_replace("'", '"', $body['choices'][0]['message']['content']);

            $data = [
                'text' => json_decode($bodyResponse),
            ];

            return new Response(
                'Text generated successfully',
                HttpStatus::OK,
                $data
            );
        } catch (\Exception $e) {
            return new Response(
                $e->getMessage(),
                HttpStatus::INTERNAL_SERVER_ERROR
            );
        }
    }

    public function analyzeAudio($audio, $text): Response
    {
        try {
            $response = $this->client->post('audio/transcriptions', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($audio->getPathname(), 'r'),
                        'filename' => 'converted_audio.mp3',
                    ],
                    [
                        'name'     => 'model',
                        'contents' => 'whisper-1',
                    ],
                    [
                        'name'     => 'language',
                        'contents' => 'en',
                    ],
                    [
                        'name'     => 'prompt',
                        'contents' => 'Meticulously review the pronunciation of the following English audio. Evaluate every sound and intonation to ensure clarity and accuracy.',
                    ],
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            if (!isset($body['translations'][0]['text'])) {
                return new Response(
                    'Audio analysis failed',
                    HttpStatus::INTERNAL_SERVER_ERROR
                );
            }

            $data = [
                'text' => $body['translations'][0]['text'],
            ];

            return new Response(
                'Audio analyzed successfully',
                HttpStatus::OK,
                $data
            );

        } catch (\Exception $e) {
            return new Response(
                $e->getMessage(),
                HttpStatus::INTERNAL_SERVER_ERROR
            );
        }
    }
}