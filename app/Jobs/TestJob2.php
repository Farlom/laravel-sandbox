<?php

namespace App\Jobs;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Client\Ollama\OllamaClient;
use App\Enums\MessageStatusEnum;
use App\Enums\MessageTypeEnum;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TestJob2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user, private Message $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(OllamaClient $client): void
    {
        $dto = new OllamaRequestDto($this->message->text);

        $response = $client->post($dto);

        Message::create([
           'chat_id' => $this->message->chat->id,
           'type' => MessageTypeEnum::Bot,
           'status' => MessageStatusEnum::Sent,
           'text' => $response->getResponse(),
        ]);

       $this->message->status = MessageStatusEnum::Sent;

    }
}
