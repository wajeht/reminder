<?php

namespace Database\Seeders;

use App\Enums\RoleNames;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@reminder.test',
            'user_type' => RoleNames::ADMIN->value,
        ]);

        User::factory()->count(5)->create();
    }
}
