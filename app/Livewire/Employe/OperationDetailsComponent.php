<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use Livewire\Component;

class OperationDetailsComponent extends Component
{
    public $operationId;
    public $operation;

    protected $listeners = ['showOperationDetail' => 'loadOperation'];

    public function loadOperation($operationId)
    {
        $this->operationId = $operationId;
        $this->operation = Operation::find($this->operationId);
    }

    public function completeOperation()
    {
        $this->operation->status = 'completed';
        $this->operation->save();

        $this->emit('alert', ['type' => 'success', 'message' => 'Opération mise à jour avec succès!']);
    }

    public function cancelOperation()
    {
        $this->operation->status = 'canceled';
        $this->operation->save();

        $this->emit('alert', ['type' => 'error', 'message' => 'Opération annulée!']);
    }

    public function render()
    {
        return view('livewire.employe.operation-details-component');
    }
}
