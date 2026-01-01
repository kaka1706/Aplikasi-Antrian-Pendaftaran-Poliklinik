<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Prodi',
            'email' => 'admin@prodi.test',
            'password' => bcrypt('password123'),
            'role' => 'admin_prodi',
            'clinic_id' => null,
        ]);
    }
}
