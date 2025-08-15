<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\HabitacionImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class HabitacionImagenController extends Controller
{
    // Mostrar formulario para subir imágenes a una habitación
    public function create($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('admin.habitaciones.imagenes.create', compact('habitacion'));
    }

    // Guardar imágenes asociadas a una habitación
    public function store(Request $request, $habitacion_id)
    {
        $request->validate([
            'imagenes.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $habitacion = Habitacion::findOrFail($habitacion_id);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombre = time() . '_' . Str::random(8) . '.' . $imagen->getClientOriginalExtension();
                $ruta = 'imagenes/habitaciones/' . $nombre;

                // Mover imagen al directorio público
                $imagen->move(public_path('imagenes/habitaciones'), $nombre);

                // Guardar ruta en la base de datos
                HabitacionImagen::create([
                    'habitacion_id' => $habitacion->id,
                    'ruta' => $ruta,
                ]);
            }
        }

        return redirect()->route('admin.habitaciones.imagenes.create', $habitacion_id)
                         ->with('success', 'Imágenes subidas correctamente.');
    }

    // Redirecciona al formulario (opcional, puedes eliminar si no usas show)
    public function show($id)
    {
        return redirect()->route('admin.habitaciones.imagenes.create', $id);
    }

    // Vista para ver todas las imágenes cargadas de una habitación
    public function verImagenes($id)
    {
        $habitacion = Habitacion::with('imagenes')->findOrFail($id);
        return view('admin.habitaciones.ver-imagenes', compact('habitacion'));
    }

public function destroy($id)
{
    $imagen = HabitacionImagen::findOrFail($id);

    // Eliminar el archivo del sistema si existe
    if (File::exists(public_path($imagen->ruta))) {
        File::delete(public_path($imagen->ruta));
    }

    $imagen->delete();

    return back()->with('success', 'Imagen eliminada correctamente.');
}


}
