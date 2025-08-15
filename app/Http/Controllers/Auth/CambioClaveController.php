<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CambioClaveController extends Controller
{
    public function form()
    {
        return view('auth.cambiar-clave');
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->debe_cambiar_clave = false;
        $user->save();

        return redirect()->route(auth()->user()->hasRole('admin') ? 'admin.dashboard' : 'member.dashboard')
    ->with('status', 'Contraseña actualizada correctamente.');

    }
}
