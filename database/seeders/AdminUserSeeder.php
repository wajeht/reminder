<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Password;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.env') === 'production' && ! is_null(env('ADMIN_USER_NAME')) && ! is_null(env('ADMIN_USER_EMAIL'))) {
            $existingAdmin = User::where('email', env('ADMIN_USER_EMAIL'))->first();

            if (! $existingAdmin) {
                $newAdmin = User::factory()->create([
                    'name' => env('ADMIN_USER_NAME'),
                    'email' => env('ADMIN_USER_EMAIL'),
                ]);

                $token = Password::createToken($newAdmin);
                $newAdmin->sendPasswordResetNotification($token);
            }
        }
    }
}
