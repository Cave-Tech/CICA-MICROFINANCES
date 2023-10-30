<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use Livewire\Component;

class OperationDetailsComponent extends Component
{
    public $operationId;

    public $operations, $operation, $name, $id_type, $id_number, $withdrawal_amount, $withdrawal_method, $transaction_key, $status, $withdrawal_date, $operation_type;

    public $showModal = false;

    protected $listeners = ['showModal' => 'openModal'];

    public function openModal($operationId)
    {
        $this->operation = Operation::with(['user', 'agent', 'operationType'])->find($operationId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
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
