<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class SafetyGuidelineSeeder extends Seeder
{
    public function run()
    {
        DB::table('safety_guidelines')->insert([
            [
                'title' => 'Flood Evacuation Procedures',
                'description' => 'Follow local authorities’ instructions, bring important documents, medication, and basic necessities before moving to the designated relief centers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Electrical Safety During Floods',
                'description' => 'Switch off the main power supply immediately during a flood. Avoid touching electrical appliances with wet hands or while standing in water.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'COVID-19 SOP in Relief Centers',
                'description' => 'Maintain social distancing, wear a mask, and sanitize regularly. Follow all SOPs set by the Ministry of Health during stay at flood shelters.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Landslide Risk Awareness',
                'description' => 'Avoid areas with steep slopes after heavy rain. Report visible cracks or soil movement near your house to local authorities immediately.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Safe Driving During Heavy Rain',
                'description' => 'Drive slowly, turn on headlights, and avoid flooded roads. If visibility is poor, stop at a safe location until the weather improves.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mosquito-Borne Disease Prevention',
                'description' => 'After floods, remove stagnant water around the house to prevent dengue outbreaks. Use mosquito repellents and nets.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Emergency Contact Preparedness',
                'description' => 'Save emergency numbers like 999, Bomba, and NADMA. Ensure family members know the contacts and have access to them during emergencies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

