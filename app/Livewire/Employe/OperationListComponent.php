<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use Livewire\Component;

class OperationListComponent extends Component
{
    public $operations, $operationId, $detailsOperation, $name, $email, $id_type, $id_number, $withdrawal_amount, $withdrawal_method, $transaction_key, $status, $withdrawal_date, $operation_type;

    

    public function setCompleted($operationId)
    {
        $operation = Operation::findOrFail($operationId);
        $operation->status = "completed";
        $operation->save();

        // Ici, vous pouvez ajouter une session flash ou d'autres actions selon vos besoins
    }

    public function setCancelled($operationId)
    {
        $operation = Operation::findOrFail($operationId);
        $operation->status = "cancelled";
        $operation->save();

        // Ici, vous pouvez ajouter une session flash ou d'autres actions selon vos besoins
    }

    public function showDetails($operationId)
    {
        $this->detailsOperation = Operation::with(['user', 'agent', 'operationType'])->find($operationId);

        // $this->$operationId = $operationId;
        // $this->name = $this->operation->user->name;
        // $this->email = $this->operation->user->email;
        // $this->id_type = $this->operation->user->id_type;
        // $this->id_number = $this->operation->user->id_number;
        // $this->withdrawal_amount = $this->operation->withdrawal_amount;
        // $this->withdrawal_method = $this->operation->withdrawal_method;
        // $this->transaction_key = $this->operation->transaction_key;
        // $this->status = $this->operation->status;
        // $this->withdrawal_date = $this->operation->withdrawal_date;
        // $this->operation_type = $this->operation->operationType->designation;
    }
        

    public function render()
    {
        $this->operations = Operation::with(['user', 'agent', 'operationType'])->get();
 
        return view('livewire.employe.operation-list-component');
    }
}

