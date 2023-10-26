<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use Livewire\Component;

class OperationListComponent extends Component
{
    public $operations;
    public function render()
    {
        $this->operations=Operation::All();
        return view('livewire.employe.operation-list-component');
    }
}
