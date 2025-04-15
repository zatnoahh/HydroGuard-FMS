<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReliefCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('relief_centers')->insert([
            [
                'name' => 'SMK Dato Abu Bakar',
                'location' => 'Kajang',
                'capacity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewan Komuniti Seksyen 4',
                'location' => 'Bandar Baru Bangi',
                'capacity' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Balai Raya Kampung Sungai Tangkas',
                'location' => 'Bangi',
                'capacity' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SK Bandar Teknologi Kajang',
                'location' => 'Semenyih',
                'capacity' => 220,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewan Orang Ramai Taman Balakong',
                'location' => 'Balakong',
                'capacity' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
