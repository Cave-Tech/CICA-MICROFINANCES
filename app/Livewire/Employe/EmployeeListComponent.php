<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class EmployeeListComponent extends Component
{
    public  $employeeLists;
    public function mount(){
        $this->employeeLists = User::with('profile')->where('profile_id', 4)->get();
    }


    public function render()
    {
        return view('livewire.employe.employee-list-component');
    }
}
