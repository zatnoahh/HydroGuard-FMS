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
    public function run(): void
    {
        $now = Carbon::now()->startOfHour();
        $start = $now->copy()->subHours(23); // 24 data points

        for ($i = 0; $i < 24; $i++) {
            $timestamp = $start->copy()->addHours($i);

            // Morning: normal
            if ($timestamp->hour >= 0 && $timestamp->hour <= 10) {
                $value = rand(4000, 5500) / 100.0; // 40.00–55.00
            }
            // Afternoon to evening: rising water
            elseif ($timestamp->hour >= 11 && $timestamp->hour <= 18) {
                $value = rand(1000, 3500) / 100.0; // 10.00–35.00
            }
            // Night: stabilizing
            else {
                $value = rand(3500, 5000) / 100.0; // 35.00–50.00
            }

            // Determine status
            if ($value <= 15) {
                $status = 'danger';
            } elseif ($value <= 30) {
                $status = 'alert';
            } elseif ($value <= 55) {
                $status = 'warning';
            } else {
                $status = 'safe';
            }

            Distance::create([
                'value' => $value,
                'status' => $status,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }
    }
}
