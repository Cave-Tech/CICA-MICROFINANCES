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
    public $doc_files_warrantor;
    public $doc_files;
    public $id;

    public function mount($loanId)
    {
        $this->loan = Loan::with(['borrower', 'agent', 'payment'])
        ->find($loanId);
        $this->id = $loanId;
        // dd($this->loan);
    }

    //Edit loan doc
    
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

    public function render()
    {
        return view('livewire.client.details-loan-component');
    }
}
