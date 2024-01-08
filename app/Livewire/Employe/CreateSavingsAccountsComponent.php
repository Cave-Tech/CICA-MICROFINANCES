<?php

namespace App\Livewire\Employe;

use App\Models\Account;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateSavingsAccountsComponent extends Component
{
    use WithFileUploads;

    public $balance;
    public $ifu;
    public $accountPieces;
    public $clientType;
    // public $identityPiece;
    // public $identityPicture;
    // public $proofOfAddress;
    public $name = ''; // Nom entré par l'utilisateur
    public $filteredUsers = []; // Utilisateurs filtrés
    public $selectedUserId; // ID de l'utilisateur sélectionné
    

    public function updatedName($value)
    {
        if (strlen($value) > 1) {
            if($this->clientType == 'pm'){
                $this->filteredUsers = User::where('name_company', 'like', '%' . $value . '%')
                    ->where('profile_id', 3)
                    ->where('type_client', 'pm')
                    ->get(); 
            }elseif($this->clientType == 'pp'){
                $this->filteredUsers = User::where('name', 'like', '%' . $value . '%')
                    ->where('profile_id', 3)
                    ->where('type_client', 'pp')
                    ->get();
            }
        } else {
            $this->filteredUsers = [];
        }
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::find($userId);
        if($this->clientType == 'pm'){
            $this->name = $user->name_company;
        }elseif($this->clientType == 'pp'){
            $this->name = $user->name;
        }
        
        $this->filteredUsers = [];
    }


     public function createSavingsAccount()
    {
        $existingAccount = Account::where('user_id', $this->selectedUserId)
        ->where('account_types_id', 2)
        ->first();

        // Si un compte courant existe déjà, afficher un message d'erreur
        if ($existingAccount) {
            session()->flash('fail', 'Cet utilisateur a déjà un compte epargne.');
            return redirect()->route('employe.current-accounts');
        }

        // Enregistrement du compte courant
        Account::create([
            'user_id' => $this->selectedUserId,
            'balance' => $this->balance,
            // 'ifu' => $this->ifu,
            'agent_id' => auth()->user()->id,
            'account_number' => $this->generateAccountNumber(),
            'account_types_id' => 2,
            'interest_rate' => 0,
            'opening_date' => now(),
            'status' => 'activated',
            'account_pieces' => $this->accountPieces->store('account_pieces', 'public'),
            'client_type' => $this->clientType,
        ]);

        // Enregistrement des fichiers joints
        // $identityPiecePath = $this->identityPiece->store('identity_piece', 'public');
        // $identityPicturePath = $this->identityPicture->store('identity_picture', 'public');
        // $proofOfAddressPath = $this->proofOfAddress->store('proof_of_address', 'public');

        // $user = User::find($this->selectedUserId);
        // $user->identity_piece = $identityPiecePath;
        // $user->identity_picture = $identityPicturePath;
        // $user->proof_of_address = $proofOfAddressPath;
        
        // $user->save();

        // Réinitialise les champs après l'enregistrement
        $this->reset([
            'name', 'filteredUsers', 'selectedUserId', 'balance', 'accountPieces', 'clientType'
        ]);

        // Émettre un message de succès
        session()->flash('success', 'Le compte courant a été enregistré avec succès.');

        return redirect()->route('employe.savings-accounts');
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
        return view('livewire.employe.create-savings-accounts-component');
    }
}
