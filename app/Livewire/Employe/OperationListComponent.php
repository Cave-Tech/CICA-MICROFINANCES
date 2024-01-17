<?php

namespace App\Livewire\Employe;

use App\Models\Account;
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

        // Récupérer le compte de l'utilisateur
        $userAccount = Account::where('user_id', $operation->user_id)->first();

        // Vérifier si le statut du compte est bloqué
        if ($userAccount->status == 'blocked') {
            session()->flash('fail', "Opération impossible. Le compte est bloqué.");
            return;
        }

        $typeOperation = $operation->operation_type_id;
        $montant = $operation->withdrawal_amount;


        // Logique pour mettre à jour le solde en fonction du type d'opération
        switch ($typeOperation) {
            case 1: // Dépôt
                $userAccount->balance += $montant;
                $userAccount->save();
                break;
            case 2: // Retrait
                if ($userAccount->balance >= $montant) {
                    $userAccount->balance -= $montant;
                    $userAccount->save();
                } else {
                    session()->flash('fail', "Solde insuffisant pour effectuer le retrait.");
                    return;
                }
                break;
            case 3: // Virement
                // Vérifier si l'utilisateur a suffisamment de fonds pour le virement
                if ($userAccount->balance >= $montant) {
                    $userAccount->balance -= $montant;
                    $userAccount->save();
                    
                    // Mettre à jour le compte de destination
                    $destinationAccount = Account::where('account_number', $this->compte_de_destination)->first();
                    if ($destinationAccount) {
                        $destinationAccount->balance += $montant;
                        $destinationAccount->save();
                    } else {
                        session()->flash('fail', "Le compte de destination n'a pas été trouvé.");
                        return;
                    }
                } else {
                    session()->flash('fail', "Solde insuffisant pour effectuer le virement.");
                    return;
                }
                break;
            default:
                session()->flash('fail', "Type d'opération non pris en charge.");
                return;
        }
    


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

    public function mount()
    {
        $this->operations = Operation::with(['user', 'agent', 'operationType'])->orderBy('id', 'desc')->latest()->get();
    }


    public function render()
    {
        $this->operations = Operation::with(['user', 'agent', 'operationType'])
                            ->where('transaction_key', 'like', '%' . $this->search . '%')
                            ->orWhereHas('user', function($query) {
                                $query->where('name', 'like', '%' . $this->search . '%')
                                      ->orWhere('email', 'like', '%' . $this->search . '%');
                            })
                            //Trier par ordre decroissant
                            ->orderBy('id', 'desc')
                            ->latest()
                            ->get();
     
        return view('livewire.employe.operation-list-component');
    }
    
}

