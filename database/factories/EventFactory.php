<?php

namespace Database\Factories;

use App\Models\Recurrence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'recurrence_id' => Recurrence::factory(),
        ];
    }
}
