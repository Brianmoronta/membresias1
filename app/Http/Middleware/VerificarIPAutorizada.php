<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class VerificarIPAutorizada
{
    public function handle(Request $request, Closure $next)
    {
        
        //dd('IP real detectada: ' . $request->ip());

        $ipsPermitidas = explode(',', env('VISITAS_IPS_AUTORIZADAS', ''));
        $ipCliente = $request->ip();

        if (!in_array($ipCliente, $ipsPermitidas)) {
            //return response('Acceso no autorizado desde esta IP', 403);
            return redirect()->route('login')->with('error', 'Acceso no autorizado desde esta IP.');
        }


        return $next($request);
    }
}
