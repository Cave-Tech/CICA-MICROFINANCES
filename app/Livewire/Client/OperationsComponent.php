<?php

namespace App\Livewire\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Account;
use App\Models\Loan;


class OperationsComponent extends Component
{

    //Show opperation
    public $operations;
    public $user;
    public $userAccounts;
    //generation de code aleatoir
    public $randomString;
    //Enregistrement de l'operation
    public $operationId;
    public $typeOperation;
    public $typeAccount;
    public $montant;
    public $method = "neutre";
    public $status = "pending";
    public $beneficiaire;
    public $compte_de_destination;
    public $motif;
    public $date;
    public $userId;

    protected $rules = [
        'typeOperation' => 'required',
        'typeAccount' => 'required',
        'montant' => 'required|numeric|min:1',
        'beneficiaire' => 'required',
        'compte_de_destination' => 'required',
        'motif' => 'required',
        // Ajoutez d'autres règles au besoin...
    ];

    public function saveOperation()
    {
        $user = Auth::user();
        $userId = $user->id;
        $userAccount = Account::where('id', $this->typeAccount)->first(); 
        //$destinationAccount = Account::where('account_number', $this->compte_de_destination)->first();
        //$userDestination = User::find($destinationAccount->user_id);
        // Effectuer une jointure entre les tables Account et User pour récupérer le nom de l'utilisateur
        $destinationAccount = Account::where('account_number', $this->compte_de_destination)
        ->join('users', 'accounts.user_id', '=', 'users.id')
        ->select('accounts.*', 'users.name as user_name')
        ->first();

        //dd($destinationAccount->user_name);

        $montant = $this->montant;
        $typeOperation = $this->typeOperation;
        $solde = $userAccount->balance;
        $dates = Carbon::now();
        if ($typeOperation == 2) {
                if ($solde < $montant or $montant == 0) {
                    return redirect('/client-operations')->with("fail", "Retrait impossible - 
                    montant de retrait incorrect ou trop élevé.");
                }else{
                    $operation = new Operation();
                    $operation->user_id = $this->userId = $user->id;
                    $operation->operation_type_id = $this->typeOperation;
                    $operation->withdrawal_amount = $this->montant;
                    $operation->withdrawal_method = $this->method;
                    $operation->transaction_key = $this->randomString = Str::random(10);
                    $operation->status = $this->status;
                    $operation->beneficiaire = $this->beneficiaire;
                    $operation->compte_destination = $this->compte_de_destination;
                    $operation->motif = $this->motif;
                    $operation->account_types_id = $this->typeAccount;
                    $operation->withdrawal_date = $dates;
                    $operation->save();

                    $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

                    return redirect('/client-operations')->with("success", "Demande de retrait envoyée avec succes !");
                }
        }elseif($typeOperation == 3 && !$destinationAccount){
                return redirect('/client-operations')->with("fail", "Numéro de compte introuvable !.");
        }elseif($typeOperation == 3 && $destinationAccount && $this->beneficiaire === $destinationAccount->user_name){
                if ($solde < $montant or $montant == 0) {
                    return redirect('/client-operations')->with("fail", "Virement impossible - montant du virement incorrect ou trop élevé.");
                }else{
                    $operation = new Operation();
                    $operation->user_id = $this->userId = $user->id;
                    $operation->operation_type_id = $this->typeOperation;
                    $operation->withdrawal_amount = $this->montant;
                    $operation->withdrawal_method = $this->method;
                    $operation->transaction_key = $this->randomString = Str::random(10);
                    $operation->status = $this->status;
                    $operation->beneficiaire = $this->beneficiaire;
                    $operation->compte_destination = $this->compte_de_destination;
                    $operation->motif = $this->motif;
                    $operation->account_types_id = $this->typeAccount;
                    $operation->withdrawal_date = $dates;
                    $operation->save();

                    $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

                    return redirect('/client-operations')->with("success", "Demande envoyée avec succes !");
                }
        }elseif($typeOperation == 1 && $montant != 0){
            $operation = new Operation();
            $operation->user_id = $this->userId = $user->id;
            $operation->operation_type_id = $this->typeOperation;
            $operation->withdrawal_amount = $this->montant;
            $operation->withdrawal_method = $this->method;
            $operation->transaction_key = $this->randomString = Str::random(10);
            $operation->status = $this->status;
            $operation->beneficiaire = $this->beneficiaire;
            $operation->compte_destination = $this->compte_de_destination;
            $operation->motif = $this->motif;
            $operation->account_types_id = $this->typeAccount;
            $operation->withdrawal_date = $dates;
            $operation->save();

            $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

            return redirect('/client-operations')->with("success", "Demande envoyée avec succes");
        }elseif($montant == 0){
            return redirect('/client-operations')->with("fail", "Impossible de faire un dépôt de 0 FCFA.");
        }else{
            return redirect('/client-operations')->with("fail", "Nom du bénéficiaire incorrect ! .");
        }
    }


    //Methode d'appel à la confirmation de suppression
    public $operationToDelete;
    public function confirmDelete($operationId)
    {
        $this->operationToDelete = $operationId;
    }
    //Fin Methode d'appel à la confirmation de suppression

    //Suppression d'operation
    public function deleteOperation()
    {
        // Assurez-vous que l'enregistrement existe avant de le supprimer
        if ($this->operationToDelete) {
            $operation = Operation::find($this->operationToDelete);

            if ($operation) {
                $operation->delete();
                // Ajoutez ici un message de succès ou de confirmation

                //session()->flash('success', 'Opération supprimée avec succès.');
                if($operation){
                    return redirect('/client-operations')->with("success", "Oppération supprimée avec succes !");
                }else{
                    return redirect('/client-operations')->with("fail", "Demande envoyée avec succes");
                }

            }
        }
        
        // Réinitialisez la variable d'opération à supprimer
        $this->operationToDelete = null;
    }
    //Fin suppression operation


    //Edit d'operation
    public function editOperation()
    {
        $user = Auth::user();
        $userId = $user->id;
        $userAccount = Account::where('id', $this->typeAccount)->first(); 
        //dd($userAccount);
        $montant = $this->montant;
        $typeOperation = $this->typeOperation;
        $operationToEdit = Operation::find($this->operationId); 
        $solde = $userAccount->balance;
        $destinationAccount = Account::where('account_number', $this->compte_de_destination)
        ->join('users', 'accounts.user_id', '=', 'users.id')
        ->select('accounts.*', 'users.name as user_name')
        ->first();

            if ($typeOperation == 2) {
                if ($solde < $montant or $montant == 0) {
                    return redirect('/client-operations')->with("fail", "Mise à jours impossible - 
                    montant de retrait incorrect ou trop élevé.");
                }else{
                    $operationToEdit->operation_type_id = $this->typeOperation;
                    $operationToEdit->withdrawal_amount = $this->montant;
                    $operationToEdit->beneficiaire = $this->beneficiaire;
                    $operationToEdit->compte_destination = $this->compte_de_destination;
                    $operationToEdit->motif = $this->motif;
                    $operationToEdit->account_types_id = $this->typeAccount;
                    // Enregistre les modifications dans la base de données
                    $operationToEdit->update();
        
                    $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour
        
                    // Redirigez l'utilisateur avec un message de succès ou echec
                    return redirect('/client-operations')->with("success", "Opération mise à jour avec succès.");
                }
        }elseif($typeOperation == 3 && !$destinationAccount){
                return redirect('/client-operations')->with("fail", "Numéro de compte introuvable !.");
        }elseif($typeOperation == 3 && $destinationAccount && $this->beneficiaire === $destinationAccount->user_name){
                if ($solde < $montant or $montant == 0) {
                    return redirect('/client-operations')->with("fail", "Mise à jours impossible - montant du virement incorrect ou trop élevé.");
                }else{
                    $operationToEdit->operation_type_id = $this->typeOperation;
                    $operationToEdit->withdrawal_amount = $this->montant;
                    $operationToEdit->beneficiaire = $this->beneficiaire;
                    $operationToEdit->compte_destination = $this->compte_de_destination;
                    $operationToEdit->motif = $this->motif;
                    $operationToEdit->account_types_id = $this->typeAccount;
                    // Enregistre les modifications dans la base de données
                    $operationToEdit->update();
        
                    $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour
        
                    // Redirigez l'utilisateur avec un message de succès ou echec
                    return redirect('/client-operations')->with("success", "Opération mise à jour avec succès.");
                }
        }elseif($typeOperation == 1 && $montant != 0){
            $operationToEdit->operation_type_id = $this->typeOperation;
            $operationToEdit->withdrawal_amount = $this->montant;
            $operationToEdit->beneficiaire = $this->beneficiaire;
            $operationToEdit->compte_destination = $this->compte_de_destination;
            $operationToEdit->motif = $this->motif;
            $operationToEdit->account_types_id = $this->typeAccount;
            // Enregistre les modifications dans la base de données
            $operationToEdit->update();

            $this->reset(); // Réinitialisez les propriétés du composant après la mise à jour

            // Redirigez l'utilisateur avec un message de succès ou echec
            return redirect('/client-operations')->with("success", "Opération mise à jour avec succès.");
        }elseif($montant == 0){
            return redirect('/client-operations')->with("fail", "Impossible de faire un dépôt de 0 FCFA.");
        }else{
            return redirect('/client-operations')->with("fail", "Nom du bénéficiaire incorrect ! .");
        }
    }
    //Fin Edit operation



    public function render()
    {
        $userId = Auth::user()->id;
        // Récupérer uniquement les opérations associées à l'utilisateur connecté
        $this->operations = Operation::where('user_id', $userId)->orderBy('id', 'desc')->get();
        $this->user = User::with('account', 'operation', 'loan')->find($userId);
        $this->userAccounts = Account::where('user_id', $userId)->get();
        //dd($this->userAccounts);
        return view('livewire.client.operations-component',[
            'userAccounts' => $this->userAccounts,
            // ... autres données à passer à la vue
        ]);
    }
    //Fin Show opperation

    public $loans;
    //ShowEdit opperation
    public function showEdit($operationId)
    {
        $operation = Operation::find($operationId);
        $this->operationId = $operationId;
        $this->montant = $operation->withdrawal_amount;
        $this->typeOperation = $operation->operation_type_id;
        $this->beneficiaire = $operation->beneficiaire;
        $this->compte_de_destination = $operation->compte_destination;
        $this->motif = $operation->motif;
        $this->typeAccount = $operation->account_types_id;
        $this->date = $operation->withdrawal_date;
    }
    //Fin ShowEdit opperation
}
