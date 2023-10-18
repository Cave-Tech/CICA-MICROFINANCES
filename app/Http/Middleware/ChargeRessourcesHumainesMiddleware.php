<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChargeRessourcesHumainesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->profile->designation === 'employe' && auth()->user()->employeeType->designation === 'charger_rh') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
