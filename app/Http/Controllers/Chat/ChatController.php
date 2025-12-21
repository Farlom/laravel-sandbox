<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Services\ChatService;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(
        private ChatService $chatService,
    ) { }

    public function index()
    {
        $chats = Auth::user()->chats()->with('messages')->get();

        return view('chat.index', [
            'chats' => $chats,
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
