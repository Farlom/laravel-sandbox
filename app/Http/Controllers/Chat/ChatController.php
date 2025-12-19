<?php

namespace App\Http\Controllers\Chat;

use App\Client\Ollama\OllamaClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function store()
    {
        $client = new OllamaClient();

        dd($client->post());
    }
}
