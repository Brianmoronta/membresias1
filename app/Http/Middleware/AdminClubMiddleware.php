<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminClubMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
{
    $user = auth()->user();

    if ($user->idsucursal == 0 || ($user->role === 'admin' && $user->es_usuario_club == 1)) {
        return $next($request);
    }

    abort(403, 'No tienes permiso para acceder.');
}

}
