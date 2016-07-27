<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
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
        if (!Auth::guest() && Auth::user()->role == 'admin'){
            return $next($request);
        }

        flash()->warning('Debes autenticarte y ser usuario administrador del sistema para ver esta sección...');

        return redirect()->guest('login');
    }
}
