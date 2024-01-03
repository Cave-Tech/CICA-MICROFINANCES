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
    public $localisation;

    public $type_client;
    public $name_company;
    public $ifu_company;
    public $date_create;
    public $address_company;
    public $activity_sector;
    public $number_employed;
    public $tel_company;
    public $mail_company;
    public $capital;
    public $annual_pension;
    public $detail;

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
            'number_carte' => 'required|string|unique:users,id_number',
            'number_of_dependents' => 'required|in:0,15,510,10000',
            'Profession' => 'required|string',
            'localisation' => 'required|string',
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
            'localisation' => $this->localisation,
            'marital_status' => $this->marital_status,
            'address' => $this->adresse,
            
            'type_client' => $this->type_client,
            'name_company'=> $this->name_company,
            'ifu_company'=> $this->ifu_company,
            'date_create'=> $this->date_create,
            'address_company'=> $this->address_company,
            'activity_sector'=> $this->activity_sector,
            'number_employed'=> $this->number_employed,
            'tel_company'=> $this->tel_company,
            'mail_company'=> $this->mail_company,
            'capital'=> $this->capital,
            'annual_pension'=> $this->annual_pension,
            'detail'=> $this->detail,
        ]);
        //dd($client);

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
