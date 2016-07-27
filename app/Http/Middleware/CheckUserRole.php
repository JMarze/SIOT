<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guest() && (Auth::user()->role == 'user' || Auth::user()->role == 'admin')){
            return $next($request);
        }

        flash()->warning('Debes autenticarte y ser usuario del sistema para ver esta sección...');

        return redirect()->guest('login');
    }
}
