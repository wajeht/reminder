<?php

namespace App\Enums;

enum RecurringType: string
{
  case Daily = 'daily';
  case Weekly = 'weekly';
  case Monthly = 'monthly';
  case Custom = 'custom';
}
