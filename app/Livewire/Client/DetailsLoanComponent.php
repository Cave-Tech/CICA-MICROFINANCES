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
    public function showLoanDetails($loanId)
    {
        $this->loan = Loan::find($loanId); 
        return view('livewire.client.details-loan-component');
    }

    public function render()
    {
        return view('livewire.client.details-loan-component');
    }
}
