<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

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

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'nationality' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'type_card' => ['required', 'string'],
            'number_carte' => ['required', 'string', 'unique:'.User::class],
            'number_of_dependents' => ['required', 'numeric'],
            'Profession' => ['required', 'string', 'max:500'],
            'phone' => ['required', 'numeric'],
            'marital_status' => ['required', 'string'],
            'adresse' => ['required', 'string'],
            'localisation' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'string'],
        ]);

        //dd($request);

        $user = User::create([
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'birth_date' => $request->birthdate,
            'id_type' => $request->type_card,
            'id_number' => $request->number_carte,
            'number_of_dependents' => $request->number_of_dependents,
            'occupation' => $request->Profession,
            'phone' =>$request->phone,
            'localisation' =>$request->localisation,
            'marital_status' => $request->marital_status,
            'address' => $request->adresse,
            'profile_id' => 3,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect('/login');
        //return redirect(RouteServiceProvider::HOME);
    }
}
