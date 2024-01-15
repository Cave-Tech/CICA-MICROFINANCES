<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientUsers = User::where('profile_id', 3)->get();

        foreach ($clientUsers as $client) {
            $accountNumber = $this->generateAccountNumber();
            $clientType = $client->type_client; // 'pp' ou 'pm'
            $openingDate = Carbon::now()->subMonths(rand(3, 12)); // Date d'ouverture entre 3 et 12 mois dans le passé

            Account::create([
                'user_id' => $client->id,
                'agent_id' => User::where('employee_type_id', 2)
                                  ->orWhere('employee_type_id', 5)
                                  ->inRandomOrder()
                                  ->first()
                                  ->id,
                'account_types_id' => 2, // ID pour compte épargne
                'balance' => rand(1000, 10000),  // Solde aléatoire entre 1000 et 10000
                'interest_rate' => rand(1, 5),   // Taux d'intérêt aléatoire entre 1% et 5%
                'opening_date' => $openingDate,
                'status' => 'activated', // Compte actif par défaut
                'account_number' => $accountNumber,
                'client_type' => $clientType,
                'account_pieces' => 'rien'
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
