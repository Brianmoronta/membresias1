<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{
    
    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('admin.habitaciones.index', compact('habitaciones'));
    }

    public function create()
    {
        return view('admin.habitaciones.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'capacidad' => 'required|integer|min:1',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'estado' => 'required|integer|in:0,1,2',
        'es_compartida' => 'nullable|boolean', // ✅ Validación correcta
    ]);

    $datos = $request->only(['nombre', 'descripcion', 'capacidad', 'precio', 'estado']);

    // ✅ Agregar campo es_compartida (true o false)
    $datos['es_compartida'] = $request->has('es_compartida');

    if ($request->hasFile('imagen')) {
        $nombreImagen = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('imagenes/habitaciones'), $nombreImagen);
        $datos['imagen'] = 'imagenes/habitaciones/' . $nombreImagen;
    }

    Habitacion::create($datos);

    return redirect()->route('admin.habitaciones.index')->with('success', 'Habitación creada correctamente.');
}

    public function edit($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('admin.habitaciones.edit', compact('habitacion'));
    }

    public function update(Request $request, $id)
{
    $habitacion = Habitacion::findOrFail($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'capacidad' => 'required|integer|min:1',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'estado' => 'required|integer|in:0,1,2',
        'es_compartida' => 'nullable|boolean', // ✅ Validación añadida
    ]);

    $datos = $request->only(['nombre', 'descripcion', 'capacidad', 'precio', 'estado']);

    // ✅ Incluir el campo es_compartida (true si el checkbox está marcado)
    $datos['es_compartida'] = $request->has('es_compartida');

    if ($request->hasFile('imagen')) {
        $nombreImagen = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('imagenes/habitaciones'), $nombreImagen);
        $datos['imagen'] = 'imagenes/habitaciones/' . $nombreImagen;
    }

    $habitacion->update($datos);

    return redirect()->route('admin.habitaciones.index')->with('success', 'Habitación actualizada correctamente.');
}

    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();

        return redirect()->route('admin.habitaciones.index')->with('success', 'Habitación eliminada correctamente.');
    }

public function info($id)
{
    $habitacion = Habitacion::with('imagenes')->findOrFail($id);

    return response()->json([
        'nombre' => $habitacion->nombre,
        'descripcion' => $habitacion->descripcion,
        'precio' => $habitacion->precio,
        'capacidad' => $habitacion->capacidad,
        'imagenes' => $habitacion->imagenes->pluck('ruta')->map(function ($ruta) {
            return asset($ruta); // Asegura ruta pública completa
        }),
    ]);
}


}
