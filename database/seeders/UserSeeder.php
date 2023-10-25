<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();
        $employeeTypes = EmployeeType::all();

        foreach ($profiles as $profile) {
            foreach (range(1, 20) as $index) {
                $baseEmail = strtolower($profile->designation) . $index . '@example.com';
                $name = ucfirst($profile->designation) . ' User ' . $index;
                $password = Hash::make('password');

                if ($profile->designation == 'employe') {
                    foreach ($employeeTypes as $employeeType) {
                        $email = strtolower($employeeType->designation) . $index . '@example.com'; // Modification ici
                        User::create([
                            'email' => $email,
                            'name' => $name . ' ' . ucfirst($employeeType->designation),
                            'profile_id' => $profile->id,
                            'password' => $password,
                            'status' => 'activated',
                            'employee_type_id' => $employeeType->id
                        ]);
                    }
                } else {
                    User::create([
                        'email' => $baseEmail,  // Utiliser le courriel de base pour les autres profils
                        'name' => $name,
                        'profile_id' => $profile->id,
                        'password' => $password,
                        'status' => 'activated'
                    ]);
                }
            }
        }
    }
}
