<?php

namespace App\Livewire\Client;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Account;
use App\Models\Loan;

class LoanRequestComponent extends Component
{
    use WithFileUploads;
    public $user;
    public function render()
    {
        $userid = Auth::user()->id;
        $this->user = User::with('account', 'operation', 'loan')->find($userid);
        return view('livewire.client.loan-request-component');
    }

    
    public $loanId;
    public $id;

    public $idloan;
    public $amount;
    public $typeloan;
    public $typeWarranty;
    public $valueWarranty;
    public $detailsWarranty;
    public $purposeWarranty;
    public $nameWarrantor;
    public $addressWarrantor;
    public $numWarrantor;
    public $dateloan;
    public $interestRate; 
    public $relationWarrantor;
    public $docFiles;
    public $userId;
    public $loanTerm;


    protected $rules = [
        'amount' => 'required|numeric|min:1000',
        'typeloan' => 'required',
        'typeWarranty' => 'required',
        'valueWarranty' => 'required|numeric|min:1',
        'detailsWarranty' => 'required',
        'purposeWarranty' => 'required',
        'nameWarrantor' => 'required',
        'numWarrantor' => 'required|numeric',
        'addressWarrantor' => 'required',
        'relationWarrantor' => 'required',
        'loanTerm' => 'required|numeric|min:1',
        // Ajoutez d'autres règles au besoin...
    ];

    public function saveLoan()
    {
        // Validez les données du formulaire (ajoutez des règles de validation si nécessaire)

        // Calcul du taux d'intérêt en fonction du montant du prêt
        if ($this->amount >= 1000 && $this->amount <= 100000) {
            $interestRate = 5;
        } elseif ($this->amount > 100000 && $this->amount <= 200000) {
            $interestRate = 10;
        } elseif ($this->amount > 200000) {
            $interestRate = 15;
        } else {
            $interestRate = 0;
        }

        // Enregistrez les données du prêt dans la table "loans"
        $user = Auth::user();
        $userId = $user->id;
        $saveLoan = new Loan();

        // Remplacez le reste du code par les données du prêt et le taux d'intérêt calculé
        $saveLoan->borrower_id = $this->userId = $user->id;
        $saveLoan->loan_amount = $this->amount;
        $saveLoan->loan_type_id = $this->typeloan;
        $saveLoan->status = "pending";
        $saveLoan->type_warranty = $this->typeWarranty;
        $saveLoan->value_warranty = $this->valueWarranty;
        $saveLoan->details_warranty = $this->detailsWarranty;
        $saveLoan->purpose_warranty = $this->purposeWarranty;
        $saveLoan->name_warrantor = $this->nameWarrantor;
        $saveLoan->address_warrantor = $this->addressWarrantor;
        $saveLoan->number_warrantor = $this->numWarrantor;
        $saveLoan->relation_warrantor = $this->relationWarrantor;
        $saveLoan->interest_rate = $interestRate; // Utilisation du taux d'intérêt calculé
        $saveLoan->payment_frequency = $this->loanTerm;
        $saveLoan->loan_date = now();
        $saveLoan->doc_files = $this->docFiles ? $this->docFiles->store('loan_documents', 'public') : ''; // Vérification du fichier avant de l'enregistrer

        // Enregistrez le prêt
        $saveLoan->save();

        if ($saveLoan) {
            return redirect('/client-loan-request')->with("success", "Demande envoyée avec succès !");
        } else {
            return redirect('/client-loan-request')->with("fail", "Quelque chose s'est mal passé.");
        }
    }



    //ShowEdit Loan
    public function showEditLoan($loanId)
    {
        $loan = Loan::find($loanId);
        $this->idloan = $loan->id;
        $this->amount = $loan->loan_amount;
        $this->typeloan = $loan->loan_type_id;
        $this->typeWarranty = $loan->type_warranty;
        $this->detailsWarranty = $loan->details_warranty;
        $this->valueWarranty = $loan->value_warranty;
        $this->purposeWarranty = $loan->purpose_warranty;
        $this->nameWarrantor = $loan->name_warrantor;
        $this->addressWarrantor = $loan->address_warrantor;
        $this->numWarrantor = $loan->number_warrantor;
        $this->relationWarrantor = $loan->relation_warrantor;
        $this->valueWarranty = $loan->value_warranty;
        $this->loanTerm = $loan->payment_frequency;
    }
    //Fin ShowEdit Loan


    //Edit d'loan
    public function EditLoan()
    {
        $LoanToEdit = Loan::find($this->idloan);

        //dd($this->nameWarrantor,$this->addressWarrantor );
            if ($LoanToEdit) {
                if ($this->amount >= 1000 && $this->amount <= 100000) {
                    $interestRate = 5;
                } elseif ($this->amount > 100000 && $this->amount <= 200000) {
                    $interestRate = 10;
                } elseif ($this->amount > 200000) {
                    $interestRate = 15;
                } else {
                    $interestRate = 0;
                }
                // Mets à jour les attributs de l'opération à partir des propriétés du composant
                $LoanToEdit->loan_amount = $this->amount;
                $LoanToEdit->loan_type_id = $this->typeloan;
                $LoanToEdit->status = "pending";
                $LoanToEdit->type_warranty = $this->typeWarranty;
                $LoanToEdit->value_warranty = $this->valueWarranty;
                $LoanToEdit->details_warranty = $this->detailsWarranty;
                $LoanToEdit->purpose_warranty = $this->purposeWarranty;
                $LoanToEdit->name_warrantor = $this->nameWarrantor;
                $LoanToEdit->address_warrantor = $this->addressWarrantor;
                $LoanToEdit->number_warrantor = $this->numWarrantor;
                $LoanToEdit->relation_warrantor = $this->relationWarrantor;
                $LoanToEdit->payment_frequency = $this->loanTerm;
                $LoanToEdit->interest_rate = $interestRate;
                
                // Enregistre les modifications dans la base de données
                $LoanToEdit->update();
    
                $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour
    
                // Redirigez l'utilisateur avec un message de succès ou echec
                return redirect('/client-loan-request')->with("success", "Prêt mise à jour avec succès.");
            } else {
                return redirect('/client-loan-request')->with("fail", "Prêt non trouvée.");
            }
    }
    //Fin Edit loan
    
}
