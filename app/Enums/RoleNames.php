<?php

namespace App\Enums;

enum RoleNames: string
{
    case ADMIN = 'Admin';
    case USER = 'User';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getAsAssociatedArray(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->value];
        })->toArray();
    }
}
