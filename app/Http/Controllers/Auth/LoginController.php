<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirige al usuario según su tipo.
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->tipo_usuario === 'administrador') {
            return '/dash2';
        } elseif ($user->tipo_usuario === 'visitante') {
            return '/';
        }

        return '/';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
