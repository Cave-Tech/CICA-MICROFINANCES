<?php

namespace App\Livewire\Inscription;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateClientComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $nationality;
    public $gender;
    public $birthdate;
    public $type_card;
    public $number_carte;
    public $number_of_dependents;
    public $Profession;
    public $phone;
    public $marital_status;
    public $adresse;

    public function createClient()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nationality' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'birthdate' => 'required|date',
            'type_card' => 'required|in:card,passport',
            'number_carte' => 'required|string',
            'number_of_dependents' => 'required|in:0,15,510,10000',
            'Profession' => 'required|string',
            'phone' => 'required|numeric',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'adresse' => 'required|string',
        ]);

        // Enregistrement du client avec l'id de l'utilisateur connecté
        $user = Auth::user();
        $userId = $user->id;
        $client = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'agent_id' => $userId,
            'profile_id' => 3,
            'nationality' => $this->nationality,
            'gender' => $this->gender,
            'birth_date' => $this->birthdate,
            'id_type' => $this->type_card,
            'id_number' => $this->number_carte,
            'number_of_dependents' => $this->number_of_dependents,
            'Profession' => $this->Profession,
            'phone' => $this->phone,
            'marital_status' => $this->marital_status,
            'address' => $this->adresse,
        ]);

        // Réinitialisation des champs après l'enregistrement
        $this->reset([
            'name', 'email', 'password', 'password_confirmation',
            'nationality', 'gender', 'birthdate', 'type_card', 'number_carte',
            'number_of_dependents', 'Profession', 'phone', 'marital_status', 'adresse'
        ]);

        // Message de succès
        session()->flash("success", "Client créé avec succès !");

        // Redirection
        return redirect('/create-client');
    }

    public function render()
    {
        return view('livewire.inscription.create-client-component');
    }
}
