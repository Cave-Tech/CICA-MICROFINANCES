<?php

namespace App\Livewire\Employe;

use App\Models\Payment;
use Livewire\Component;

class PaiementListComponent extends Component
{

    public  $paiementLists;
    public function mount(){
        //Trier par ordre décroissant
        $this->paiementLists = Payment::with('profile')->orderBy('id', 'desc')->where('load_id', 4)->get();
    }

    public function render()
    {
        return view('livewire.employe.paiement-list-component');
    }
}
