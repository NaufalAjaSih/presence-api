<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leave::create([
            'user_id' => 1,
            'start_date' => now(),
            'end_date' => now(),
            'reason' => 'sakit',
            'type' => 'sakit',
            'status' => 'pending',
        ]);
    }
}
