<?php

namespace App\Services;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Client\Ollama\OllamaClient;
use App\Enums\MessageStatusEnum;
use App\Enums\MessageTypeEnum;
use App\Models\Message;

class OllamaService
{
    public function __construct(
        private OllamaClient $client
    )
    {
    }

    public function process(Message $message)
    {
        // TODO transaction, typehint
        $dto = new OllamaRequestDto($message->text);

        $response = $this->client->post($dto);

        $aiMessage = Message::create([
            'chat_id' => $message->chat->id,
            'type' => MessageTypeEnum::Bot,
            'status' => MessageStatusEnum::Sent,
            'text' => $response->getResponse(),
        ]);

        $message->update([
            'status' => MessageStatusEnum::Sent
        ]);
        $message->save();

        return [
            $message,
            $aiMessage
        ];
    }
}
