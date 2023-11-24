<?php

namespace App\Enums;

enum RecurringType: string
{
  case Daily = 'daily';
  case Weekly = 'weekly';
  case BiWeekly = 'bi-weekly';
  case Monthly = 'monthly';
  case Yearly = 'yearly';
  case Custom = 'custom';

  public static function getValues(): array
  {
    return array_column(self::cases(), 'value');
  }
}
