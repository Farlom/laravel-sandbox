<?php

namespace App\Models;

use App\Enums\MessageStatusEnum;
use App\Enums\MessageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'type',
        'text',
        'status',
    ];

    protected $casts = [
        'type' => MessageTypeEnum::class,
        'status' => MessageStatusEnum::class,
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
