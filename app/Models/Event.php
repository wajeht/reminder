<?php

namespace App\Models;

use App\Enums\UnitType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $recurrence_type
 * @property int|null $recurrence_interval
 * @property string|null $logo_url
 * @property string|null $color
 * @property string $unit
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLogoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurrenceInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurrenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function countDown(): string
    {
        $endDate = Carbon::parse($this->end_date);
        $now = Carbon::now();
        $difference = $endDate->diff($now);
        $countdown = '';

        if ($this->unit === UnitType::Years->value) {
            if ($difference->y > 0) {
                $countdown .= $difference->y.' '.Str::plural('Year', $difference->y);
            } elseif ($difference->m > 0) {
                $countdown .= $difference->m.' '.Str::plural('Month', $difference->m);
            } elseif ($difference->days > 0) {
                $countdown .= $difference->days.' '.Str::plural('Day', $difference->days);
            } elseif ($difference->h > 0) {
                $countdown .= $difference->h.' '.Str::plural('Hour', $difference->h);
            } elseif ($difference->i > 0) {
                $countdown .= $difference->i.' '.Str::plural('Minute', $difference->i);
            } else {
                $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
            }
        } elseif ($this->unit === UnitType::Months->value) {
            if ($difference->m > 0) {
                $countdown .= $difference->m.' '.Str::plural('Month', $difference->m);
            } elseif ($difference->days > 0) {
                $countdown .= $difference->days.' '.Str::plural('Day', $difference->days);
            } elseif ($difference->h > 0) {
                $countdown .= $difference->h.' '.Str::plural('Hour', $difference->h);
            } elseif ($difference->i > 0) {
                $countdown .= $difference->i.' '.Str::plural('Minute', $difference->i);
            } else {
                $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
            }
        } elseif ($this->unit === UnitType::Weeks->value) {
            if ($difference->days >= 7) {
                $weeks = floor($difference->days / 7);
                $countdown .= $weeks.' '.Str::plural('Week', $weeks);
            } elseif ($difference->days > 0) {
                $countdown .= $difference->days.' '.Str::plural('Day', $difference->days);
            } elseif ($difference->h > 0) {
                $countdown .= $difference->h.' '.Str::plural('Hour', $difference->h);
            } elseif ($difference->i > 0) {
                $countdown .= $difference->i.' '.Str::plural('Minute', $difference->i);
            } elseif ($difference->s > 0) {
                $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
            }
        } elseif ($this->unit === UnitType::Days->value) {
            if ($difference->days > 0) {
                $countdown .= $difference->days.' '.Str::plural('Day', $difference->days);
            } elseif ($difference->h > 0) {
                $countdown .= $difference->h.' '.Str::plural('Hour', $difference->h);
            } elseif ($difference->i > 0) {
                $countdown .= $difference->i.' '.Str::plural('Minute', $difference->i);
            } else {
                $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
            }
        } elseif ($this->unit === UnitType::Hours->value) {
            if ($difference->h > 0) {
                $countdown .= $difference->h.' '.Str::plural('Hour', $difference->h);
            } elseif ($difference->i > 0) {
                $countdown .= $difference->i.' '.Str::plural('Minute', $difference->i);
            } else {
                $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
            }
        } elseif ($this->unit === UnitType::Minutes->value) {
            if ($difference->i > 0) {
                $countdown .= $difference->i.' '.Str::plural('Minute', $difference->i);
            } else {
                $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
            }
        } elseif ($this->unit === UnitType::Seconds->value) {
            $countdown .= $difference->s.' '.Str::plural('Second', $difference->s);
        }

        return $countdown;
    }
}
