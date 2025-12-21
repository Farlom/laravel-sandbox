<?php

namespace App\Enums;

enum MessageStatusEnum: string
{
    use EnumTrait;

    case Pending = 'pending';
    case Sent = 'sent';

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Отправка',
            self::Sent => 'Отправлено',
        };
    }
}
