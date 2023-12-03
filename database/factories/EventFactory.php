<?php

namespace Database\Factories;

use App\Enums\RecurringType;
use App\Enums\UnitType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

        $pub_file = database_path('data/pub.jpg');

        if (!File::exists($pub_file)) {
            dd('pub file does not exist');
        }

        $new_pub_file_name = Str::uuid() . '.jpg';
        $new_pub_file_path = storage_path('app/public/' . $new_pub_file_name);

        File::copy($pub_file, $new_pub_file_path);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->boolean() ? $this->faker->paragraph : null,

            'logo_url' => $new_pub_file_name,
            'color' => $this->faker->boolean ? $this->faker->hexColor() : null,
            'unit' => $this->faker->randomElement(UnitType::cases()),

            'start_date' => $startDate,
            'end_date' => $this->faker->dateTimeBetween($startDate, 'last day of this month'),

            'recurrence_type' => $this->faker->randomElement(RecurringType::getValues()),
            'recurrence_interval' => $this->faker->randomElement([null, 1, 7, 30]),

            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
