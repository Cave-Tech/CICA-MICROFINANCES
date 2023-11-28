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
        $statuses = ['activated', 'blocked', 'pending'];

        foreach ($clientUsers as $client) {
            $accountNumber = $this->generateAccountNumber();
            
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
                'status' => $statuses[array_rand($statuses)],
                'account_number' => $accountNumber,
            ]);
        }
    }

    /**
     * Générer un numéro de compte unique.
     */
    private function generateAccountNumber(): string
    {
        $prefix = 'MF'; // Préfixe pour Microfinance
        $randomPart = mt_rand(100000, 999999); // Partie aléatoire
        $checkDigit = $this->generateCheckDigit($randomPart);

        return $prefix . $randomPart . $checkDigit;
    }

    /**
     * Générer un chiffre de contrôle (check digit) pour le numéro de compte.
     */
    private function generateCheckDigit(int $number): int
    {
        // Logique pour générer un chiffre de contrôle, par exemple, une somme de contrôle simple.
        return array_sum(str_split($number)) % 10;
    }
}
