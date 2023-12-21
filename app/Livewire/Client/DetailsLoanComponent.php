<?php
namespace App\Livewire\Client;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Account;
use App\Models\Loan;

class DetailsLoanComponent extends Component
{
    use WithFileUploads;
    public $loan;
    // Dans votre composant Livewire, ajoutez un listener pour cet événement
    protected $listeners = ['loanStatusUpdated' => 'refreshComponent'];

    public function refreshComponent()
    {
        // Vous pouvez soit réinitialiser les propriétés, soit rappeler `mount()` pour rafraîchir les données
        $this->mount($this->loan->id);
    }
    public $doc_files_warrantor;
    public $doc_files;
    public $id;
    public $loanId;
    public $rejectReason;
    public $selectedUserId;
    public $name = '';
    public $filteredUsers = [];
    public $selectedAgent;


    protected $rules = [
        'rejectReason' => 'required',
    ];
    
    public function updatedName($value)
    {
        if (strlen($value) > 1) {
            $this->filteredUsers = User::where('name', 'like', '%' . $value . '%')
                ->where('employee_type_id', 3)->get();
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


    public function mount($loanId)
    {
        $this->loan = Loan::with(['borrower', 'agent', 'payment', 'agent_terain'])
        ->find($loanId);
        $this->id = $loanId;
        //dd($this->loan->agent->name);
    }

    public function remainingAmount($loan)
    {
        // Vérifiez si la relation payments existe
        if ($loan->payment) {
            $totalPayments = $loan->payment->sum('payment_amount');
            $loanAmount = $loan->loan_amount * (1 + ($loan->interest_rate / 100));

            // Calculer le pourcentage restant
            $remainingAmount = ($totalPayments / $loanAmount) * 100;

            // Formater le pourcentage avec deux chiffres après la virgule
            $formattedRemainingAmount = number_format($remainingAmount);

            return $formattedRemainingAmount;
        }

        return '0 %';
    }

    public function remainingAmountToPay($loan)
    {
        // Vérifiez si la relation payments existe
        if ($loan->payment) {
            $totalPayments = $loan->payment->sum('payment_amount');
            $loanAmount = $loan->loan_amount * (1 + ($loan->interest_rate / 100));

            // Calculer le montant restant à payer
            $remainingAmountToPay = $loanAmount - $totalPayments;

            return $remainingAmountToPay . ' FCFA';
        }

        return number_format($loan->loan_amount) . ' FCFA'; // Montant total du prêt si aucun paiement n'a été effectué
    }




    // Méthode pour valider le prêt
    public function validateLoan($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->status = "validated";
        $loan->save();
        $this->dispatch('loanStatusUpdated');
        
    }

     // Méthode pour pre-valider le prêt
     public function preValidateLoan($loanId)
     {
         $loan = Loan::findOrFail($loanId);
         $loan->status = "in progress";
         $loan->save();
         $this->dispatch('loanStatusUpdated');
         
     }

    // Méthode pour rejeter le prêt
    public function rejectLoan()
    {
        // Validez les données du formulaire
        $this->validate();

        $loan = Loan::findOrFail($this->loanId);
        $loan->status = "rejected";
        $loan->reject_reason = $this->rejectReason;
        $loan->save();
        $this->dispatch('loanStatusUpdated');
        
    }
    
    public function updateAgentTerrain()
    {


        $this->loan->agent_terain_id = $this->selectedUserId;
        $this->loan->save();

        session()->flash('success1', 'Agent de terrain ajouter avec succès.');

        // Réinitialiser la propriété selectedAgent pour effacer la sélection précédente.
        $this->reset('name');
    }
    
    public function EditLoanDoc()
    {
        $LoanToEditdoc = Loan::find($this->id); // $this->id provient de mount car $this->id = $loanId
            if ($LoanToEditdoc) {
                // Mets à jour les attributs de l'opération à partir des propriétés du composant
                $LoanToEditdoc->doc_files = $this->doc_files->store('loan_documents', 'public');
                $LoanToEditdoc->doc_files_warrantor = $this->doc_files_warrantor->store('loan_documents', 'public');
                
                // Enregistre les modifications dans la base de données
                $LoanToEditdoc->update();
    
                $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour
    
                // Redirigez l'utilisateur avec un message de succès ou echec
                return redirect('/client-loan-request')->with("success", "Document ajouter avec succès.");
            } else {
                return redirect('/client-loan-request')->with("fail", "Prêt non trouvée.");
            }
    }
    //Fin Edit loan doc

    public function calculatePaymentPercentage()
    {
        if ($this->loan->totalAmount > 0) {
            return ($this->loan->amountPaid / $this->loan->totalAmount) * 100;
        } else {
            return 0; // Évitez une division par zéro, si nécessaire
        }
    }


    public function render()
    {
        return view('livewire.client.details-loan-component');
    }
}
