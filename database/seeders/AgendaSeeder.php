<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agenda::create([
            'name' => 'Meeting tech support',
            'description' => 'Meeting with tech support',
            'date' => now(),
            'start_time' => now(),
            'end_time' => now()->addHour(3),
            'location' => 'Jakarta',
        ]);

        Agenda::create([
            'name' => 'Meeting tech support',
            'description' => 'Meeting with tech support',
            'date' => now(),
            'start_time' => now()->addHour(3),
            'end_time' => now()->addHour(6),
            'location' => 'Jakarta',
        ]);
    }
}
