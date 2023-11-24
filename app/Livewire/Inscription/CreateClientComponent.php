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

    public function createClient()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
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
            //'password' => bcrypt($this->password),
        ]);
        //dd($client);
        // Réinitialisation des champs après l'enregistrement
        $this->reset(['name', 'email', 'password', 'password_confirmation']);

        // Message de succès
        return redirect('/create-client')->with("success", "Client créé avec success !.");
        // return redirect('/dashboard');
    }


    public function render()
    {
        return view('livewire.inscription.create-client-component');
    }
}
