<?php

namespace App\Livewire\Client;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;


class OperationsComponent extends Component
{

    
    //generation de code aleatoir
    public $randomString;
    public function generateRandomString()
    {
        $this->randomString = Str::random(10);
    }


    /*public $user;
    public function mount()
    {
        $user = Auth::user();
        $this->user = auth()->user();
    }*/




    
    //Enregistrement de l'operation
    //public $iduser = 1;
    public $typeOperation;
    public $montant;
    public $method = "neutre";
    //public $id_employe = "id_employe";
    public $status = "en cours";
    //public $codeUnique;
    public $date;

    public function saveOperation()
    {
        $user = Auth::user();
        $operation = new Operation();
        $operation->user_id = $this->userId = $user->id;
        $operation->operation_type_id = $this->typeOperation;
        $operation->withdrawal_amount = $this->montant;
        $operation->withdrawal_method = $this->method;
        //$operation->id_employe = $this->id_employe;
        $operation->transaction_key = $this->randomString = Str::random(10);
        $operation->status = $this->status;
        $operation->withdrawal_date = $this->date;
        $operation->save();

        $this->reset(); // Réinitialiser les champs du formulaire après l'ajout

        if($operation){
            return redirect('/client-operations')->with("success", "Demande envoyée aec succes !");
        }else{
            return redirect('/client-operations')->with("fail", "Demande envoyée aec succes");
        }
    }

    public $operations;
    public function render()
    {
        $this->operations=Operation::All();
        return view('livewire.client.operations-component');
    }
}
