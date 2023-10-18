<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountType;
use App\Models\EmployeeType;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\OperationType;
use App\Models\Profile;
use Illuminate\Database\Seeder;

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

        LoanType::create(['designation' => 'pret_automobile', 'description' => 'pret automobile']);
        LoanType::create(['designation' => 'pret_immobilier', 'description' => 'pret immobilier']);

        OperationType::create(['designation' => 'depot', 'description' => 'depot']);
        OperationType::create(['designation' => 'retrait', 'description' => 'retrait']);
        OperationType::create(['designation' => 'virement', 'description' => 'virement']);

        

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
