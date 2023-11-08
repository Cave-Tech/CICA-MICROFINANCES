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

    public $amount;
    public $typeloan;
    public $typeWarranty;
    public $valueWarranty;
    public $detailsWarranty;
    public $purposeWarranty;
    public $nameWarrantor;
    public $addressWarrantor;
    public $numWarrantor;
    public $relationWarrantor;
    public $docFiles;

    public function saveLoan()
    {
        
        // Validez les données du formulaire (ajoutez des règles de validation si nécessaire)

        // Enregistrez les données du prêt dans la table "loans"
        $user = Auth::user();
        $userId = $user->id;
        $saveLoan = new Loan();

        if($this->docFiles==""){
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
            $saveLoan->doc_files = "";
            $saveLoan->save();
                if($saveLoan){
                    return redirect('/client-loan-request')->with("success", "Demande envoyée avec succes !");
                }else{
                    return redirect('/client-loan-request')->with("fail", "Quelque chose s'est mal passée.");
                }

        }else{
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
            $saveLoan->doc_files = $this->docFiles->store('loan_documents', 'public'); // Enregistrez le fichier et obtenez le chemin
            //dd($saveLoan);
                $saveLoan->save();
                if($saveLoan){
                    return redirect('/client-loan-request')->with("success", "Demande envoyée avec succes !");
                }else{
                    return redirect('/client-loan-request')->with("fail", "Quelque chose s'est mal passée.");
                }
        }
    
    }


    //ShowEdit Loan
    public function showEditLoan($loanId)
    {
        $loan = Operation::find($loanId);
        $this->montant = $loan->loan_amount;
        $this->type_warranty = $loan->type_warranty;
        $this->value_warranty = $loan->value_warranty;
    }
    //Fin ShowEdit Loan

}
