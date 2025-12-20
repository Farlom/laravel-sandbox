<?php

namespace App\Client\Ollama\DTO;

class OllamaRequestDto
{
    public function __construct(
        private string $prompt,
        private bool $stream = false, // прикольно
    ) { }

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function isStream(): bool
    {
        return $this->stream;
    }

    public function jsonSerialize(): array
    {
        return [
            'model' => config('ollama.model'),
            'prompt' => $this->prompt,
            'stream' => $this->stream,
        ];
    }
}
