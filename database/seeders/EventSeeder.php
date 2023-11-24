<?php

namespace Database\Seeders;

use App\Enums\RecurringType;
use App\Models\Event;
use App\Models\Recurrence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 daily events
        Recurrence::factory()->count(5)->create(['type' => RecurringType::Daily->value])
            ->each(function ($recurrence) {
                Event::factory()->create(['recurrence_id' => $recurrence->id]);
            });

        // Create 5 weekly events
        Recurrence::factory()->count(5)->create(['type' => RecurringType::Weekly->value])
            ->each(function ($recurrence) {
                Event::factory()->create(['recurrence_id' => $recurrence->id]);
            });

        // Create 5 monthly events
        Recurrence::factory()->count(5)->create(['type' => RecurringType::Monthly->value])
            ->each(function ($recurrence) {
                Event::factory()->create(['recurrence_id' => $recurrence->id]);
            });

        // Create 5 custom events
        Recurrence::factory()->count(5)->create(['type' => RecurringType::Custom->value])
            ->each(function ($recurrence) {
                Event::factory()->create(['recurrence_id' => $recurrence->id]);
            });
    }
}
