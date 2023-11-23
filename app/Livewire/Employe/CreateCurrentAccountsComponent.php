<?php

namespace App\Livewire\Employe;

use App\Models\Account;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCurrentAccountsComponent extends Component
{
    use WithFileUploads;

    public $balance;
    public $ifu;
    public $identityPiece;
    public $identityPicture;
    public $proofOfAddress;
    public $name = ''; // Nom entré par l'utilisateur
    public $filteredUsers = []; // Utilisateurs filtrés
    public $selectedUserId; // ID de l'utilisateur sélectionné
     // Cette méthode met à jour les utilisateurs filtrés à mesure que vous tapez
     public function updatedName($value)
     {
         if(strlen($value) > 1) { // Commencez à filtrer après que l'utilisateur a tapé 2 caractères
             $this->filteredUsers = User::where('name', 'like', '%' . $value . '%')
                                        ->where('profile_id', 3)->get();
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

     public function createCurrentAccount()
    {
       
       

        

        // Enregistrement du compte courant
        Account::create([
            'user_id' => $this->selectedUserId,
            'balance' => $this->balance,
            'ifu' => $this->ifu,
            'agent_id' => auth()->user()->id,
            'account_number' => $this->generateAccountNumber(),
            'account_types_id' => 1,
            'interest_rate' => 0,
            'opening_date' => now(),
            'status' => 'activated',
        ]);

        // Enregistrement des fichiers joints
        $identityPiecePath = $this->identityPiece->store('identity_piece', 'public');
        $identityPicturePath = $this->identityPicture->store('identity_picture', 'public');
        $proofOfAddressPath = $this->proofOfAddress->store('proof_of_address', 'public');

        $user = User::find($this->selectedUserId);
        $user->identity_piece = $identityPiecePath;
        $user->identity_picture = $identityPicturePath;
        $user->proof_of_address = $proofOfAddressPath;
        
        $user->save();

        // Réinitialise les champs après l'enregistrement
        $this->reset([
            'name', 'filteredUsers', 'selectedUserId', 'balance', 'identityPiece', 'proofOfAddress', 'identityPicture', 'ifu'
        ]);

        // Émettre un message de succès
        session()->flash('success', 'Le compte courant a été enregistré avec succès.');

        return redirect()->route('employe.current-accounts');
    }

    /**
     * Générer un numéro de compte unique.
     */
    private function generateAccountNumber(): string
    {
        $prefix = 'MF'; // Préfixe pour Microfinance
        $randomPart = mt_rand(100000, 999999); // Partie aléatoire
        $checkDigit = $this->generateCheckDigit($randomPart);

        return $prefix . $randomPart . $checkDigit;
    }

    /**
     * Générer un chiffre de contrôle (check digit) pour le numéro de compte.
     */
    private function generateCheckDigit(int $number): int
    {
        // Logique pour générer un chiffre de contrôle, par exemple, une somme de contrôle simple.
        return array_sum(str_split($number)) % 10;
    }

    public function render()
    {
        return view('livewire.employe.create-current-accounts-component');
    }
}
