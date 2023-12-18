<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $user = Auth::user();
        
        if($user->profile_id == 3){
            return redirect()->intended(RouteServiceProvider::CLIENT_HOME);
        }else if($user->profile_id == 4 && $user->employee_type_id == 1){
            return redirect()->intended(RouteServiceProvider::CAISSIER_HOME);
        }else if($user->profile_id == 4 && $user->employee_type_id == 3){
            return redirect()->intended(RouteServiceProvider::AGENT_TERRAIN_HOME);
        }else if($user->profile_id == 4 && $user->employee_type_id == 4){
                return redirect()->intended(RouteServiceProvider::EMPLOYE_HOME);
        }else if($user->profile_id == 4 && $user->employee_type_id == 2){
            return redirect()->intended(RouteServiceProvider::EMPLOYE_HOME);
        }else if($user->profile_id == 4 && $user->employee_type_id == 5){
            return redirect()->intended(RouteServiceProvider::EMPLOYE_HOME);
        }else if($user->profile_id == 4 && $user->employee_type_id == 6){
            return redirect()->intended(RouteServiceProvider::CHARGER_RH);
        }else if($user->profile_id == 1){
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }else{
            return redirect()->intended(RouteServiceProvider::SUPERADMIN_HOME);
        }
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
