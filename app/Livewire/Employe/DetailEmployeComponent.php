<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class DetailEmployeComponent extends Component
{
    public $employe;
    public function mount($employeId)
    {
        $this->employe = User::with(['account', 'operation', 'loan', 'profile', 'employeType'])
            ->find($employeId);

        // dd($this->employe);
    }
    
    public function render()
    {
        return view('livewire.employe.detail-employe-component');
    }
}
