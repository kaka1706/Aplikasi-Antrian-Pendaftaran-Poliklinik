<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poli::create([
            'clinic_id' => 1,
            'name' => 'Poli Umum',
            'description' => 'Pelayanan umum',
        ]);
        Poli::create([
            'clinic_id' => 1,
            'name' => 'Poli Gigi',
            'description' => 'Perawatan gigi',
        ]);

        // Klinik 2
        Poli::create([
            'clinic_id' => 2,
            'name' => 'Poli Anak',
            'description' => 'Perawatan anak',
        ]);
    }
}
