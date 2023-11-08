<?php
namespace App\Livewire\Client;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Account;
use App\Models\Loan;

class DetailsLoanComponent extends Component
{
    public $loan;
    public function mount($loanId)
    {
        $this->loan = Loan::with(['borrower', 'agent', 'payment'])
        ->find($loanId);
    }

    public function render()
    {
        return view('livewire.client.details-loan-component');
    }
}
