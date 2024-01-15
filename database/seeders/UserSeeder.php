<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = Profile::all();
        $employeeTypes = EmployeeType::all();

        foreach ($profiles as $profile) {
            foreach (range(1, 20) as $index) {
                $baseEmail = strtolower($profile->designation) . $index;

                // Générez un identifiant unique pour chaque utilisateur
                $uniqueId = time() . rand(100, 999);

                $commonAttributes = [
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
                    'password' => Hash::make('password'),
                ];

                if ($profile->designation == 'employe') {
                    foreach ($employeeTypes as $employeeType) {
                        $email = $baseEmail . $employeeType->id . $uniqueId . '@example.com';

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

                        $commonAttributes['email'] = $email;
                        User::create(array_merge($commonAttributes, $employeeAttributes));
                    }
                } else {
                    if ($index % 2 == 0) {
                        // Entreprise
                        $clientAttributes = [
                            'type_client' => 'pm', // Type de client défini sur 'pm' pour les entreprises
                            'name_company' => 'Company ' . $index, // Nom de l'entreprise
                            'ifu_company' => 'IFU' . str_pad($index, 5, '0', STR_PAD_LEFT), // IFU de l'entreprise, généré de manière unique pour chaque entreprise
                            'date_create' => now()->subYears(rand(1, 20))->format('Y-m-d'), // Date de création de l'entreprise, générée aléatoirement
                            'address_company' => '123 Business St, City ' . $index, // Adresse de l'entreprise
                            'activity_sector' => 'Sector ' . $index, // Secteur d'activité de l'entreprise
                            'number_employed' => rand(1, 100), // Nombre d'employés, généré aléatoirement
                            'tel_company' => '123-456-789' . $index, // Numéro de téléphone de l'entreprise
                            'mail_company' => 'contact@company' . $index . '.com', // Adresse e-mail de l'entreprise
                            'capital' => rand(10000, 100000), // Capital de l'entreprise, généré aléatoirement
                            'annual_pension' => rand(100000, 1000000), // Revenu annuel de l'entreprise, généré aléatoirement
                            'detail' => 'Details about Company ' . $index, // Détails supplémentaires sur l'entreprise
                            'post_occupation' => 'CEO', // Poste occupé par le client dans l'entreprise

                        ];
                        $email = 'entreprise' . $index . $uniqueId . '@example.com';
                    } else {
                        // Personne physique
                        $clientAttributes = [
                            'type_client' => 'pp',
                            'marital_status' => $index % 2 == 0 ? 'married' : 'single', // Alternance entre 'married' et 'single'
                            'occupation' => 'Client Occupation ' . $index,
                            'financial_information' => 'Good financial standing',
                            'number_of_dependents' => rand(0, 5), // Nombre aléatoire de personnes à charge
                            'source_of_income' => 'Employment',
                            'referral' => 'Internet',
                            'client_since' => now()->subYears(rand(1, 5))->format('Y-m-d'), // Date à laquelle ils sont devenus clients
                            'previous_loan_details' => 'No previous loans',
                            'client_type' => 'individual', // Par défaut, tous les clients sont des individus
                            'average_monthly_income' => rand(1000, 5000), // Revenu mensuel moyen généré aléatoirement
                            'ifu' => 'IFU12345' . $index,
                            'identity_piece' => 'ID Card',
                            'identity_picture' => 'default-id-pic.png',
                            'proof_of_address' => 'Utility Bill',
                        ];
                        $email = 'client' . $index . $uniqueId . '@example.com';
                    }

                    $commonAttributes['email'] = $email;
                    User::create(array_merge($commonAttributes, $clientAttributes));
                }
            }
        }
    }
}
