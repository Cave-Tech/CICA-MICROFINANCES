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

        User::create(['email' => 'admin@gmail.com', 'name' => 'Joa Do1', 'profile_id' => 2, 'password' => Hash::make('admin'), 'status' => 'activated']);
        User::create(['email' => 'superadmin@gmail.com', 'name' => 'Joa Do2', 'profile_id' => 1, 'password' => Hash::make('admin'), 'status' => 'activated']);
        User::create(['email' => 'client@gmail.com', 'name' => 'Joa Do3', 'profile_id' => 3, 'password' => Hash::make('admin'), 'status' => 'activated']);
        User::create(['email' => 'directeur@gmail.com', 'name' => 'Joa Do4', 'profile_id' => 4, 'password' => Hash::make('admin'), 'status' => 'activated', 'employee_type_id' => 4]);
        User::create(['email' => 'caissier@gmail.com', 'name' => 'Joa Do5', 'profile_id' => 4, 'password' => Hash::make('admin'), 'status' => 'activated', 'employee_type_id' => 1]);
        User::create(['email' => 'agent_terrain@gmail.com', 'name' => 'Joa Do6', 'profile_id' => 4, 'password' => Hash::make('admin'), 'status' => 'activated', 'employee_type_id' => 3]);
        User::create(['email' => 'comptable@gmail.com', 'name' => 'Joa Do7', 'profile_id' => 4, 'password' => Hash::make('admin'), 'status' => 'activated', 'employee_type_id' => 2]);
        User::create(['email' => 'agent_rh@gmail.com', 'name' => 'Joa Do8', 'profile_id' => 4, 'password' => Hash::make('admin'), 'status' => 'activated', 'employee_type_id' => 6]);
        User::create(['email' => 'charger_client@gmail.com', 'name' => 'Joa Do9', 'profile_id' => 4, 'password' => Hash::make('admin'), 'status' => 'activated', 'employee_type_id' => 5]);
        

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
