<?php

namespace App\Livewire\Employe;

use App\Models\Loan;
use App\Models\Payment;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class ValidatedLoanComponent extends Component
{
    public $search = '';
    public $validatedLoan;
    public $detailsLoan;

    public function showDetails($loanId) {
        $this->detailsLoan = Loan::findOrFail($loanId)
                                    ->load(['borrower', 'agent', 'payment', 'loanType']);
        
        $this->dispatch('show-loan-modal'); // Ouvrez le modal avec JS
    }

    
    public function setvalidated($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->status = "in payment";
        $loan->loan_date = Carbon::now(); // Utiliser Carbon pour obtenir la date actuelle
        // Ajouter la durée du prêt en mois à la date de prêt
        $loan->due_date = $loan->loan_date->copy()->addMonths($loan->payment_frequency);

        $loan->save();

        // Calculer et créer les échéances de paiement
        $this->createPaymentSchedule($loan);

        // Émettre l'événement
        $this->dispatch('close-loan-modal');
    }

    private function createPaymentSchedule(Loan $loan)
    {
        $totalLoanAmount = $loan->loan_amount;
        $remainingAmount = $totalLoanAmount;
        $interestRate = $loan->interest_rate;
        $frequency = $loan->repayment_interval; // daily, weekly, monthly
        $loanDurationMonths = $loan->payment_frequency;
        $numberOfPayments = $this->calculateNumberOfPayments($frequency, $loanDurationMonths, $loan->loan_date);
        $startDate = $loan->loan_date;

        for ($i = 0; $i < $numberOfPayments; $i++) {
            $interestForThisPeriod = $remainingAmount * ($interestRate / 100 / $numberOfPayments);
            $principalForThisPeriod = ($totalLoanAmount / $numberOfPayments);
            $paymentAmount = $interestForThisPeriod + $principalForThisPeriod;

            $expectedPaymentDate = $this->calculateNextPaymentDate($startDate, $i, $frequency);

            Payment::create([
                'loan_id' => $loan->id,
                'payment_amount' => $paymentAmount,
                'status' => 'pending',
                'transaction_channel' => "neutre",
                'expected_payment_date' => $expectedPaymentDate,
                // Autres champs nécessaires...
            ]);

            $remainingAmount -= $principalForThisPeriod;
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
        $date = new DateTime($startDate);

        if ($frequency == 'daily') {
            return $date->modify("+$paymentNumber day")->format('Y-m-d');
        } elseif ($frequency == 'weekly') {
            return $date->modify("+$paymentNumber week")->format('Y-m-d');
        } elseif ($frequency == 'monthly') {
            return $date->modify("+$paymentNumber month")->format('Y-m-d');
        }
    }


    public function render()
    {

        $this->validatedLoan = Loan::with(['borrower', 'agent', 'payment', 'loanType'])
                                    ->where('status', 'validated')
                                    ->orWhere('status', 'in payment')
                                    ->where(function($query) {
                                        $query->where('loan_amount', 'like', '%' . $this->search . '%')
                                              ->orWhere('interest_rate', 'like', '%' . $this->search . '%')
                                              ->orWhere('payment_frequency', 'like', '%' . $this->search . '%')
                                              ->orWhere('loan_date', 'like', '%' . $this->search . '%')
                                              ->orWhere('due_date', 'like', '%' . $this->search . '%')
                                              
                                              ->orWhereHas('borrower', function($subQuery) {
                                                  $subQuery->where('name', 'like', '%' . $this->search . '%')
                                                           ->orWhere('email', 'like', '%' . $this->search . '%');
                                              })
                                              ->orWhereHas('agent', function($subQuery) {
                                                  $subQuery->where('name', 'like', '%' . $this->search . '%')
                                                           ->orWhere('email', 'like', '%' . $this->search . '%');
                                              })
                                              ->orWhereHas('loanType', function($subQuery) {
                                                  $subQuery->where('designation', 'like', '%' . $this->search . '%');
                                              });
                                    })
                                    ->get();

        return view('livewire.employe.validated-loan-component', [
            'loansInProgress' => $this->validatedLoan
        ]);
    }
}
