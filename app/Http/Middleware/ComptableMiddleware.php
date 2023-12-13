<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComptableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){
            session()->flash('fail', 'Vous devez vous connecter pour acceder à cette page;');
            return redirect('/login');
        }

        if(auth()->user()->profile->designation === 'employe' && auth()->user()->employee_type_id == 2) {
            return $next($request);
        }else{
            session()->flash('fail', 'Vous n\'etes pas autoriser à acceder à cette page');
            return redirect('/');
        }
    }
}
