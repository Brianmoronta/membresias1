<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Traits\HasRoles;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    
public function store(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // 🚨 Verificación de correo (opcional, puedes activarlo si quieres)
    // if (! $user->hasVerifiedEmail()) {
    //     Auth::logout();
    //     return redirect()->route('verification.notice')
    //         ->withErrors(['email' => 'Debes verificar tu correo electrónico antes de continuar.']);
    // }

    // ✅ Si venía desde "Agendar ahora", redirige al calendario
    if ($request->filled('desde_agendar') && $request->desde_agendar == '1') {
        return redirect()->route('reservas.calendario');
    }

    // 🔄 Redirección por rol
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('user')) {
        return redirect()->route('member.dashboard');
    } else {
        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'Tu cuenta no tiene rol asignado.']);
    }
}
   /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
