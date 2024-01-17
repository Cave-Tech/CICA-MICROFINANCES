<?php

namespace App\Livewire\Employe;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;

class ListeCreateClientComponent extends Component
{
    public $search = '';
    public $customerLists;
    public $userId;
    public function mount(){
        $user = Auth::user();
        $this->userId = $user->id;
        $this->customerLists = User::where('agent_id', $this->userId)->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        
        // Mettez à jour la requête pour inclure la recherche
        $this->customerLists = User::where('agent_id', $this->userId)
                                    ->where(function($query) {
                                        $query->where('name', 'like', '%' . $this->search . '%')
                                              ->orWhere('email', 'like', '%' . $this->search . '%');
                                    })
                                    //Trier par ordre decroissant
                                    ->orderBy('id', 'desc')
                                    ->get();
     
        return view('livewire.employe.liste-create-client-component', [
            'customerLists' => $this->customerLists // Passez les résultats filtrés à la vue
        ]);
    }
}
