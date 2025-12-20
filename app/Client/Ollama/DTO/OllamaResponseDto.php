<?php

namespace App\Client\Ollama\DTO;

class OllamaResponseDto
{
    public function __construct(
        private string $createdAt,
        private string $response,
        private bool $done,
        private string $doneReason,
    ) { }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getResponse(): string
    {
        return $this->response;
    }

    public function isDone(): bool
    {
        return $this->done;
    }

    public function getDoneReason(): string
    {
        return $this->doneReason;
    }
    public function jsonSerialize(): array
    {
        return [
            'created_at' => $this->createdAt,
            'response' => $this->response,
            'done' => $this->done,
            'done_reason' => $this->doneReason,
        ];
    }
}
