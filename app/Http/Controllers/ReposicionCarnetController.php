<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\CajaMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReposicionCarnetController extends Controller
{
    public function create(Member $member)
    {
        // ✅ Validar acceso por sucursal
        if (auth()->user()->idsucursal == 9999) {
            abort(403, 'No tienes permiso para acceder a esta funcionalidad.');
        }

        $costo = $member->membershipType->costo_perdida ?? 0;
        return view('reposicion_carnet.create', compact('member', 'costo'));
    }

    public function store(Request $request, Member $member)
    {
        // ✅ Validar acceso por sucursal
        if (auth()->user()->idsucursal == 9999) {
            abort(403, 'No tienes permiso para acceder a esta funcionalidad.');
        }

 $request->validate([
        'forma_pago' => 'required|in:efectivo,tarjeta,online',
        'referencia' => 'nullable|string|max:255',
    ]);

    $monto = $member->membershipType->costo_perdida ?? 0;

    CajaMovimiento::create([
        'member_id'      => $member->id,
        'user_id'        => Auth::id(),
        'monto'          => $monto,
        'concepto'       => 'Reposición de carnet',
        'forma_pago'     => $request->forma_pago,
        'estado_pago'    => 'pendiente',
        'estado'         => 'pendiente',
        'referencia'     => $request->forma_pago != 'efectivo' ? $request->referencia : null,
    ]);

    return redirect()->route('admin.caja.index')
        ->with('success', 'Movimiento por reposición de carnet registrado.');
    }
}
