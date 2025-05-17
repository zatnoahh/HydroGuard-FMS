<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $malayNames = [
            'Ahmad Faiz', 'Nur Aisyah', 'Muhammad Iqbal', 'Siti Amina', 'Mohd Azlan',
            'Aina Sofea', 'Adam Hakim', 'Farah Nadia', 'Zulhilmi', 'Nurul Huda',
            'Hafizuddin', 'Syafiqah', 'Izzat', 'Fatin Nabila', 'Shahrul Nizam',
            'Aqil Danish', 'Nur Iman', 'Hakimah', 'Rafiq', 'Hanis Zulaikha',
            'Azim', 'Alia', 'Najmi', 'Balqis', 'Naim', 'Huda', 'Arif', 'Zarina', 'Iqmal', 'Zikri'
        ];

        foreach ($malayNames as $name) {
            $email = Str::slug($name, '.') . '@gmail.com';
            $phone = '01' . rand(0, 9) . '-' . rand(1000000, 9999999);

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('User12345678'),
                'role' => 'user',
                'phone_number' => $phone,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
