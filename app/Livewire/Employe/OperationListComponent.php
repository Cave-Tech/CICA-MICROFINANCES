<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use Livewire\Component;

class OperationListComponent extends Component
{
    public $operations;
    public function render()
    {
        $this->operations = Operation::with(['user', 'agent', 'operationType'])->get();
 
        return view('livewire.employe.operation-list-component');
    }
}
