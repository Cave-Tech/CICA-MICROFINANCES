<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class DetailCustomerComponent extends Component
{
    public $customer;
    public function mount($customerId)
    {
        $this->customer = User::with(['account', 'operation', 'loan', 'profile', 'employeType'])
            ->find($customerId);
        
        // Ajoutez la relation pour récupérer les prêts triés par ordre décroissant de loan_amount
        $this->customer->load(['loan' => function ($query) {
            $query->orderBy('loan_amount', 'desc');
        }]);
    }

    public function render()
    {
        return view('livewire.employe.detail-customer-component');
    }
}
