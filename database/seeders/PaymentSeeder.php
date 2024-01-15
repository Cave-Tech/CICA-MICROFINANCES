<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use DateTime;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = Loan::all();
        $paymentStatuses = ['pending', 'validated'];

        // Récupérer les IDs des agents (employee_type_id = 3)
        $agentIds = User::where('employee_type_id', 3)->pluck('id')->toArray();

        foreach ($loans as $loan) {
            // Choisir un agent au hasard pour tous les paiements de ce prêt
            $randomAgentId = $agentIds[array_rand($agentIds)];

            $numberOfPayments = $this->calculateNumberOfPayments($loan->repayment_interval, $loan->payment_frequency, $loan->loan_date);
            $startDate = new DateTime($loan->loan_date);
            $totalLoanAmount = $loan->loan_amount;
            $totalInterest = $totalLoanAmount * ($loan->interest_rate / 100);
            $totalAmountToPay = $totalLoanAmount + $totalInterest;
            $totalPaid = 0;

            for ($i = 0; $i < $numberOfPayments; $i++) {
                $paymentAmount = $this->calculatePaymentAmount($i, $numberOfPayments, $totalLoanAmount, $totalInterest, $totalAmountToPay, $totalPaid);
                $expectedPaymentDate = $this->calculateNextPaymentDate($startDate, $i, $loan->repayment_interval);
                $status = $paymentStatuses[array_rand($paymentStatuses)];

                Payment::create([
                    'loan_id' => $loan->id,
                    'user_id' => $randomAgentId,
                    'payment_amount' => $paymentAmount,
                    'transaction_channel' => 'bank_transfer',
                    'payment_date' => $status == 'validated' ? $expectedPaymentDate : null,
                    'expected_payment_date' => $expectedPaymentDate,
                    'status' => $status
                ]);

                $totalPaid += $paymentAmount;
            }
        }
    }

    private function calculateNumberOfPayments($frequency, $loanDurationMonths, $startDate)
    {
        
        if ($frequency == 'daily') {
            return $this->calculateTotalDays($startDate, $loanDurationMonths);
        } elseif ($frequency == 'weekly') {
            return ceil($this->calculateTotalDays($startDate, $loanDurationMonths) / 7);
        } elseif ($frequency == 'monthly') {
            return $loanDurationMonths;
        }
    }

    private function calculateTotalDays($startDate, $loanDurationMonths)
    {
        $totalDays = 0;
        $date = new DateTime($startDate);

        for ($i = 0; $i < $loanDurationMonths; $i++) {
            $totalDays += $date->format('t'); // Nombre de jours dans le mois
            $date->modify('+1 month');
        }

        return $totalDays;
    }

    private function calculateNextPaymentDate($startDate, $paymentNumber, $frequency)
    {
        // Clone l'objet DateTime si nécessaire pour éviter les modifications directes
        $date = $startDate instanceof DateTime ? clone $startDate : new DateTime($startDate);

        if ($frequency == 'daily') {
            return $date->modify("+$paymentNumber day")->format('Y-m-d');
        } elseif ($frequency == 'weekly') {
            return $date->modify("+$paymentNumber week")->format('Y-m-d');
        } elseif ($frequency == 'monthly') {
            return $date->modify("+$paymentNumber month")->format('Y-m-d');
        }
    }


    private function calculatePaymentAmount($currentIndex, $totalPayments, $loanAmount, $totalInterest, $totalAmountToPay, &$totalPaid)
    {
        if ($currentIndex == $totalPayments - 1) {
            // Pour le dernier paiement, ajustez pour correspondre au montant total restant
            $paymentAmount = max($totalAmountToPay - $totalPaid, 0); // Empêche les valeurs négatives
        } else {
            $interestForThisPeriod = $totalInterest / $totalPayments;
            $principalForThisPeriod = $loanAmount / $totalPayments;
            $paymentAmount = $interestForThisPeriod + $principalForThisPeriod;

            // Arrondissez chaque paiement pour éviter les centimes
            $paymentAmount = round($paymentAmount, 0);
        }

        $totalPaid += $paymentAmount;
        return $paymentAmount; // Retourne le montant calculé du paiement
    }


}
