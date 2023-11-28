<?php

namespace App\Livewire\Employe;

use App\Models\User;
use Livewire\Component;

class EmployeeListComponent extends Component
{
    public $employeeLists;
    public $search = ''; // Ajoutez une propriété de recherche

    public function mount(){
        $this->employeeLists = $this->searchEmployees();
    }

    // Une méthode séparée pour la recherche des employés
    private function searchEmployees(){
        return User::with('profile', 'employeType')
                   ->where('profile_id', 4)
                   ->when($this->search, function($query) {
                       $query->where(function($query) {
                           $query->where('name', 'like', '%' . $this->search . '%')
                                 ->orWhere('email', 'like', '%' . $this->search . '%');
                       });
                   })
                   ->get();
    }

    public function render()
    {
        // Mettez à jour la liste des employés avec les résultats filtrés
        $this->employeeLists = $this->searchEmployees();

        return view('livewire.employe.employee-list-component', [
            'employeeLists' => $this->employeeLists // Passez les résultats filtrés à la vue
        ]);
    }
}

