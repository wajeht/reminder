<?php

namespace Database\Seeders;

use App\Enums\RecurringType;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed daily events
        Event::factory()->count(50)->create([
            'recurrence_type' => RecurringType::Daily->value,
            'recurrence_interval' => null,
        ]);

        // Seed weekly events
        Event::factory()->count(50)->create([
            'recurrence_type' => RecurringType::Weekly->value,
            'recurrence_interval' => null,
        ]);

        // Seed monthly events
        Event::factory()->count(50)->create([
            'recurrence_type' => RecurringType::Monthly->value,
            'recurrence_interval' => null,
        ]);

        // Seed custom recurrence events
        Event::factory()->count(50)->create([
            'recurrence_type' => RecurringType::Custom->value,
            'recurrence_interval' => 3,
        ]);
    }
}
