<?php

namespace Database\Seeders;

use App\Models\Recurrence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecurrenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recurrence::factory()->count(10)->create();
    }
}
