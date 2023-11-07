<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use Livewire\Component;

class OperationListComponent extends Component
{
    public $operations, $operationId, $detailsOperation, $name, $email, $id_type, $id_number, $withdrawal_amount, $withdrawal_method, $transaction_key, $status, $withdrawal_date, $operation_type;
    
    public $search = '';


    public function resetListener()
    {
        $this->reset('detailsOperation'); // Réinitialisez les propriétés que vous souhaitez remettre à zéro.
    }


    public function setCompleted($operationId)
    {
        $operation = Operation::findOrFail($operationId);
        $operation->status = "completed";
        $operation->save();

        // Émettre l'événement
        $this->dispatch('close-operation-modal');
        // Ici, vous pouvez ajouter une session flash ou d'autres actions selon vos besoins
    }

    public function setCancelled($operationId)
    {
        $operation = Operation::findOrFail($operationId);
        $operation->status = "canceled";
        $operation->save();

        $this->dispatch('close-operation-modal');
    }

    // public function showDetails($operationId)
    // {
    //     $this->detailsOperation = Operation::with(['user', 'agent', 'operationType'])->find($operationId);
    // }

    public function showDetails($operationId) {
        $this->detailsOperation = Operation::findOrFail($operationId);
        $this->dispatch('show-operation-modal'); // Ouvrez le modal avec JS
    }
    
    public function closeDetails() {
        $this->dispatch('close-operation-modal'); // Fermez le modal avec JS
    }


    public function render()
    {
        $this->operations = Operation::with(['user', 'agent', 'operationType'])
                            ->where('transaction_key', 'like', '%' . $this->search . '%')
                            ->orWhereHas('user', function($query) {
                                $query->where('name', 'like', '%' . $this->search . '%')
                                      ->orWhere('email', 'like', '%' . $this->search . '%');
                            })
                            ->get();
     
        return view('livewire.employe.operation-list-component');
    }
    
}

