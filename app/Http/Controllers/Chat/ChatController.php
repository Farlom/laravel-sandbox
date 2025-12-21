<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Services\ChatService;

class ChatController extends Controller
{
    public function __construct(
        private ChatService $chatService,
    ) { }

    public function index()
    {
        return view('chat.index', [
            'user' => auth()->user(),
        ]);
    }

    public function store(StoreChatRequest $request)
    {
        $this->chatService->create($request, auth()->user());


        return redirect()->route('chats.index');
//        TestJob2::dispatch(Auth::user(), new OllamaRequestDto('Привет'));
//        $client = new OllamaClient();
//
//        dd($client->post(new OllamaRequestDto('Привет')));
    }
}
