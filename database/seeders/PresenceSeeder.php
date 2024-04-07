<?php

namespace Database\Seeders;

use App\Models\Presence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presence::create([
            'user_id' => 1,
            'check_in' => now(),
            'check_out' => now()->addHour(8),
            'attendance_status' => 'tepat waktu',
            'date' => now(),
        ]);

        Presence::create([
            'user_id' => 1,
            'check_in' => now(),
            'check_out' => now()->addHour(8),
            'attendance_status' => 'tepat waktu',
            'date' => now()->addDay(1),
        ]);
    }
}
