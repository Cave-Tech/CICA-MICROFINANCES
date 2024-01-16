<?php

namespace App\Livewire\Employe;

use App\Models\Account;
use Livewire\Component;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanUserPams;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class LoanBulkComponent extends Component
{
    use WithFileUploads;

    public $showAdditionalForm = false;
    public $additionalName;

    public $name = '';
    public $filteredUsers = [];
    public $filteredMembers = [];
    public $allMembers = [];
    public $selectedMemberId;
    public $selectedUserId;
    public $amount;
    public $typeloan = "3";

    // pas besoin
    public $typeWarranty;
    public $valueWarranty;
    public $detailsWarranty;
    public $purposeWarranty;
    public $nameWarrantor;
    public $numWarrantor;
    public $addressWarrantor;
    public $relationWarrantor;

    // pas besoin

    public $interestRate = 2; 
    public $loanTerm;
    public $agentName = '';


    public $memberSelected = false;

    public $applicantType; // Personne physique ou morale
    public $loanReason; // Motif du prêt
    public $repaymentInterval; // Fréquence de paiement

    public $nameCompany = ''; // Nom de la société
    public $loanPieces;



    // public function toggleAdditionalForm()
    // {
    //     $this->showAdditionalForm = !$this->showAdditionalForm;
    // }


    protected $rules = [
        'name' => 'required|string',
        'amount' => 'required|numeric|min:1',
        'loanTerm' => 'required|numeric|min:1',
        'applicantType' => 'required|in:pp,pm,pr',
        'loanReason' => 'required|string',
        'repaymentInterval' => 'required|in:daily,weekly,monthly',
        'loanPieces' => 'required|file|mimes:pdf|max:10240',

    ];


    public function updatedName($value)
    {
        if (strlen($value) > 1) {
            if($this->applicantType == 'pm'){
                $this->filteredUsers = User::where('name_company', 'like', '%' . $value . '%')
                    ->where('profile_id', 3)
                    ->where('type_client', 'pm')
                    ->get(); 
            }elseif($this->applicantType == 'pp'){
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
        if($this->applicantType == 'pm'){
            $this->name = $user->name_company;
        }elseif($this->applicantType == 'pp'){
            $this->name = $user->name;
        }
        
        $this->filteredUsers = [];
    }


    public function selectMember($userId)
    {
        $this->selectedMemberId = $userId;
        $user = User::find($userId);
        $this->additionalName = $user->name;
        $this->filteredMembers = [];
        $this->memberSelected = true;
    }

    public function toggleAdditionalForm()
    {
        $this->resetModal();
        $this->showAdditionalForm = true;
        $this->dispatch('show-modal');
    }

    public function resetModal()
    {
        $this->reset(['additionalName', 'filteredMembers']);
        $this->showAdditionalForm = false;
    }

    public function addMember()
    {
        $this->validate([
            'additionalName' => 'required',
        ], [
            'additionalName.required' => 'Le nom est requis.',
        ]);

        $user = User::find($this->selectedMemberId);


        // Ajouter le membre à la liste
        $newMember = [
            'user_id' => $user->id,
            'name' => $user->name,
            'address' => $user->address,
        ];
        //$newMember = array_push($this->allMembers, ['user_id' => $user->id, 'name'=> $user->name, 'address'=> $user->address]);
        $this->reset(['additionalName']);

        
        $this->allMembers[] = $newMember;


    }

    public function resetInputFields()
    {
        $this->additionalName = '';
        $this->filteredMembers = [];
    }


    public function deleteAllMember($index)
    {
        unset($this->allMembers[$index]);
        $this->allMembers = array_values($this->allMembers); // Réindexer le tableau
    }

    

    // public function calculateInterestRate()
    // {
    //     if ($this->amount >= 1000 && $this->amount <= 100000) {
    //         $this->interestRate = 5;
    //     } elseif ($this->amount > 100000 && $this->amount <= 200000) {
    //         $this->interestRate = 10;
    //     }elseif ($this->amount > 200000) {
    //         $this->interestRate = 15;  
    //     }else{
    //         $this->interestRate = 0;
    //     }


    //     // Vous pouvez également définir une valeur par défaut si aucune condition n'est satisfaite
    //     // $this->interestRate = 0;
    // }

    // public function updatedAmount()
    // {
        // $this->calculateInterestRate(); // Appel de la méthode de calcul du taux d'intérêt
    // }

    // public function createLoan()
    // {
    //     // Vérifier si la section du formulaire supplémentaire est affichée
    //     if ($this->showAdditionalForm) {
    //     // Empêcher la soumission automatique et demander à l'utilisateur d'ajouter tous les membres nécessaires
    //     $this->addError('showAdditionalForm', 'Veuillez ajouter tous les membres nécessaires avant de soumettre.');
    //     }else{
    //         $this->reset(['showAdditionalForm', 'additionalName']);
    //         $this->validate();

    //         $existingLoan = Loan::where('borrower_id', $this->selectedUserId)
    //             ->whereIn('status', ['in progress', 'pending', 'validated', 'rejected'])
    //             ->first();

    //         if ($existingLoan) {
    //             session()->flash('fail', 'Cet utilisateur a déjà un prêt en cours ou en attente.');
    //             return redirect()->route('employe.loan-request');
    //         }

    //         $newLoan = Loan::create([
    //             'borrower_id' => $this->selectedUserId,
    //             'agent_id' => Auth::user()->id,
    //             //'agent_terain_id' => $this->selectedAgentId,
    //             'loan_amount' => $this->amount,
    //             'loan_type_id' => $this->typeloan,

    //             'payment_frequency' => $this->loanTerm,
    //             'interest_rate' => $this->interestRate,
    //             'status' => 'in progress',
    //             'applicant_type' => $this->applicantType,
    //             'loan_reason' => $this->loanReason,
    //             'repayment_interval' => $this->repaymentInterval,
    //         ]);

    //         // Enregistrer les tarifs
    //         foreach ($this->allMembers as $member) {
    //             LoanUserPams::create([
    //                 'loan_id' => $newLoan->id,
    //                 'user_id' => $member['user_id'],
    //             ]);
    //         }

    //         $this->reset([
    //             'name', 'filteredUsers', 'selectedUserId', 'amount', 'typeloan', 'typeWarranty',
    //             'valueWarranty', 'detailsWarranty', 'purposeWarranty', 'nameWarrantor',
    //             'numWarrantor', 'addressWarrantor', 'relationWarrantor',
    //             'applicantType', 'loanReason', 'repaymentInterval',
    //         ]);

    //         session()->flash('success', 'La demande de prêt a été enregistrée avec succès.');

    //         return redirect()->route('employe.loan-request');
    //     }
    // }

    public function createLoan()
    {

        $this->validate();

        if (empty($this->allMembers)) {
            session()->flash('fail', 'Veuillez ajouter au moins un membre.');
            return;
        }


        $existingLoan = Loan::where('borrower_id', $this->selectedUserId)
                            ->whereIn('status', ['in progress', 'pending', 'validated', 'rejected'])
                            ->first();

        if ($existingLoan) {
            session()->flash('fail', 'Cet utilisateur a déjà un prêt en cours ou en attente.');
            return redirect()->route('employe.loan-request');
        }

        // Vérifier si l'emprunteur a un compte
        $account = Account::where('user_id', $this->selectedUserId)->first();
        if (!$account) {
            session()->flash('fail', 'L\'emprunteur doit avoir au moins un compte.');
            return redirect()->route('employe.loan-request');
        }

        // Vérifier si le statut du compte est bloqué
        if ($account->status == 'blocked') {
            session()->flash('fail', "Opération impossible. Le compte est bloqué.");
            return;
        }

        $newLoan = Loan::create([
            'borrower_id' => $this->selectedUserId,
            'agent_id' => Auth::user()->id,
            'loan_amount' => $this->amount,
            'loan_type_id' => $this->typeloan,
            'payment_frequency' => $this->loanTerm,
            'interest_rate' => $this->interestRate,
            'status' => 'in progress',
            'applicant_type' => $this->applicantType,
            'loan_reason' => $this->loanReason,
            'repayment_interval' => $this->repaymentInterval,
            'loan_pieces' => $this->loanPieces->store('loan_pieces', 'public'),
        ]);

        foreach ($this->allMembers as $member) {
            LoanUserPams::create([
                'loan_id' => $newLoan->id,
                'user_id' => $member['user_id'],
            ]);
        }

        $this->reset([
            'name', 'filteredUsers', 'selectedUserId', 'amount', 'typeloan', 'typeWarranty',
            'valueWarranty', 'detailsWarranty', 'purposeWarranty', 'nameWarrantor',
            'numWarrantor', 'addressWarrantor', 'relationWarrantor',
            'applicantType', 'loanReason', 'repaymentInterval', 'allMembers', 'loanPieces',
        ]);

        session()->flash('success', 'La demande de prêt a été enregistrée avec succès.');
        return redirect()->route('employe.loan-request');
    }


    public function updatedAdditionalName()
    {
        if (strlen($this->additionalName) > 1) {
            $this->filteredMembers = User::where('name', 'like', '%' . $this->additionalName . '%')
                ->where('profile_id', 3)
                ->where('type_client', 'pp')
                ->get();
        } else {
            $this->filteredMembers = [];
        }
    }



    public function render()
    {
        
        return view('livewire.employe.loan-bulk-component');
    }
}
