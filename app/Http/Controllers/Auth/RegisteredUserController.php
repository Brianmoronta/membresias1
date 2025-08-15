<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Notifications\BienvenidaUsuario;

class RegisteredUserController extends Controller
{
    public function create(Request $request): View
    {
        return view('auth.register', [
            'desde_agendar' => $request->query('desde_agendar')
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $fromAgendar = $request->filled('desde_agendar') && $request->desde_agendar == '1';

        // Verificar si ya existe un usuario con ese email
        $existingUser = User::where('email', $request->email)->first();

        if ($fromAgendar && $existingUser) {
            // Si existe y la contraseña es válida
            if (Hash::check($request->password, $existingUser->password)) {
                Auth::login($existingUser);
                return redirect()->route('reservas.calendario');
            } else {
                // Si no coincide, forzar a login con mensaje
                return redirect()->route('login')->withErrors([
                    'email' => 'Ya tienes una cuenta. Inicia sesión para agendar tu visita.',
                ]);
            }
        }

        // Crear nuevo usuario
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'user',
            'cedula'      => $request->cedula,
            'idsucursal'  => 9999,
        ]);

        $user->assignRole('user');
        event(new Registered($user));
        Auth::login($user);

        // Si vino desde Agendar
        if ($fromAgendar) {
            return redirect()->route('reservas.calendario');
        }

        // Redirección estándar según rol
        return match (true) {
            $user->hasRole('admin') => redirect()->route('admin.dashboard'),
            $user->hasRole('user')  => redirect()->route('member.dashboard'),
            default => redirect()->route('login')->withErrors([
                'email' => 'Tu cuenta no tiene un rol válido.',
            ]),
        };
    }


    }
