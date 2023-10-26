<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use App\Models\Profile;
use App\Models\User;
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
                $password = Hash::make('password');
                $commonAttributes = [
                    'email' => $baseEmail,
                    'name' => 'John Doe ' . $index,
                    'profile_id' => $profile->id,
                    'gender' => 'male',
                    'birth_date' => '1990-01-01',
                    'nationality' => 'USA',
                    'phone' => '123-456-7890',
                    'address' => '123 Main St',
                    'id_type' => 'card',
                    'id_number' => 'ID12345',
                    'profile_picture' => 'default-profile-icon.png',
                    'status' => 'activated',
                    'password' => $password,
                ];

                if ($profile->designation == 'employe') {
                    foreach ($employeeTypes as $employeeType) {
                        $baseEmail = strtolower($profile->designation) . $index . $employeeType->id . '@example.com'; // Change here
                
                        $commonAttributes['email'] = $baseEmail;
                        $employeeAttributes = [
                            'employee_type_id' => $employeeType->id,
                            'hiring_date' => '2022-01-01',
                            'position' => 'Software Developer',
                            'department' => 'IT',
                            'contract_type' => 'full-time',
                            'salary' => 5000,
                            'education_level' => 'Bachelor',
                            'specific_training' => 'Laravel Training',
                            'certifications' => 'PHP Certification',
                            'social_security_number' => 'SSN12345',
                            'bank_name' => 'ABC Bank',
                            'bank_account_number' => '12345678',
                            'emergency_contact_name' => 'Jane Doe',
                            'emergency_contact_relation' => 'Spouse',
                            'emergency_contact_phone' => '098-765-4321',
                        ];
                
                        User::create(array_merge($commonAttributes, $employeeAttributes));
                    }
                } else {
                    $clientAttributes = [
                        'marital_status' => 'single',
                        'occupation' => 'Software Developer',
                        'financial_information' => 'Good Credit Score',
                        'number_of_dependents' => 2,
                        'source_of_income' => 'Job',
                        'referral' => 'Friend',
                        'client_since' => '2020-01-01',
                        'previous_loan_details' => 'Loan taken in 2019',
                        'client_type' => 'individual',
                        'average_monthly_income' => 4000,
                    ];

                    User::create(array_merge($commonAttributes, $clientAttributes));
                }
            }
        }
    }
}
