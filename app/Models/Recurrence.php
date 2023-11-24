<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recurrence extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['type' => RecurringType::class];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}