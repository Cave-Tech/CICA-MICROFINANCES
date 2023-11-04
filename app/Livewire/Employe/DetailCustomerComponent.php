<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class DetailCustomerComponent extends Component
{
    public $customer;
    public function mount($customerId)
    {
        $this->customer = User::with(['account', 'operation', 'loan', 'profile', 'employeeType'])
            ->find($customerId);

        // dd($this->customer);
    }

    public function render()
    {
        return view('livewire.employe.detail-customer-component');
    }
}
