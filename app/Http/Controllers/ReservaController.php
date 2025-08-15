<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Promocion;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use App\Models\Habitacion;



class ReservaController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'rooms' => 'required|integer|min:1',
        'guests' => 'required|integer|min:1',
        'habitacion_id' => 'required|exists:habitacions,id',
    ]);

    $checkIn = Carbon::parse($request->check_in);
    $checkOut = Carbon::parse($request->check_out);
    $fechasSolicitadas = [];

    while ($checkIn < $checkOut) {
        $fechasSolicitadas[] = $checkIn->toDateString();
        $checkIn->addDay();
    }

    // 🔍 Buscar habitación y capacidad
    $habitacion = Habitacion::findOrFail($request->habitacion_id);
    $capacidad = $habitacion->capacidad;

    if ($habitacion->es_compartida) {
        // ✅ Lógica para habitaciones compartidas
        foreach ($fechasSolicitadas as $fecha) {
            $personasReservadasEseDia = Reserva::where('habitacion_id', $habitacion->id)
                ->where('check_in', '<=', $fecha)
                ->where('check_out', '>', $fecha)
                ->sum('guests');

            if ($personasReservadasEseDia + $request->guests > $capacidad) {
                return response()->json([
                    'success' => false,
                    'message' => "❌ El día $fecha ya alcanzó la capacidad máxima. Solo quedan " . max(0, $capacidad - $personasReservadasEseDia) . " espacio(s)."
                ]);
            }
        }
    } else {
        // 🚫 Lógica para habitaciones privadas
        $hayChoque = Reserva::where('habitacion_id', $habitacion->id)
            ->where(function($q) use ($request) {
                $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                  ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                  ->orWhere(function($query) use ($request) {
                      $query->where('check_in', '<=', $request->check_in)
                            ->where('check_out', '>=', $request->check_out);
                  });
            })
            ->exists();

        if ($hayChoque) {
            return response()->json([
                'success' => false,
                'message' => '❌ Esta habitación ya está reservada en ese rango de fechas. Elige otra o modifica las fechas.'
            ]);
        }
    }

    // ✅ Guardar reserva
    Reserva::create([
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
        'rooms' => $request->rooms,
        'guests' => $request->guests,
        'user_id' => auth()->id(),
        'habitacion_id' => $habitacion->id,
    ]);

    return response()->json([
        'success' => true,
        'message' => '✅ ¡Reserva registrada exitosamente!'
    ]);
}

public function calendario()
{
    return view('reservas.calendario');
}



    // Para devolver todas las reservas (usado por el calendario)
public function index()
{
    $habitaciones = Habitacion::where('estado', 1)->get(); // Solo las activas
    $fechasOcupadas = []; // Cargar según habitación seleccionada luego
    $fechasPromocion = []; // Igual

    return view('reservas.index', compact('habitaciones', 'fechasOcupadas', 'fechasPromocion'));
}


public function mostrarVista(Request $request)
{
    $habitaciones = Habitacion::where('estado', 1)->get();
    $habitacionSeleccionada = $request->habitacion_id 
        ? Habitacion::find($request->habitacion_id) 
        : $habitaciones->first();

    $fechasOcupadas = [];

    $reservas = Reserva::where('habitacion_id', $habitacionSeleccionada->id)->get();

    foreach ($reservas as $reserva) {
        $checkIn = Carbon::parse($reserva->check_in);
        $checkOut = Carbon::parse($reserva->check_out)->subDay();

        $periodo = CarbonPeriod::create($checkIn, $checkOut);
        foreach ($periodo as $fecha) {
            $fechasOcupadas[] = $fecha->toDateString();
        }
    }

    $fechasPromocion = Promocion::pluck('fecha')->toArray();

    $tusReservas = Reserva::where('user_id', auth()->id())
        ->where('habitacion_id', $habitacionSeleccionada->id)
        ->orderBy('check_in', 'desc')
        ->take(5)
        ->get();

    return view('reservas.calendario', compact(
        'fechasOcupadas',
        'fechasPromocion',
        'tusReservas',
        'habitaciones',
        'habitacionSeleccionada'
    ));
}



public function calendarioAdmin()
{
    $user = Auth::user();

    // Validación de permisos
    if (
        $user->role !== 'admin' ||
        ($user->idsucursal !== 0 && $user->es_usuario_club != 1)
    ) {
        abort(403, 'No tienes permiso para ver las reservas');
    }

    // Traer TODAS las reservas porque son externas (sin filtro por sucursal)
    $reservas = Reserva::with('usuario')->get();

    $eventos = $reservas->map(function ($reserva) {
        return [
            'title' => 'Reserva de ' . optional($reserva->usuario)->name,
            'start' => $reserva->check_in,
            'end' => \Carbon\Carbon::parse($reserva->check_out)->addDay()->format('Y-m-d'),
            'color' => '#38b2ac',
            'id' => $reserva->id,
            'email' => optional($reserva->usuario)->email,
            'telefono' => optional($reserva->usuario)->telefono ?? '',
            'checkIn' => $reserva->check_in,
            'checkOut' => $reserva->check_out,
        ];
    });

    return view('admin.reservas.calendario', compact('eventos'));
}


public function destroy($id)
{
    $reserva = Reserva::findOrFail($id);
    $reserva->delete();

    return redirect()->route('reservas.admin')->with('success', 'Reserva eliminada correctamente');
}


public function edit($id)
{
    $reserva = Reserva::with('usuario')->findOrFail($id);
    return view('admin.reservas.edit', compact('reserva'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
    ]);

    $reserva = Reserva::findOrFail($id);

    $reserva->update([
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
    ]);

    return redirect()->route('reservas.admin')->with('success', 'Reserva actualizada correctamente.');

}


public function crear()
{
   $habitaciones = Habitacion::where('estado', 1)->get();
    return view('reservas.create', compact('habitaciones'));
}

 public function fechasPorHabitacion($habitacion_id)
    {
        $fechas = [];

        $reservas = Reserva::where('habitacion_id', $habitacion_id)->get();

        foreach ($reservas as $reserva) {
            $checkIn = Carbon::parse($reserva->check_in);
            $checkOut = Carbon::parse($reserva->check_out)->subDay();

            $periodo = CarbonPeriod::create($checkIn, $checkOut);
            foreach ($periodo as $fecha) {
                $fechas[] = $fecha->toDateString();
            }
        }

        return response()->json(['fechas' => $fechas]);
    }

public function disponibilidadGlobal($fecha)
{
    $totalHabitaciones = Habitacion::count();
    $ocupadas = Reserva::where('check_in', '<=', $fecha)
                       ->where('check_out', '>', $fecha)
                       ->distinct('habitacion_id')
                       ->count('habitacion_id');

    return response()->json([
        'fecha' => $fecha,
        'ocupadas' => $ocupadas,
        'total' => $totalHabitaciones,
        'disponibles' => $totalHabitaciones - $ocupadas,
        'completo' => $ocupadas >= $totalHabitaciones
    ]);


}

public function fragmento()
{
    $tusReservas = Reserva::where('user_id', Auth::id())
                          ->orderByDesc('created_at')
                          ->take(10)
                          ->get();

    return view('reservas._tus_reservas', compact('tusReservas'));
}



}
