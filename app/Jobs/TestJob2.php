<?php

namespace App\Jobs;

use App\Models\Message;
use App\Models\User;
use App\Services\OllamaService;
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
    public function handle(OllamaService $ollamaService): void
    {
        $ollamaService->process($this->message);
    }
}
