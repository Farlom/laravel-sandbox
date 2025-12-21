<?php

namespace App\Http\Controllers\Chat;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Client\Ollama\OllamaClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Jobs\TestJob2;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index', [
            'user' => auth()->user(),
        ]);
    }

    public function store(StoreChatRequest $request)
    {
        $chat = new Chat();
        $chat->fill($request->all());
        $chat->user_id = auth()->user()->id;
        $chat->save();

        return redirect()->route('chats.index');
//        TestJob2::dispatch(Auth::user(), new OllamaRequestDto('Привет'));
//        $client = new OllamaClient();
//
//        dd($client->post(new OllamaRequestDto('Привет')));
    }
}
