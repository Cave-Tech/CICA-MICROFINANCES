<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use App\Models\LoanUserPam;
use App\Models\LoanUserPams;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientUsers = User::where('profile_id', 3)->get();
        $loanStatuses = ['pending', 'validated', 'rejected'];
        $repaymentIntervals = ['daily', 'weekly', 'monthly'];
        $loanReasons = ['Personal Expenses', 'Business Investment', 'Education', 'Home Improvement'];

        // Créer des prêts individuels
        foreach ($clientUsers->where('type_client', 'pp')->take(5) as $client) {
            $loanType = rand(1, 2);  // Type de prêt 1 ou 2
            $this->createLoan($client, $loanType, $loanStatuses, $repaymentIntervals, $loanReasons);
        }

        // Créer un prêt groupé pour les clients suivants de type 'pp'
        $groupLoan = $this->createLoan($clientUsers->where('type_client', 'pp')->skip(5)->first(), 3, $loanStatuses, $repaymentIntervals, $loanReasons);

        // Ajouter les autres clients 'pp' au prêt groupé
        foreach ($clientUsers->where('type_client', 'pp')->skip(6) as $groupMember) {
            LoanUserPams::create([
                'loan_id' => $groupLoan->id,
                'user_id' => $groupMember->id,
            ]);
        }
    }

    private function createLoan($client, $loanType, $loanStatuses, $repaymentIntervals, $loanReasons)
    {
        $monthsBefore = rand(6, 12); // Durée avant aujourd'hui en mois
        $loanDate = Carbon::now()->subMonths($monthsBefore);

        // Calcul de la fréquence de paiement pour couvrir jusqu'au mois en cours
        $currentMonth = Carbon::now()->month;
        $loanEndMonth = $loanDate->month;
        $paymentFrequency = ($currentMonth - $loanEndMonth + 12) % 12;
        $paymentFrequency = $paymentFrequency == 0 ? 12 : $paymentFrequency; // Assurez-vous que la fréquence n'est jamais 0
        $paymentFrequency += $monthsBefore; // Ajoutez les mois depuis le début du prêt

        $dueDate = $loanDate->copy()->addMonths($paymentFrequency);

        return Loan::create([
            'borrower_id' => $client->id,
            'agent_id' => User::where('employee_type_id', 3)
                              ->inRandomOrder()
                              ->first()
                              ->id,
            'loan_type_id' => $loanType,
            'loan_amount' => rand(5000, 20000),
            'interest_rate' => rand(3, 7) / 100,
            'payment_frequency' => $paymentFrequency,
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'status' => $loanStatuses[array_rand($loanStatuses)],
            'applicant_type' => $client->type_client, // pp ou pm
            'repayment_interval' => $repaymentIntervals[array_rand($repaymentIntervals)],
            'loan_reason' => $loanReasons[array_rand($loanReasons)],
            'loan_pieces' => 'loan_piece.jpg',
        ]);
    }
}
