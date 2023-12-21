<?php

namespace App\Livewire\Employe;

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
    public $interestRate; 
    public $loanTerm;
    public $agentName = '';

    public $agentTerrain = '';

    public $agentSelected = false;



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
    ];

    public function updatedName($value)
    {
        if (strlen($value) > 1) {
            $this->filteredUsers = User::where('name', 'like', '%' . $value . '%')
                ->where('profile_id', 3)->get();
        } else {
            $this->filteredUsers = [];
        }
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::find($userId);
        $this->name = $user->name;
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

    

    public function calculateInterestRate()
    {
        if ($this->amount >= 1000 && $this->amount <= 100000) {
            $this->interestRate = 5;
        } elseif ($this->amount > 100000 && $this->amount <= 200000) {
            $this->interestRate = 10;
        }elseif ($this->amount > 200000) {
            $this->interestRate = 15;  
        }else{
            $this->interestRate = 0;
        }


        // Vous pouvez également définir une valeur par défaut si aucune condition n'est satisfaite
        // $this->interestRate = 0;
    }

    public function updatedAmount()
    {
        $this->calculateInterestRate(); // Appel de la méthode de calcul du taux d'intérêt
    }

    public function createLoan()
    {
        $this->validate();

        $existingLoan = Loan::where('borrower_id', $this->selectedUserId)
            ->whereIn('status', ['in progress', 'pending', 'validated', 'rejected'])
            ->first();

        if ($existingLoan) {
            session()->flash('fail', 'Cet utilisateur a déjà un prêt en cours ou en attente.');
            return redirect()->route('employe.loan-request');
        }

        Loan::create([
            'borrower_id' => $this->selectedUserId,
            'agent_id' => Auth::user()->id,
            'agent_terain_id' => $this->selectedAgentId,
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
        ]);

        $this->reset([
            'name', 'filteredUsers', 'selectedUserId', 'amount', 'typeloan', 'typeWarranty',
            'valueWarranty', 'detailsWarranty', 'purposeWarranty', 'nameWarrantor',
            'numWarrantor', 'addressWarrantor', 'relationWarrantor'
        ]);

        session()->flash('success', 'La demande de prêt a été enregistrée avec succès.');

        return redirect()->route('employe.loan-request');
    }

    public function render()
    {
        if (strlen($this->agentTerrain) > 1) {
            $this->filteredAgents = User::where('name', 'like', '%' . $this->agentTerrain . '%')
                ->where('employee_type_id', 3)->get();
        } else {
            $this->filteredAgents = [];
        }

        return view('livewire.employe.create-loan-request-component');
    }
}
