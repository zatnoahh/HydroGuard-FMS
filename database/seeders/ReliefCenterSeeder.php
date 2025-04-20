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
                // Bangi/Kajang PPS
                [
                    'name' => 'PPS Dewan Seri Cempaka',
                    'location' => 'Seksyen 9, Bandar Baru Bangi',
                    'capacity' => 500,
                    'service' => 'Shelter, meals, basic medical aid',
                    'contact_info' => 'Pejabat Daerah Hulu Langat (03-8737 7044)'
                ],
                [
                    'name' => 'PPS Dewan Seri Saujana',
                    'location' => 'Jalan Reko, Kajang',
                    'capacity' => 300,
                    'service' => 'Emergency shelter for flood victims',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'PPS Sekolah Kebangsaan Bangi',
                    'location' => 'Jalan 7, Bandar Baru Bangi',
                    'capacity' => 200,
                    'service' => 'Families displaced by floods',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'PPS Balai Raya Kampung Batu 14',
                    'location' => 'Near Kajang-Semenyih route',
                    'capacity' => 150,
                    'service' => '-',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'PPS Surau Al-Muttaqin',
                    'location' => 'Jalan Kajang Perdana 7, Taman Kajang Perdana',
                    'capacity' => 100,
                    'service' => 'Temporary shelter for flash floods',
                    'contact_info' => '-'
                ],
    
                // Putrajaya PPS
                [
                    'name' => 'PPS Dewan Seri Perdana',
                    'location' => 'Presint 1, Putrajaya',
                    'capacity' => 800,
                    'service' => 'Major flood evacuation hub',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'PPS Kompleks Kejiranan Presint 9',
                    'location' => 'Presint 9, Putrajaya',
                    'capacity' => 200,
                    'service' => '-',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'PPS Sekolah Kebangsaan Putrajaya Presint 11',
                    'location' => 'Presint 11, Putrajaya',
                    'capacity' => 500, // Unknown capacity
                    'service' => 'Families with children',
                    'contact_info' => '-'
                ],
    
                // NGO Flood Aid Stations
                [
                    'name' => 'Mercy Malaysia Kajang Flood Command Post',
                    'location' => 'Near Stadium Kajang',
                    'capacity' => 0, // Not a shelter
                    'service' => 'Medical aid, hygiene kits',
                    'contact_info' => '03-4256 9999'
                ],
                [
                    'name' => 'Islamic Relief Malaysia (Kajang Warehouse)',
                    'location' => 'Jalan Teknologi 3/6, Bangi',
                    'capacity' => 0,
                    'service' => 'Food packs, bottled water',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'Malaysian Red Crescent (Hulu Langat Branch)',
                    'location' => 'Jalan Semenyih, Kajang',
                    'capacity' => 0,
                    'service' => 'Rescue boats, first aid',
                    'contact_info' => '-'
                ],
                [
                    'name' => 'IMARET (Islamic Medical Assoc. Response Team) Bangi',
                    'location' => 'Masjid Al-Huda, Seksyen 3',
                    'capacity' => 0,
                    'service' => 'Emergency medical care',
                    'contact_info' => '-'
                ]
            ]);
    }
}
