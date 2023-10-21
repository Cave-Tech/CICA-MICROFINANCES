<?php

namespace App\Livewire\Employe;

use App\Models\Payment;
use Livewire\Component;

class PaiementListComponent extends Component
{

    public  $paiementLists;
    public function mount(){
        $this->paiementLists = Payment::with('profile')->where('load_id', 4)->get();
    }

    public function render()
    {
        return view('livewire.employe.paiement-list-component');
    }
}
