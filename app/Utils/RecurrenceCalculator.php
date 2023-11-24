<?php

namespace App\Utils;

use App\Enums\RecurringType;
use Carbon\Carbon;

class RecurrenceCalculator
{
    public static function calculateNextOccurrence($recurrence, Carbon $startDate): Carbon
    {
        return match ($recurrence->type) {
            RecurringType::Daily->value => $startDate->addDay(),
            RecurringType::Weekly->value => $startDate->addWeek(),
            RecurringType::BiWeekly->value => $startDate->addWeeks(2),
            RecurringType::Monthly->value => $startDate->addMonth(),
            RecurringType::Yearly->value => $startDate->addYear(),
            RecurringType::Custom->value => $startDate->addDays($recurrence->interval),
            default => throw new \Exception('Invalid recurrence type')
        };
    }
}
