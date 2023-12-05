<?php

namespace App\Livewire\Employe;

use App\Models\Account;
use App\Models\User;
use Livewire\Component;

class SavingsAccountsComponent extends Component
{
    public $savingsAccounts, $savingsAccountId, $detailsSavingsAccount, $email, $account_number, $balance, $interest_rate, $opening_date, $status, $account_type;
    
    public $search = '';
    public $name = ''; // Nom entré par l'utilisateur
    public $filteredUsers = []; // Utilisateurs filtrés
    public $selectedUserId; // ID de l'utilisateur sélectionné


    

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
 

    public function resetListener()
    {
        $this->reset('detailsSavingsAccount'); // Réinitialisez les propriétés que vous souhaitez remettre à zéro.
    }


    public function setActivated($savingsAccountId)
    {
        $savingsAccount = Account::findOrFail($savingsAccountId);
        $savingsAccount->status = "activated";
        $savingsAccount->save();

        // Émettre l'événement
        $this->dispatch('close-savings-account-modal');

        // Ici, vous pouvez ajouter une session flash ou d'autres actions selon vos besoins
    }

    public function setBlocked($savingsAccountId)
    {
        $savingsAccount = Account::findOrFail($savingsAccountId);
        $savingsAccount->status = "blocked";
        $savingsAccount->save();

        $this->dispatch('close-savings-account-modal');
    }

    // public function showDetails($savingsAccountId)
    // {
    //     $this->detailsSavingsAccount = savingsAccount::with(['user', 'agent', 'savingsAccountType'])->find($savingsAccountId);
    // }

    public function showDetails($savingsAccountId) {
        $this->detailsSavingsAccount = Account::findOrFail($savingsAccountId);
        $this->dispatch('show-savings-account-modal'); // Ouvrez le modal avec JS
    }
    
    public function closeDetails() {
        $this->dispatch('close-savings-account-modal'); // Fermez le modal avec JS
    }




    public function render()
    {
        $this->savingsAccounts = Account::with(['user', 'agent'])
            ->where('account_types_id', 2)
            ->where(function($query) {
                $query->where('account_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function($nestedQuery) {
                        $nestedQuery->where('name', 'like', '%' . $this->search . '%')
                                    ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->latest()
            ->get();

        return view('livewire.employe.savings-accounts-component');
    }
}
