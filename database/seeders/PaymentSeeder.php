<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = Loan::all();

        foreach ($loans as $loan) {
            $totalPayments = $loan->payment_frequency;  // Nombre total de paiements pour un prêt
            $amountPerPayment = $loan->loan_amount / $totalPayments;  // Montant de chaque paiement

            // Créer des paiements pour chaque prêt en fonction de la fréquence de paiement
            for ($i = 0; $i < $totalPayments; $i++) {
                Payment::create([
                    'loan_id' => $loan->id,
                    'user_id' => $loan->borrower_id,
                    'payment_amount' => $amountPerPayment,
                    'transaction_channel' => 'bank_transfer',  // Méthode de paiement
                    'payment_date' => \Carbon\Carbon::parse($loan->loan_date)->addMonths($i + 1),// La date de paiement sera la date du prêt + le nombre de mois de la fréquence
                    'status' => 'completed'
                ]);
            }
        }
    }
}
