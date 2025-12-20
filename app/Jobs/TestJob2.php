<?php

namespace App\Jobs;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Client\Ollama\OllamaClient;
use App\Enums\MessageTypeEnum;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user, private OllamaRequestDto $dto)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(OllamaClient $client): void
    {
        $response = $client->post($this->dto);

        // TODO transaction
       Message::create([
           'chat_id' => 1,
           'type' => MessageTypeEnum::User,
           'text' => $this->dto->getPrompt(),
       ]);

        Message::create([
            'chat_id' => 1,
            'type' => MessageTypeEnum::Bot,
            'text' => $response->getResponse(),
        ]);
    }
}
