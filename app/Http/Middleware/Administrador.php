<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Administrador
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        if (Auth::user()->tipo_usuario !== 'administrador') {

            return redirect('/')->with('error', 'No tienes permisos de administrador');
        }

        return $next($request);
    }
}
