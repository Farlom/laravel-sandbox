<?php

namespace App\Http\Controllers\Chat;

use App\Client\Ollama\DTO\OllamaRequestDto;
use App\Client\Ollama\OllamaClient;
use App\Http\Controllers\Controller;
use App\Jobs\TestJob2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function store()
    {
        TestJob2::dispatch(Auth::user(), new OllamaRequestDto('Привет'));
//        $client = new OllamaClient();
//
//        dd($client->post(new OllamaRequestDto('Привет')));
    }
}
