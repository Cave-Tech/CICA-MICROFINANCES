<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutComponent extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect(Route::getRoutes()->getByName('login')->uri());
    }

    public function render()
    {
        return view('livewire.logout-component');
    }
}
