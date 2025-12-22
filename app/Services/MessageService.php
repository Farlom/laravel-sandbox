<?php

namespace App\Services;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Enums\MessageStatusEnum;
use App\Enums\MessageTypeEnum;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Jobs\TestJob2;
use App\Models\Chat;
use App\Models\Message;

class MessageService
{
    public function create(StoreMessageRequest $request, Chat $chat)
    {
        $message = new Message();
        $message->fill($request->all());
        $message->chat_id = $chat->id;
        $message->type = MessageTypeEnum::User;
        $message->status = MessageStatusEnum::Pending;
        $message->save();

        TestJob2::dispatch($chat->user, $message);

        return $message;
    }
}
