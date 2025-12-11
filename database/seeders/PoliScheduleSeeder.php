<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PoliSchedule;

class PoliScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PoliSchedule::create([
            'poli_id' => 1,
            'day_of_week' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '10:00',
            'quota' => 10,
        ]);
        PoliSchedule::create([
            'poli_id' => 1,
            'day_of_week' => 'Rabu',
            'start_time' => '13:00',
            'end_time' => '15:00',
            'quota' => 8,
        ]);

        // schedules for poli 2 (Poli Gigi)
        PoliSchedule::create([
            'poli_id' => 2,
            'day_of_week' => 'Selasa',
            'start_time' => '09:00',
            'end_time' => '11:00',
            'quota' => 6,
        ]);

        // poli 3
        PoliSchedule::create([
            'poli_id' => 3,
            'day_of_week' => 'Kamis',
            'start_time' => '10:00',
            'end_time' => '12:00',
            'quota' => 5,
        ]);
    }
}
