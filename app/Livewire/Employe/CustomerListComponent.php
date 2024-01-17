<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class CustomerListComponent extends Component
{

    public $search = '';
    public  $customerLists;
    public function mount(){
        $this->customerLists = User::with('profile')->orderBy('id', 'desc')->where('profile_id', 3)->get();
    }

    public function render()
    {
        // Mettez à jour la requête pour inclure la recherche
        $this->customerLists = User::with('profile')
                                    ->where('profile_id', 3)
                                    ->where(function($query) {
                                        $query->where('name', 'like', '%' . $this->search . '%')
                                              ->orWhere('email', 'like', '%' . $this->search . '%');
                                    })
                                    //Trier par ordre decroissant
                                    ->orderBy('id', 'desc')
                                    ->get();
     
        return view('livewire.employe.customer-list-component', [
            'customerLists' => $this->customerLists // Passez les résultats filtrés à la vue
        ]);
    }

    
}
