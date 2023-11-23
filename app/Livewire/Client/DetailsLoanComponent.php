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
    public $loan;
    // Dans votre composant Livewire, ajoutez un listener pour cet événement
    protected $listeners = ['loanStatusUpdated' => 'refreshComponent'];

    public function refreshComponent()
    {
        // Vous pouvez soit réinitialiser les propriétés, soit rappeler `mount()` pour rafraîchir les données
        $this->mount($this->loan->id);
    }

    public function mount($loanId)
    {
        $this->loan = Loan::with(['borrower', 'agent', 'payment'])
        ->find($loanId);
        // dd($this->loan);
    }

    // Méthode pour valider le prêt
    public function validateLoan($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->status = "validated";
        $loan->save();
        $this->dispatch('loanStatusUpdated');
        
    }

    // Méthode pour rejeter le prêt
    public function rejectLoan($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->status = "rejected";
        $loan->save();
        $this->dispatch('loanStatusUpdated');
    }

    public function render()
    {
        return view('livewire.client.details-loan-component');
    }
}
