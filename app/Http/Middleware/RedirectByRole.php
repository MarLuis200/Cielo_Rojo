<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectByRole
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->tipo_usuario === 'administrador' && !$request->is('dash2*')) {
                return redirect('/dash2');
            }

            if ($user->tipo_usuario === 'visitante' && !$request->is('/')) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
