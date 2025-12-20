<?php

namespace App\Client\Ollama;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Client\Ollama\DTO\OllamaResponseDto;
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

    public function post(OllamaRequestDto $dto): OllamaResponseDto
    {
        try {
            $response = $this->client->post('api/generate', $dto->jsonSerialize());

            if ($response->status() === 200) {
                $data =  json_decode($response->body(), true);
                return new OllamaResponseDto(
                    $data['created_at'],
                    $data['response'],
                    $data['done'],
                    $data['done_reason']
                );
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
