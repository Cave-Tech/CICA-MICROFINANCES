<?php

namespace App\Livewire\Client;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Account;
use App\Models\Loan;


class OperationsComponent extends Component
{

    //generation de code aleatoir
    public $randomString;
    //Enregistrement de l'operation
    public $operationId;
    public $typeOperation;
    public $typeAccount;
    public $montant;
    public $method = "neutre";
    public $status = "en cours";
    public $beneficiaire;
    public $compte_de_destination;
    public $motif;
    public $date;

    public function saveOperation()
    {
        $user = Auth::user();
        $userId = $user->id;
        $user = User::with('account')->find($userId);
        //dd($user->account->balance);
        $montant = $this->montant;
        $typeOperation = $this->typeOperation;

        if ($typeOperation == 2) { 
            $solde = $user->account->first()->balance;
                if ($solde < $montant or $montant == 0) {
                    return redirect('/client-operations')->with("fail", "Retrait impossible.");
                }else{
                    $operation = new Operation();
                    $operation->user_id = $this->userId = $user->id;
                    $operation->operation_type_id = $this->typeOperation;
                    $operation->withdrawal_amount = $this->montant;
                    $operation->withdrawal_method = $this->method;
                    $operation->transaction_key = $this->randomString = Str::random(10);
                    $operation->status = $this->status;
                    $operation->beneficiaire = $this->beneficiaire;
                    $operation->compte_destination = $this->compte_de_destination;
                    $operation->motif = $this->motif;
                    $operation->account_types_id = $this->typeAccount;
                    $operation->withdrawal_date = $this->date;
                    $operation->save();

                    $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

                    return redirect('/client-operations')->with("success", "Demande envoyée avec succes !");
                }
            }elseif($montant == 0){
                return redirect('/client-operations')->with("fail", "transaction impossible.");
            }else{
                $operation = new Operation();
                $operation->user_id = $this->userId = $user->id;
                $operation->operation_type_id = $this->typeOperation;
                $operation->withdrawal_amount = $this->montant;
                $operation->withdrawal_method = $this->method;
                $operation->transaction_key = $this->randomString = Str::random(10);
                $operation->status = $this->status;
                $operation->beneficiaire = $this->beneficiaire;
                $operation->compte_destination = $this->compte_de_destination;
                $operation->motif = $this->motif;
                $operation->account_types_id = $this->typeAccount;
                $operation->withdrawal_date = $this->date;
                $operation->save();

                $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

                return redirect('/client-operations')->with("success", "Demande envoyée aec succes");
            }
    }


    //Methode d'appel à la confirmation de suppression
    public $operationToDelete;
    public function confirmDelete($operationId)
    {
        $this->operationToDelete = $operationId;
    }
    //Fin Methode d'appel à la confirmation de suppression

    //Suppression d'operation
    public function deleteOperation()
    {
        // Assurez-vous que l'enregistrement existe avant de le supprimer
        if ($this->operationToDelete) {
            $operation = Operation::find($this->operationToDelete);

            if ($operation) {
                $operation->delete();
                // Ajoutez ici un message de succès ou de confirmation

                //session()->flash('success', 'Opération supprimée avec succès.');
                if($operation){
                    return redirect('/client-operations')->with("success", "Oppération supprimée avec succes !");
                }else{
                    return redirect('/client-operations')->with("fail", "Demande envoyée aec succes");
                }

            }
        }
        
        // Réinitialisez la variable d'opération à supprimer
        $this->operationToDelete = null;
    }
    //Fin suppression operation


    //Edit d'operation
    public function editOperation()
    {
        $operationToEdit = Operation::find($this->operationId);
        //dd($this->typeOperation, $this->montant, $this->beneficiaire, $this->compte_de_destination, $this->motif, $this->date);
            if ($operationToEdit) {
                // Mets à jour les attributs de l'opération à partir des propriétés du composant
                $operationToEdit->operation_type_id = $this->typeOperation;
                $operationToEdit->withdrawal_amount = $this->montant;
                $operationToEdit->beneficiaire = $this->beneficiaire;
                $operationToEdit->compte_destination = $this->compte_de_destination;
                $operationToEdit->motif = $this->motif;
                $operationToEdit->account_types_id = $this->typeAccount;
                $operationToEdit->withdrawal_date = $this->date;
                
                // Enregistre les modifications dans la base de données
                $operationToEdit->update();
    
                $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour
    
                // Redirigez l'utilisateur avec un message de succès ou echec
                return redirect('/client-operations')->with("success", "Opération mise à jour avec succès.");
            } else {
                return redirect('/client-operations')->with("fail", "Opération non trouvée.");
            }
    }
    //Fin Edit operation


    //Show opperation
    public $operations;
    public $user;
    public function render()
    {
        $userid = Auth::user()->id;
        $this->operations = Operation::orderBy('id', 'desc')->get();
        $this->user = User::with('account', 'operation', 'loan')->find($userid);
        return view('livewire.client.operations-component');
    }
    //Fin Show opperation


    //ShowEdit opperation
    public function showEdit($operationId)
    {
        $operation = Operation::find($operationId);
        $this->operationId = $operationId;
        $this->montant = $operation->withdrawal_amount;
        $this->typeOperation = $operation->operation_type_id;
        $this->beneficiaire = $operation->beneficiaire;
        $this->compte_de_destination = $operation->compte_destination;
        $this->motif = $operation->motif;
        $this->date = $operation->withdrawal_date;
    }
    //Fin ShowEdit opperation
}
