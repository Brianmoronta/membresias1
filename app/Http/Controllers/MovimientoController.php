<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Member;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    public function create()
    {
        $socios = Member::all(); // Puedes filtrar si quieres solo activos
        return view('movimientos.create', compact('socios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'membership_number' => 'required|exists:members,membership_number',
            'monto' => 'required|numeric|min:0.01',
            'concepto' => 'nullable|string|max:255',
            'fecha' => 'required|date',
        ]);

        $socio = Member::where('membership_number', $request->membership_number)->first();

        // Calcular gasto acumulado del mes
        $inicioMes = Carbon::parse($request->fecha)->startOfMonth();
        $finMes = Carbon::parse($request->fecha)->endOfMonth();

        $gastoDelMes = Movimiento::where('membership_number', $socio->membership_number)
            ->whereBetween('fecha', [$inicioMes, $finMes])
            ->sum('monto');

        $nuevoTotal = $gastoDelMes + $request->monto;

        if ($socio->gasto_tope && $nuevoTotal > $socio->gasto_tope) {
            return back()->with('error', '⚠️ Este gasto excede el tope mensual del socio. Gasto acumulado: RD$' . number_format($gastoDelMes, 2));
        }

        Movimiento::create($request->all());

        return redirect()->route('movimientos.create')->with('success', 'Movimiento registrado correctamente.');
    }
}
