<?php

namespace App\Enums;

trait EnumTrait
{
    public static function values(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }

    public static function keys(): array
    {
        return array_map(fn (self $case) => $case->name, self::cases());
    }

    private static function callable(callable $callable): array
    {
        return array_map($callable, self::cases());
    }

    public static function options(): array
    {
        return array_combine(
            self::values(),
            self::callable(fn (self $case) => $case->label()),
        );
    }
}
