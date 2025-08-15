<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerifiedSegunRol
{
    public function handle($request, Closure $next)
{
    $user = $request->user();
   
    // Si está autenticado y tiene correo verificado
    if ($user && $user->hasVerifiedEmail()) {
        return $next($request);
    }

    // Permitir paso si es superadmin (idsucursal = 0)
    if ($user && $user->role === 'admin' && $user->idsucursal == 0) {
        return $next($request);
    }

    // Permitir paso si es admin interno (idsucursal ≠ 0 y ≠ 9999)
    if ($user && $user->role === 'admin' && $user->idsucursal != 0 && $user->idsucursal != 9999) {
        return $next($request);
    }

    // Todos los demás deben verificar su correo
    return redirect()->route('verification.notice');
}
}
