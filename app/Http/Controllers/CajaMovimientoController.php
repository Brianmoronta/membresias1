<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CajaMovimiento;

class CajaMovimientoController extends Controller
{
   public function index(Request $request)
{
    // Base de la consulta con relaciones
    $query = CajaMovimiento::with('member', 'user');

    // Filtro por código del socio
    if ($request->filled('codigo')) {
        $query->whereHas('member', function ($q) use ($request) {
            $q->where('codigo_sistema', 'like', '%' . $request->codigo . '%');
        });
    }

    // Filtro por cédula del socio
    if ($request->filled('cedula')) {
        $query->whereHas('member', function ($q) use ($request) {
            $q->where('cedula', 'like', '%' . $request->cedula . '%');
        });
    }

    // Filtro por fecha desde
    if ($request->filled('desde')) {
        $query->whereDate('created_at', '>=', $request->desde);
    }

    // Filtro por fecha hasta
    if ($request->filled('hasta')) {
        $query->whereDate('created_at', '<=', $request->hasta);
    }

    // 🔐 Filtro por sucursal si es admin (no superadmin)
    if (auth()->user()->hasRole('admin') && auth()->user()->idsucursal != 0) {
        $query->whereHas('user', function ($q) {
            $q->where('idsucursal', auth()->user()->idsucursal);
        });
    }

    // Total antes de paginar
    $totalIngresos = $query->sum('monto');

    // Paginación y orden
    $movimientos = $query->latest()->paginate(10);

    return view('admin.caja.index', compact('movimientos', 'totalIngresos'));
}


public function confirmar($id)
{
    $movimiento = CajaMovimiento::findOrFail($id);

    if ($movimiento->estado !== 'pendiente') {
        return back()->with('info', 'Este movimiento ya fue confirmado.');
    }

    $movimiento->update([
        'estado' => 'confirmado',
        'fecha_confirmacion' => now(),
        'confirmado_por' => auth()->id(),
        'referencia' => 'EF-' . now()->format('His'), // Asigna número de recibo único por hora si quieres
    ]);

    return back()->with('success', 'Pago confirmado exitosamente.');
}

public function confirmarConReferencia(Request $request, $id)
{
    $request->validate([
        'referencia' => 'required|string|max:255'
    ]);

    $movimiento = CajaMovimiento::findOrFail($id);

    if ($movimiento->estado === 'pendiente') {
        $movimiento->update([
            'estado' => 'confirmado',
            'referencia' => $request->referencia,
            'fecha_confirmacion' => now(),
            'confirmado_por' => auth()->id(),
        ]);
    }

    return redirect()->route('admin.caja.index')->with('success', 'Pago confirmado con referencia.');
}

}
