<?php

namespace App\Livewire\Employe;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
class ListPayementComponent extends Component
{
    public $loanInProgress;
    public function render()
    {
        $agentPayments = Payment::with(['loan.borrower', 'loan.agent', 'loan.loanType', 'loan'])
        ->where('user_id', auth()->user()->id)
        ->get();
        return view('livewire.employe.list-payement-component',['agentPayments' => $agentPayments]);
    }
}
