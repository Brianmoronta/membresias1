<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForzarCambioClave
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (
            $user &&
            $user->role === 'admin' &&
            $user->idsucursal != 0 &&
            $user->idsucursal != 9999 &&
            $user->debe_cambiar_clave &&
            !$request->is('cambiar-clave') &&
            !$request->is('logout')
        ) {
            return redirect()->route('cambiar-clave.form');
        }

        return $next($request);
    }
}

