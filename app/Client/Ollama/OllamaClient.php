<?php

namespace App\Client\Ollama;

use Exception;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Throwable;

final class OllamaClient
{
    private PendingRequest $client;

    public function __construct()
    {
        $host = config('ollama.base_url');
        $port = config('ollama.port');

        $this->client = Http::baseUrl("$host:$port");
    }

    public function post()
    {
        try {
            $response = $this->client->post('api/generate', [
                'model' => config('ollama.model'),
                'prompt' => 'Привет!',
                'stream' => false, // прикольно
            ]);

            if ($response->status() === 200) {
                return json_decode($response->body(), true);
            }

            throw new Exception("Ошибка запроса к серверу POST: {$response->status()}");
        } catch (Throwable $throwable) {
            throw new HttpClientException(
                message: $throwable->getMessage(),
                previous: $throwable,
            );
        }
    }
}
