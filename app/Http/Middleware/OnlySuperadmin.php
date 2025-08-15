<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlySuperadmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); // 👈 AQUÍ definimos $user correctamente

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }

        if ($user->idsucursal !== 0) {
            // Si es un admin normal (no superadmin), lo redirigimos a Caja
            return redirect()->route('admin.caja.index');
        }

        return $next($request);
    }
}
