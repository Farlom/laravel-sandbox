<?php

namespace App\Services;

use App\Http\Requests\Chat\StoreChatRequest;
use App\Models\Chat;
use App\Models\User;

class ChatService
{
    public function create(StoreChatRequest $request, User $user)
    {
        $chat = new Chat();
        $chat->fill($request->all());
        $chat->user_id = auth()->user()->id; // FIXME
        $chat->save();

        return $chat;
    }
}
