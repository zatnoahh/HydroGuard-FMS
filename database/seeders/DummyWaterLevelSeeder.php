<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Distance;
use Carbon\Carbon;

class DummyWaterLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Remove previous data from last 24 hours for clean seeding
        Distance::where('created_at', '>=', now()->subDay())->delete();

        // Insert fake readings for each of the last 24 hours
        for ($i = 0; $i < 24; $i++) {
            $hour = Carbon::now()->subHours(24 - $i); // go back in time

            // Insert 1–3 readings for each hour
            $readingsCount = rand(1, 3);

            for ($j = 0; $j < $readingsCount; $j++) {
                Distance::create([
                    'value' => rand(10, 60), // Random cm from 10 to 60
                    'created_at' => $hour->copy()->addMinutes(rand(0, 59)),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}