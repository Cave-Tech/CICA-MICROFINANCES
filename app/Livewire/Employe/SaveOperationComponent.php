<?php

namespace App\Livewire\Employe;

use App\Models\Account;
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
    public $filteredAccounts = []; // Comptes filtrés


    //generation de code aleatoir
    public $randomString;
    //Enregistrement de l'operation
    public $operationId;
    public $typeOperation;
    public $montant;
    public $method = "cash";

    public $phone;
    public $beneficiaire;
    public $compte_de_destination;
    public $motif;
    public $date;
    public $userId;
    public $userAccounts;
    public $selfAccount;
    public $transactionMethod;

        

     // Cette méthode met à jour les utilisateurs filtrés à mesure que vous tapez
    public function updatedName($value)
    {
        if(strlen($value) > 1) { // Commencez à filtrer après que l'utilisateur a tapé 2 caractères
            $this->filteredUsers = User::where('name', 'like', '%' . $value . '%')
                                        ->where('profile_id', 3)
                                        ->get();
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
        $this->phone = $user->phone;
        $this->userAccounts = Account::where('user_id', $userId)->get();
        $this->filteredUsers = []; // Efface les résultats de la recherche
    }

    public function updatedCompteDeDestination($value)
    {
        if (strlen($value) > 1) {
            // Commencez à filtrer après que l'utilisateur a tapé 2 caractères
            $this->filteredAccounts = Account::where('account_number', 'like', '%' . $value . '%')->get();
        } else {
            $this->filteredAccounts = [];
        }
    }

    public function selectAccount($accountNumber)
    {
        $account = Account::where('account_number', $accountNumber)->first();
        $this->compte_de_destination = $accountNumber;
        $this->beneficiaire = $account->user->name;
        $this->filteredAccounts = [];
    }


    public function saveOperation()
    {
       
        $this->validate([
            'name' => 'required',
            'typeOperation' => 'required|in:1,2,3',
            'montant' => 'required',
            'compte_de_destination' => 'required_if:typeOperation,3',
            'beneficiaire' => 'required_if:typeOperation,3',
            'motif' => 'required_if:typeOperation,3',

        ]);


        if (!$this->selectedUserId) {
        session()->flash('fail', 'Veuillez sélectionner un utilisateur.');
        return;
        }

        $user = User::where('name', $this->name)
                    ->where('phone', $this->phone)
                    ->first();
        if (!$user) {
            session()->flash('fail', "L'utilisateur n'a pas été trouvé.");
            return;
        }

        if (!$this->selfAccount) {
            session()->flash('fail', 'Veuillez sélectionner un compte.');
            return;
        }
       

        // Logique pour mettre à jour le solde en fonction du type d'opération
        switch ($this->typeOperation) {
            case 1: // Dépôt
                $userAccount = Account::where('id', $this->selfAccount)->first();    
                $userAccount->balance += $this->montant;
                break;
            case 2: // Retrait
                $userAccount = Account::where('id', $this->selfAccount)->first();   
                if ($userAccount->balance >= $this->montant) {
                    $userAccount->balance -= $this->montant;
                } else {
                    session()->flash('fail', "Solde insuffisant pour effectuer le retrait.");
                    return;
                }
                break;
            case 3: // Virement
                // Récupérer le compte de l'utilisateur
                $destinationAccount = Account::where('account_number', $this->compte_de_destination)->first();

                 if (!$destinationAccount) {
                    session()->flash('fail', "Le compte du destinataire n'a pas été trouvé.");
                    return;
                }

                if($this->transactionMethod == "cash"){
                    $destinationAccount->balance += $this->montant;
                    $destinationAccount->save();
                }else{
                    $userAccount = Account::where('id', $this->transactionMethod)->first();
                    // Vérifier si l'utilisateur a suffisamment de fonds pour le virement
                    if ($userAccount->balance >= $this->montant){
                        $userAccount->balance -= $this->montant;
                        $destinationAccount->balance += $this->montant;
                        $userAccount->save();
                        $destinationAccount->save();
                    } else {
                        session()->flash('fail', "Solde insuffisant pour effectuer le virement.");
                        return;
                    }
                }
                break;
            default:
                session()->flash('fail', "Type d'opération non pris en charge.");
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
            'withdrawal_date' => now(),
        ]);

        // Sauvegarder le solde mis à jour du compte
        $userAccount->save();
    
        $this->reset(); // Réinitialiser les champs du formulaire
    
        if($operation) {
            session()->flash('success', "L'opération a été enregistrée avec succès.");
        } else {
            session()->flash('fail', "L'opération n'a pas pu être enregistrée.");
        }
    
        return redirect()->to('/operation-list');
    }
    
    public function render()
    {
        return view('livewire.employe.save-operation-component');
    }
}
