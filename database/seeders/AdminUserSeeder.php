<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
                $newAdmin = new User();
                $newAdmin->name = env('ADMIN_USER_NAME');
                $newAdmin->email = env('ADMIN_USER_EMAIL');
                $newAdmin->password = bcrypt(Str::random(32));
                $newAdmin->save();

                $token = Password::createToken($newAdmin);
                $newAdmin->sendPasswordResetNotification($token);
            }
        }
    }
}
