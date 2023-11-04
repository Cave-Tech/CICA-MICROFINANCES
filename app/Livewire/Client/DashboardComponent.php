<?php

namespace App\Livewire\Client;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Account;
use App\Models\Loan;

class DashboardComponent extends Component
{
    public $user;
    public function render()
    {
        $userid = Auth::user()->id;
        $this->user = User::with('account', 'operation', 'loan')->find($userid);
        return view('livewire.client.dashboard-component');
    }
}
