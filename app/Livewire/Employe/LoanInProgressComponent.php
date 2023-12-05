<?php
namespace App\Livewire\Employe;

use App\Models\Loan;
use Livewire\Component;

class LoanInProgressComponent extends Component
{
    public $search = '';
    public $loanInProgress;

    public function render()
    {
        $this->loanInProgress = Loan::with(['borrower', 'agent', 'payment', 'loanType'])
                                    ->where('status', 'in progress')
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

        return view('livewire.employe.loan-in-progress-component', [
            'loansInProgress' => $this->loanInProgress
        ]);
    }
}
