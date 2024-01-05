<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientUsers = User::where('profile_id', 3)->get();
        $statuses = ['pending', 'validated', 'rejected'];

        foreach ($clientUsers as $client) {
            foreach (range(1, 20) as $index) {
                $loanDate = now();  // Date actuelle
                $paymentFrequency = rand(1, 12);  // Fréquence de paiement entre 1 et 12 mois
                $dueDate = $loanDate->copy()->addMonths($paymentFrequency);  // Date d'échéance après les mois de fréquence de paiement

                Loan::create([
                    'borrower_id' => $client->id,
                    'agent_id' => User::where('employee_type_id', 2)
                                    ->orWhere('employee_type_id', 4)
                                    ->inRandomOrder()
                                    ->first()
                                    ->id, 
                    'loan_type_id' => rand(1, 3),  // Pour varier entre prêt automobile, prêt immobilier et prêt groupé
                    'loan_amount' => rand(5000, 20000),  // Montant du prêt entre 5000 et 200000
                    'interest_rate' => rand(3, 7) / 100,  // Taux d'intérêt entre 3% et 7%
                    'payment_frequency' => $paymentFrequency,
                    'loan_date' => $loanDate,
                    'due_date' => $dueDate,
                    'status' => $statuses[array_rand($statuses)]// Statut aléatoire parmi 'pending', 'validated', 'rejected'
                ]);
            }
            
        }
    }
}
