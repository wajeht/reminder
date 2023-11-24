<?php

namespace Database\Factories;

use App\Enums\RecurringType;
use App\Models\Recurrence;
use App\Models\User;
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
            'recurrence_type' => $this->faker->randomElement(RecurringType::getValues()),
            'recurrence_interval' => $this->faker->randomElement([null, 1, 7, 30]),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
