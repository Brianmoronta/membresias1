<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CajaMovimiento;
use App\Models\Member;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    $user = auth()->user();

    // 👤 Miembro externo (idsucursal 9999)
    if ($user->idsucursal == 9999) {
        $reservas = Reserva::where('user_id', $user->id)->latest()->get();
        return view('member.dashboard', compact('reservas'));
    }

    // 🏡 Usuario del club (idsucursal > 0 pero no superadmin)
    if ($user->idsucursal !== 0) {
        $reservas = Reserva::whereHas('usuario', function ($q) {
            $q->where('idsucursal', 9999);
        })->latest()->get();
        return view('club.dashboard', compact('reservas')); // Asegúrate de tener esta vista
    }

    // 👑 Superadmin (idsucursal == 0)
    $reservas = Reserva::whereHas('usuario', function ($q) {
        $q->where('idsucursal', 9999);
    })->latest()->get();

    $totalSocios = Member::count();
    $movimientosCaja = CajaMovimiento::count();
    $totalConfirmado = CajaMovimiento::where('estado', 'confirmado')->sum('monto');

    $labels = [];
    $datos = [];

    for ($i = 5; $i >= 0; $i--) {
        $fecha = now()->subMonths($i);
        $labels[] = $fecha->format('F');
        $datos[] = Member::whereMonth('created_at', $fecha->month)
                         ->whereYear('created_at', $fecha->year)
                         ->count();
    }

    return view('admin.dashboard', compact(
        'totalSocios',
        'movimientosCaja',
        'totalConfirmado',
        'labels',
        'datos',
        'reservas' // MUY IMPORTANTE ENVIARLA
    ));
}

}
