<?php

namespace App\Livewire\Employe;

use App\Models\Loan;
use Carbon\Carbon;
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

        // Émettre l'événement
        $this->dispatch('close-loan-modal');
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
