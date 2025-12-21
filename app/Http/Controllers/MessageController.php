<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreMessageRequest;
use App\Models\Chat;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(
        private MessageService $messageService
    ) { }

    public function store(StoreMessageRequest $request, Chat $chat)
    {
        $this->messageService->create($request, $chat);

        return redirect()->route('chats.index');
    }
}
