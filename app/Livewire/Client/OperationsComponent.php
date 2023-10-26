<?php

namespace App\Livewire\Client;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;


class OperationsComponent extends Component
{

    
    //generation de code aleatoir
    public $randomString;
    public function generateRandomString()
    {
        $this->randomString = Str::random(10);
    }


    /*public $user;
    public function mount()
    {
        $user = Auth::user();
        $this->user = auth()->user();
    }*/




    
    //Enregistrement de l'operation
    //public $iduser = 1;
    public $typeOperation;
    public $montant;
    public $method = "neutre";
    //public $id_employe = "id_employe";
    public $status = "en cours";

    public $beneficiaire;
    public $compte_de_destination;
    public $motif;

    public $date;

    public function saveOperation()
    {
        $user = Auth::user();
        $operation = new Operation();
        $operation->user_id = $this->userId = $user->id;
        $operation->operation_type_id = $this->typeOperation;
        $operation->withdrawal_amount = $this->montant;
        $operation->withdrawal_method = $this->method;
        //$operation->id_employe = $this->id_employe;
        $operation->transaction_key = $this->randomString = Str::random(10);
        $operation->status = $this->status;
        $operation->beneficiaire = $this->beneficiaire;
        $operation->compte_destination = $this->compte_de_destination;
        $operation->motif = $this->motif;
        $operation->withdrawal_date = $this->date;
        $operation->save();

        $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

        if($operation){
            return redirect('/client-operations')->with("success", "Demande envoyée aec succes !");
        }else{
            return redirect('/client-operations')->with("fail", "Demande envoyée aec succes");
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
        if ($this->operationToEdit) {
            $operationToEdit = Operation::find($this->operationToEdit);
    
            if ($operationToEdit) {
                // Mets à jour les attributs de l'opération à partir des propriétés du composant
                $operationToEdit->operation_type_id = $this->typeOperation;
                $operationToEdit->withdrawal_amount = $this->montant;
                $operationToEdit->beneficiaire = $this->beneficiaire;
                $operationToEdit->compte_destination = $this->compte_de_destination;
                $operationToEdit->motif = $this->motif;
                $operationToEdit->withdrawal_date = $this->date;
    
                // Enregistre les modifications dans la base de données
                $operationToEdit->update();
    
                $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour
    
                // Redirigez l'utilisateur avec un message de succès
                return redirect('/client-operations')->with("success", "Opération mise à jour avec succès.");
            } else {
                return redirect('/client-operations')->with("fail", "Opération non trouvée.");
            }
        }
    }
    
    //Fin Edit operation


     //Show opperation
    public $operations;
    public function render()
    {
        $this->operations = Operation::orderBy('id', 'desc')->get();
        return view('livewire.client.operations-component');
    }

    public function showEdit($operationId)
    {
        $operation = Operation::find($operationId);
        $this->operation = $operationId;
        $this->montant = $operation->withdrawal_amount;
        $this->typeOperation = $operation->operation_type_id;
        $this->beneficiaire = $operation->beneficiaire;
        $this->compte_de_destination = $operation->compte_destination;
        $this->motif = $operation->motif;
    }
    //Fin Show opperation


    
    //Methode d'appel à la confirmation d'edite
    public $operationToEdit;
    public function confirmEdit($operationId)
    {
        $this->operationToEdit = $operationId;
    }
    //Fin d'appel à la confirmation d'edite



}
