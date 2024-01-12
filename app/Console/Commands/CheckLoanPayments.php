<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Notifications\LoanPaymentOverdue;
use App\Notifications\LoanPaymentReminder;
use Carbon\Carbon;

class CheckLoanPayments extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-loan-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for upcoming and overdue loan payments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Vérifier les paiements à venir
        
        $upcomingPayments = Payment::with('loan.borrower')
                               ->where('expected_payment_date', $today->copy()->addDay())
                               ->where('status', '!=', 'validated')
                               ->get();
        foreach ($upcomingPayments as $payment) {
            // Assurez-vous que le paiement a un prêt associé et que le prêt a un emprunteur
            if ($payment->loan && $payment->loan->borrower) {
                $borrower = $payment->loan->borrower;
                $borrower->notify(new LoanPaymentReminder($payment));
            }
        }

        // Vérifier les paiements en retard
        $overduePayments = Payment::with('loan.borrower')
            ->where('expected_payment_date', '<', $today)
            ->where('status', '!=', 'validated')
            ->get();

        foreach ($overduePayments as $payment) {
            // Mise à jour du statut en 'late'
            $payment['status'] = 'late';

            // Appliquer des pénalités
            $this->applyPenalties($payment);

            // Enregistrer les modifications
            $payment->save();

            // Envoyer une notification de retard
            if ($payment->loan && $payment->loan->borrower) {
                $borrower = $payment->loan->borrower;
                $borrower->notify(new LoanPaymentOverdue($payment));
            }
        }
    }

    private function applyPenalties($payment)
    {
        $daysLate = Carbon::now()->diffInDays(Carbon::parse($payment->expected_payment_date), false);
        if ($daysLate > 0) {
            // Supposons un taux de pénalité de 1% par jour de retard
            $penaltyRatePerDay = 0.01; 
            $maxPenaltyRate = 0.20; // Plafond de 20% du montant du paiement

            $penalty = min($daysLate * $penaltyRatePerDay, $maxPenaltyRate) * $payment->payment_amount;
            
            // Mettre à jour le montant du paiement
            $payment->payment_amount += $penalty;
            $payment->penalty_amount = $penalty; // Supposons que vous ayez un champ pour stocker le montant de la pénalité
            $payment->save();
        }
    }

}
