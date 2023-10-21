<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class CustomerListComponent extends Component
{

    public  $customerLists;
    public function mount(){
        $this->customerLists = User::with('profile')->where('profile_id', 3)->get();
    }

    public function render()
    {
        return view('livewire.employe.customer-list-component');
    }
}
