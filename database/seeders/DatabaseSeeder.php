<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountType;
use App\Models\EmployeeType;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\OperationType;
use App\Models\Profile;
use App\Models\User;
use Faker\Provider\UserAgent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AccountType::create(['designation' => 'courant', 'description' => 'compte courant']);
        AccountType::create(['designation' => 'epargne', 'description' => 'compte epargne']);

        Profile::create(['designation' => 'superadmin']);
        Profile::create(['designation' => 'admin']);
        Profile::create(['designation' => 'client']);
        Profile::create(['designation' => 'employe']);

        EmployeeType::create(['designation' => 'caissier', 'description' => 'Caissier']);
        EmployeeType::create(['designation' => 'comptable', 'description' => 'Comptable']);
        EmployeeType::create(['designation' => 'agent_terrain', 'description' => 'Agent de terrain']);
        EmployeeType::create(['designation' => 'directeur', 'description' => 'Directeur']);
        EmployeeType::create(['designation' => 'charger_client', 'description' => 'Le charger de la clientele']);
        EmployeeType::create(['designation' => 'charger_rh', 'description' => 'Charger ressource humaine']);

        LoanType::create(['designation' => 'pret_automobile', 'description' => 'pret automobile']);
        LoanType::create(['designation' => 'pret_immobilier', 'description' => 'pret immobilier']);

        OperationType::create(['designation' => 'depot', 'description' => 'depot']);
        OperationType::create(['designation' => 'retrait', 'description' => 'retrait']);
        OperationType::create(['designation' => 'virement', 'description' => 'virement']);

                
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Joa Do1',
            'profile_id' => 2,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'agent_id' => null,
            'gender' => 'male', 
            'birth_date' => '1990-01-01', 
            'nationality' => 'Unknown', 
            'phone' => '1234567890', 
            'address' => '123 Main St', 
            'id_type' => 'card', 
            'id_number' => '12345', 
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'employee_type_id' => null,
            'hiring_date' => '2022-01-01', 
            'position' => 'Admin', 
            'department' => 'Administration', 
            'contract_type' => 'full-time', 
            'salary' => 5000, 
            'education_level' => 'Bachelor', 
            'specific_training' => null,
            'certifications' => null,
            'social_security_number' => '123-45-6789', 
            'bank_name' => 'Bank of XYZ', 
            'bank_account_number' => '12345678', 
            'emergency_contact_name' => 'John Doe', 
            'emergency_contact_relation' => 'Friend', 
            'emergency_contact_phone' => '0987654321', 
            'marital_status' => 'single', 
            'occupation' => 'Administrator', 
            'financial_information' => null,
            'number_of_dependents' => 0, 
            'source_of_income' => 'Salary', 
            'referral' => null,
            'client_since' => '2022-01-01', 
            'previous_loan_details' => null,
            'client_type' =>  'group', 
            'average_monthly_income' => 4000 
        ]);

        User::create([
            'email' => 'superadmin@gmail.com',
            'name' => 'Joa Do2',
            'profile_id' => 1,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            // New attributes
            'agent_id' => null,
            'gender' => 'male',
            'birth_date' => '1988-05-15',
            'nationality' => 'Unknown',
            'phone' => '2345678901',
            'address' => '124 Main St',
            'id_type' => 'Passport',
            'id_number' => 'A12345',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'employee_type_id' => null,
            'hiring_date' => '2021-01-10',
            'position' => 'Super Admin',
            'department' => 'Administration',
            'contract_type' =>  'part-time',
            'salary' => 6000,
            'education_level' => 'Masters',
            'specific_training' => null,
            'certifications' => null,
            'social_security_number' => '234-56-7890',
            'bank_name' => 'Bank of XYZ',
            'bank_account_number' => '23456789',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_relation' => 'Spouse',
            'emergency_contact_phone' => '0987654322',
            'marital_status' => 'married',
            'occupation' => 'Administrator',
            'financial_information' => null,
            'number_of_dependents' => 2,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => '2021-05-10',
            'previous_loan_details' => null,
            'client_type' => 'individual',
            'average_monthly_income' => 5800
        ]);

        User::create([
            'email' => 'client@gmail.com',
            'name' => 'Joa Do3',
            'profile_id' => 3,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            // New attributes
            'agent_id' => null,
            'gender' => 'male',
            'birth_date' => '1990-06-25',
            'nationality' => 'Unknown',
            'phone' => '2345678902',
            'address' => '125 Main St',
            'id_type' => 'card',
            'id_number' => 'B23456',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'employee_type_id' => null,
            'hiring_date' => null,
            'position' => null,
            'department' => null,
            'contract_type' => null,
            'salary' => null,
            'education_level' => 'Bachelors',
            'specific_training' => null,
            'certifications' => null,
            'social_security_number' => '235-67-8901',
            'bank_name' => 'Bank of XYZ',
            'bank_account_number' => '23456790',
            'emergency_contact_name' => 'John Doe',
            'emergency_contact_relation' => 'Brother',
            'emergency_contact_phone' => '0987654323',
            'marital_status' => 'single',
            'occupation' => 'Client',
            'financial_information' => null,
            'number_of_dependents' => 0,
            'source_of_income' => 'Business',
            'referral' => null,
            'client_since' => '2022-01-15',
            'previous_loan_details' => null,
            'client_type' =>  'group',
            'average_monthly_income' => 4000
        ]);

        User::create([
            'email' => 'directeur@gmail.com',
            'name' => 'Joa Do4',
            'profile_id' => 4,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'employee_type_id' => 4,
            // New attributes
            'agent_id' => null,
            'gender' => 'male',
            'birth_date' => '1985-05-10',
            'nationality' => 'Unknown',
            'phone' => '2345678903',
            'address' => '126 Main St',
            'id_type' => 'Passport',
            'id_number' => 'C12345',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'hiring_date' => '2020-01-05',
            'position' => 'Director',
            'department' => 'Management',
            'contract_type' => 'temporary',
            'salary' => 10000,
            'education_level' => 'Masters',
            'specific_training' => 'Leadership',
            'certifications' => null,
            'social_security_number' => '236-67-8912',
            'bank_name' => 'Global Bank',
            'bank_account_number' => '1234567890',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_relation' => 'Sister',
            'emergency_contact_phone' => '0987654324',
            'marital_status' => 'married',
            'occupation' => 'Director',
            'financial_information' => null,
            'number_of_dependents' => 2,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => null,
            'previous_loan_details' => null,
            'client_type' => null,
            'average_monthly_income' => null
        ]);
        
        User::create([
            'email' => 'caissier@gmail.com',
            'name' => 'Joa Do5',
            'profile_id' => 4,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'employee_type_id' => 1,
            // New attributes
            'agent_id' => null,
            'gender' => 'female',
            'birth_date' => '1990-04-15',
            'nationality' => 'Unknown',
            'phone' => '2345678904',
            'address' => '127 Main St',
            'id_type' => 'card',
            'id_number' => 'D23456',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'hiring_date' => '2019-06-10',
            'position' => 'Cashier',
            'department' => 'Finance',
            'contract_type' => 'part-time',
            'salary' => 5000,
            'education_level' => 'Diploma',
            'specific_training' => 'Cash Handling',
            'certifications' => null,
            'social_security_number' => '237-68-8913',
            'bank_name' => 'Local Bank',
            'bank_account_number' => '1234567891',
            'emergency_contact_name' => 'Jim Doe',
            'emergency_contact_relation' => 'Brother',
            'emergency_contact_phone' => '0987654325',
            'marital_status' => 'single',
            'occupation' => 'Cashier',
            'financial_information' => null,
            'number_of_dependents' => 0,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => null,
            'previous_loan_details' => null,
            'client_type' => null,
            'average_monthly_income' => null
        ]);

        User::create([
            'email' => 'agent_terrain@gmail.com',
            'name' => 'Joa Do6',
            'profile_id' => 4,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'employee_type_id' => 3,
            // New attributes
            'agent_id' => null,
            'gender' => 'male',
            'birth_date' => '1988-08-12',
            'nationality' => 'Unknown',
            'phone' => '2345678905',
            'address' => '128 Green St',
            'id_type' => 'card',
            'id_number' => 'E34567',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'hiring_date' => '2021-02-15',
            'position' => 'Field Agent',
            'department' => 'Operations',
            'contract_type' => 'temporary',
            'salary' => 6000,
            'education_level' => 'Bachelor’s',
            'specific_training' => 'Field Operations',
            'certifications' => null,
            'social_security_number' => '238-69-8914',
            'bank_name' => 'State Bank',
            'bank_account_number' => '1234567892',
            'emergency_contact_name' => 'Jess Doe',
            'emergency_contact_relation' => 'Cousin',
            'emergency_contact_phone' => '0987654326',
            'marital_status' => 'married',
            'occupation' => 'Field Agent',
            'financial_information' => null,
            'number_of_dependents' => 1,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => null,
            'previous_loan_details' => null,
            'client_type' => null,
            'average_monthly_income' => null
        ]);
        
        User::create([
            'email' => 'comptable@gmail.com',
            'name' => 'Joa Do7',
            'profile_id' => 4,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'employee_type_id' => 2,
            // New attributes
            'agent_id' => null,
            'gender' => 'female',
            'birth_date' => '1987-09-09',
            'nationality' => 'Unknown',
            'phone' => '2345678906',
            'address' => '129 Blue St',
            'id_type' => 'passport',
            'id_number' => 'F45678',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'hiring_date' => '2018-03-20',
            'position' => 'Accountant',
            'department' => 'Finance',
            'contract_type' => null,
            'salary' => 7000,
            'education_level' => 'Master’s in Finance',
            'specific_training' => 'Accounting',
            'certifications' => 'Certified Public Accountant',
            'social_security_number' => '239-70-8915',
            'bank_name' => 'Regional Bank',
            'bank_account_number' => '1234567893',
            'emergency_contact_name' => 'Jake Doe',
            'emergency_contact_relation' => 'Uncle',
            'emergency_contact_phone' => '0987654327',
            'marital_status' => 'married',
            'occupation' => 'Accountant',
            'financial_information' => null,
            'number_of_dependents' => 2,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => null,
            'previous_loan_details' => null,
            'client_type' => null,
            'average_monthly_income' => null
        ]);

        User::create([
            'email' => 'agent_rh@gmail.com',
            'name' => 'Joa Do8',
            'profile_id' => 4,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'employee_type_id' => 6,
            // New attributes
            'agent_id' => null,
            'gender' => 'female',
            'birth_date' => '1987-09-09',
            'nationality' => 'Unknown',
            'phone' => '2345678906',
            'address' => '129 Blue St',
            'id_type' => 'passport',
            'id_number' => 'F45678',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'hiring_date' => '2018-03-20',
            'position' => 'Accountant',
            'department' => 'Finance',
            'contract_type' => 'full-time',
            'salary' => 7000,
            'education_level' => 'Master’s in Finance',
            'specific_training' => 'Accounting',
            'certifications' => 'Certified Public Accountant',
            'social_security_number' => '239-70-8915',
            'bank_name' => 'Regional Bank',
            'bank_account_number' => '1234567893',
            'emergency_contact_name' => 'Jake Doe',
            'emergency_contact_relation' => 'Uncle',
            'emergency_contact_phone' => '0987654327',
            'marital_status' => 'married',
            'occupation' => 'Accountant',
            'financial_information' => null,
            'number_of_dependents' => 2,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => null,
            'previous_loan_details' => null,
            'client_type' => null,
            'average_monthly_income' => null
        ]);

        User::create([
            'email' => 'charger_client@gmail.com',
            'name' => 'Joa Do9',
            'profile_id' => 4,
            'password' => Hash::make('admin'),
            'status' => 'activated',
            'employee_type_id' => 5,
            // New attributes
            'agent_id' => null,
            'gender' => 'female',
            'birth_date' => '1987-09-09',
            'nationality' => 'Unknown',
            'phone' => '2345678906',
            'address' => '129 Blue St',
            'id_type' => 'passport',
            'id_number' => 'F45678',
            'profile_picture' => 'default-profile-icon.png',
            'email_verified_at' => null,
            'hiring_date' => '2018-03-20',
            'position' => 'Accountant',
            'department' => 'Finance',
            'contract_type' => 'part-time',
            'salary' => 7000,
            'education_level' => 'Master’s in Finance',
            'specific_training' => 'Accounting',
            'certifications' => 'Certified Public Accountant',
            'social_security_number' => '239-70-8915',
            'bank_name' => 'Regional Bank',
            'bank_account_number' => '1234567893',
            'emergency_contact_name' => 'Jake Doe',
            'emergency_contact_relation' => 'Uncle',
            'emergency_contact_phone' => '0987654327',
            'marital_status' => 'married',
            'occupation' => 'Accountant',
            'financial_information' => null,
            'number_of_dependents' => 2,
            'source_of_income' => 'Salary',
            'referral' => null,
            'client_since' => null,
            'previous_loan_details' => null,
            'client_type' => null,
            'average_monthly_income' => null
        ]);

        $this->call(UserSeeder::class);
         $this->call(AccountSeeder::class);
         $this->call(OperationSeeder::class);
         $this->call(LoanSeeder::class);
         $this->call(PaymentSeeder::class);

       
         

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
