<?php

namespace App\Enums;

enum MessageTypeEnum: string
{
    use EnumTrait;

    case Bot = 'bot';
    case User = 'user';

    public function label(): string
    {
        return match($this) {
            self::Bot => 'Бот',
            self::User => 'Пользователь',
        };
    }
}
