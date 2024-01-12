<?php

namespace App\Livewire\Employe;

use App\Models\Account;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLoanRequestComponent extends Component
{
    use WithFileUploads;

    public $name = '';
    public $filteredUsers = [];
    public $filteredAgents = [];
    public $selectedAgentId;
    public $selectedUserId;
    public $amount;
    public $typeloan;
    public $typeWarranty;
    public $valueWarranty;
    public $detailsWarranty;
    public $purposeWarranty;
    public $nameWarrantor;
    public $numWarrantor;
    public $addressWarrantor;
    public $relationWarrantor;
    public $interestRate = 2; 
    public $loanTerm;
    public $agentName = '';
    public $loanPieces;

    public $agentTerrain = '';

    public $agentSelected = false;

    public $applicantType; // Personne physique ou morale
    public $loanReason; // Motif du prêt
    public $repaymentInterval; // Fréquence de paiement

    public $nameCompany = ''; // Nom de la société






    protected $rules = [
        'name' => 'required',
        'amount' => 'required|numeric|min:0',
        'typeloan' => 'required',
        'typeWarranty' => 'required',
        'valueWarranty' => 'required|numeric|min:0',
        'detailsWarranty' => 'required',
        // 'purposeWarranty' => 'required',
        'nameWarrantor' => 'required',
        'numWarrantor' => 'required|numeric',
        'addressWarrantor' => 'required',
        'relationWarrantor' => 'required',
        'loanTerm' => 'required|numeric|min:1',
        'agentTerrain' => 'nullable|string',
        'applicantType' => 'required|in:pp,pm',
        'loanReason' => 'required|string',
        'repaymentInterval' => 'required|in:daily,weekly,monthly',
        'nameCompany' => 'required_if:applicantType,morale|string',
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


    public function selectAgent($userId)
    {
        $this->selectedAgentId = $userId;
        $user = User::find($userId);
        $this->agentTerrain = $user->name;
        $this->filteredAgents = [];
        $this->agentSelected = true;
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
    //     $this->calculateInterestRate(); // Appel de la méthode de calcul du taux d'intérêt
    // }

    public function createLoan()
    {
        $this->validate();

        $existingLoan = Loan::where('borrower_id', $this->selectedUserId)
            ->whereIn('status', ['in progress', 'pending', 'validated'])
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

        // // Vérifier si le solde du compte est >= 10% du montant du prêt
        // $requiredBalance = $this->amount * 0.1;
        // if ($account->balance < $requiredBalance) {
        //     session()->flash('fail', 'Le solde du compte de l\'emprunteur est insuffisant pour le prêt demandé.');
        //     return redirect()->route('employe.loan-request');
        // }

        // Vérifier l'ancienneté du compte (au moins trois mois)
        // $threeMonthsAgo = now()->subMonths(3);
        // if (new \DateTime($account->opening_date) > $threeMonthsAgo) {
        //     session()->flash('fail', 'Le compte de l\'emprunteur doit avoir au moins trois mois d\'ancienneté.');
        //     return redirect()->route('employe.loan-request');
        // }

        

        Loan::create([
            'borrower_id' => $this->selectedUserId,
            'agent_id' => Auth::user()->id,
            // 'agent_terain_id' => $this->selectedAgentId,
            'loan_amount' => $this->amount,
            'loan_type_id' => $this->typeloan,
            'type_warranty' => $this->typeWarranty,
            'value_warranty' => $this->valueWarranty,
            'details_warranty' => $this->detailsWarranty,
            // 'purpose_warranty' => $this->purposeWarranty,
            'name_warrantor' => $this->nameWarrantor,
            'number_warrantor' => $this->numWarrantor,
            'address_warrantor' => $this->addressWarrantor,
            'relation_warrantor' => $this->relationWarrantor,
            'payment_frequency' => $this->loanTerm,
            'interest_rate' => $this->interestRate,
            'status' => 'in progress',
            'applicant_type' => $this->applicantType,
            'loan_reason' => $this->loanReason,
            'repayment_interval' => $this->repaymentInterval,
            'loan_pieces' => $this->loanPieces->store('loan_pieces', 'public'),
            
        ]);

        $this->reset([
            'name', 'filteredUsers', 'selectedUserId', 'amount', 'typeloan', 'typeWarranty',
            'valueWarranty', 'detailsWarranty', 'purposeWarranty', 'nameWarrantor',
            'numWarrantor', 'addressWarrantor', 'relationWarrantor',
            'applicantType', 'loanReason', 'repaymentInterval', 'loanTerm', 'loanPieces'
        ]);

        session()->flash('success', 'La demande de prêt a été enregistrée avec succès.');

        return redirect()->route('employe.loan-request');
    }

    public function render()
    {
        // if (strlen($this->agentTerrain) > 1) {
        //     $this->filteredAgents = User::where('name', 'like', '%' . $this->agentTerrain . '%')
        //         ->where('employee_type_id', 3)->get();
        // } else {
        //     $this->filteredAgents = [];
        // }

        return view('livewire.employe.create-loan-request-component');
    }
}
