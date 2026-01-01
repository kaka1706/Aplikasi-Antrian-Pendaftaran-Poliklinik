<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clinic::create([
            'name' => 'Klinik Sehat Sentosa',
            'address' => 'Jl. Mawar No. 12',
            'description' => 'Klinik utama untuk praktikum',
        ]);

        Clinic::create([
            'name' => 'Rumah Sakit Bahagia',
            'address' => 'Jl. Melati No. 33',
            'description' => 'RS mitra untuk keperawatan',
        ]);
    }
}
