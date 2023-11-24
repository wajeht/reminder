<?php

namespace Database\Factories;

use App\Enums\RecurringType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recurrence>
 */
class RecurrenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $recurrenceTypes = RecurringType::getValues();
        $type = $this->faker->randomElement($recurrenceTypes);

        return [
            'type' => $type,
            'interval' => $type === RecurringType::Custom->value ? $this->faker->numberBetween(1, 30) : null,
        ];
    }
}
