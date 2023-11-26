<?php

namespace Database\Factories;

use App\Enums\RecurringType;
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
        $startDate = $this->faker->dateTimeBetween('first day of this month', 'last day of this month');

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $startDate,
            'end_date' => $this->faker->dateTimeBetween($startDate, 'last day of this month'),
            'recurrence_type' => $this->faker->randomElement(RecurringType::getValues()),
            'recurrence_interval' => $this->faker->randomElement([null, 1, 7, 30]),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
