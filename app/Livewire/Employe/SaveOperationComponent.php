<?php

namespace App\Livewire\Employe;

use App\Models\Operation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class SaveOperationComponent extends Component
{
    public $name = ''; // Nom entré par l'utilisateur
    public $filteredUsers = []; // Utilisateurs filtrés
    public $selectedUserId; // ID de l'utilisateur sélectionné

     //generation de code aleatoir
     public $randomString;
     //Enregistrement de l'operation
     public $operationId;
     public $typeOperation;
     public $montant;
     public $method = "cash";
    //  public $status = "en cours";
     public $beneficiaire;
     public $compte_de_destination;
     public $motif;
     public $date;
     public $userId;

     // Cette méthode met à jour les utilisateurs filtrés à mesure que vous tapez
    public function updatedName($value)
    {
        if(strlen($value) > 1) { // Commencez à filtrer après que l'utilisateur a tapé 2 caractères
            $this->filteredUsers = User::where('name', 'like', '%' . $value . '%')->get();
        } else {
            $this->filteredUsers = [];
        }
    }

    // Cette méthode est appelée lorsque vous sélectionnez un utilisateur des résultats filtrés
    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::find($userId);
        $this->name = $user->name; // Met à jour le champ de texte avec le nom complet
        $this->filteredUsers = []; // Efface les résultats de la recherche
    }

    public function saveOperation()
    {
        if (!$this->selectedUserId) {
            session()->flash('error', 'Veuillez sélectionner un utilisateur.');
            return;
        }
    
        // Création et enregistrement en une seule opération grâce à la méthode create de Eloquent.
        // Notez que vous devez avoir défini les propriétés fillable ou guarded dans votre modèle Operation.
        $operation = Operation::create([
            'user_id' => $this->selectedUserId,
            'agent_id' => Auth::id(),
            'operation_type_id' => $this->typeOperation,
            'withdrawal_amount' => $this->montant,
            'withdrawal_method' => $this->method,
            'transaction_key' => Str::random(10),
            'status' => 'completed',
            'beneficiaire' => $this->beneficiaire,
            'compte_destination' => $this->compte_de_destination,
            'motif' => $this->motif,
            'withdrawal_date' => $this->date,
        ]);
    
        $this->reset(); // Réinitialiser les champs du formulaire
    
        if($operation) {
            session()->flash('success', "L'opération a été enregistrée avec succès.");
        } else {
            session()->flash('error', "L'opération n'a pas pu être enregistrée.");
        }
    
        return redirect()->to('/operation-list');
    }
    
    public function render()
    {
        return view('livewire.employe.save-operation-component');
    }
}
