<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientUsers = User::where('profile_id', 3)->get();

        foreach ($clientUsers as $client) {
            Account::create([
                'user_id' => $client->id,
                'agent_id'=> User::where('employee_type_id', 2)
                                    ->orWhere('employee_type_id', 5)
                                    ->inRandomOrder()
                                    ->first()
                                    ->id,
                'account_types_id' => rand(1, 2), // Pour varier entre compte courant et épargne
                'balance' => rand(1000, 10000),  // Solde entre 1000 et 10000
                'interest_rate' => rand(1, 5),   // Taux d'intérêt entre 1% et 5%
                'opening_date' => now(),
                'status' => 'active'
            ]);
        }
    }
}
