<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('clinics')->delete();
        
        DB::table('clinics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Klinik Pratama',
                'address' => 'Malang',
                'description' => NULL,
                'created_at' => '2025-11-27 17:41:06',
                'updated_at' => '2025-11-27 17:41:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'RST DR Soepraoen',
                'address' => 'Jl. S. Supriadi No.22, Kec. Sukun Kota Malang, Jawa Timur 65112',
                'description' => 'Rumah Sakit Tk. II dr.Soepraoen adalah Rumah Sakit milik TNI AD yang mempunyai tugas pokok memberikan pelayanan kesehatan kepada Prajurit, ASN dan Keluarganya serta Masyarakat Umum.',
                'created_at' => '2025-12-11 06:32:43',
                'updated_at' => '2025-12-11 06:32:43',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'RSUD Saiful Anwar',
                'address' => 'Jl. Jaksa Agung Suprapto No.2, Klojen, Kec. Klojen, Kota Malang, Jawa Timur 65112',
                'description' => NULL,
                'created_at' => '2025-12-11 07:01:59',
                'updated_at' => '2025-12-11 07:01:59',
            ),
        ));
        
        
    }
}