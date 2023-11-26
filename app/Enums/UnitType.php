<?php

namespace App\Enums;

enum UnitType: string
{
    case Years = 'years';
    case Months = 'months';
    case Weeks = 'weeks';
    case Days = 'days';
    case Hours = 'hours';
    case Minutes = 'minutes';
    case Seconds = 'seconds';

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
