<?php

namespace App\Livewire\Inscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Str;
//namespace App\Http\Livewire\Auth;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InscriptionComponent extends Component
{
    public function render()
    {
        return view('livewire.inscription.inscription-component');
    }


    public $name;
    public $email;
    public $typeEmploye;
    //public $password;
    //public $password_confirmation;
    public $terms;
    public function register()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'typeEmploye' => 'required|in:1,2,3,4,5,6', // Adjust the in rule based on your options
            'terms' => 'required|accepted',
        ]);

         // Générer un mot de passe aléatoire
        $temporaryPassword = Str::random(8);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'profile_id' => 4,
            'employee_type_id' => $this->typeEmploye,
            'password' => Hash::make($temporaryPassword),
        ]);

        // Envoyer le mot de passe temporaire par e-mail
        Mail::to($user->email)->send(new TemporaryPasswordMail($temporaryPassword));
        // Optionally, you can log in the user after registration
        // auth()->login($user);
        
        // Redirect or emit an event to redirect the user to the login page
        return redirect('/inscription-employer')->with('success', 'Votre compte a été créé avec succès. Vérifez votre mail !');
        //$this->emit('redirectLogin'); // Assuming you have a Livewire listener for this event
    }
}
