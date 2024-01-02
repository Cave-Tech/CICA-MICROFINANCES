<?php

namespace App\Livewire\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InscriptionComponent extends Component
{
    public $name;
    public $email;
    public $nationality;
    public $gender;
    public $birthdate;
    public $type_card;
    public $number_carte;
    public $number_of_dependents;
    public $occupation;
    public $phone;
    public $marital_status;
    public $hiring_date;
    public $position;
    public $department;
    public $address;
    public $education_level;
    public $employee_type_id;
    public $emergency_contact_name;
    public $emergency_contact_relation;
    public $emergency_contact_phone;
    public $localisation;

    public function render()
    {
        return view('livewire.inscription.inscription-component');
    }

    public function register()
    {
       
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'nationality' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'birthdate' => 'required|date',
            'type_card' => 'required|string|in:card,passport',
            'number_carte' => 'required|string|unique:users,number_carte',
            'number_of_dependents' => 'required|in:0,15,510,10000',
            'occupation' => 'required|string|max:500',
            'phone' => 'required|numeric',
            'employee_type_id' => 'required|numeric',
            'department' => 'required|string',
            'address' => 'required|string',
            'localisation' => 'required|string',
            'marital_status' => 'required|string',
            'hiring_date' => 'required|date',
            'position' => 'required|string',
            'education_level' => 'required|string',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_relation' => 'required|string',
            'emergency_contact_phone' => 'required|string',
        ]);

        $user = Auth::user();
        $userId = $user->id;
        $temporaryPassword = Str::random(8);
        Mail::to($this->email)->send(new TemporaryPasswordMail($temporaryPassword));
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'agent_id' => $userId,
            'profile_id' => 4,
            'employee_type_id' => $this->employee_type_id,
            'password' => Hash::make($temporaryPassword),
            'nationality' => $this->nationality,
            'gender' => $this->gender,
            'birth_date' => $this->birthdate,
            'id_type' => $this->type_card,
            'id_number' => $this->number_carte,
            'localisation' => $this->localisation,
            'number_of_dependents' => $this->number_of_dependents,
            'occupation' => $this->occupation,
            'phone' => $this->phone,
            'department' => $this->department,
            'marital_status' => $this->marital_status,
            'address' => $this->address, // Assurez-vous que 'adresse' existe dans votre formulaire
            'hiring_date' => $this->hiring_date,
            'position' => $this->position,
            'education_level' => $this->education_level,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_relation' => $this->emergency_contact_relation, // Assurez-vous que 'emergency_contact_relation' existe dans votre formulaire
            'emergency_contact_phone' => $this->emergency_contact_phone,
        ]);

        return redirect('/inscription-employer')->with('success', 'Votre compte a été créé avec succès. Vérifiez votre e-mail !');
        

    }
}
