{{-- resources/views/admin/habitaciones/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-white text-black p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Crear Habitación</h2>

    <form action="{{ route('admin.habitaciones.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="nombre" class="block font-semibold">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label for="descripcion" class="block font-semibold">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div>
            <label for="capacidad" class="block font-semibold">Capacidad</label>
            <input type="number" name="capacidad" id="capacidad" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label for="precio" class="block font-semibold">Precio</label>
            <input type="number" name="precio" id="precio" step="0.01" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label for="imagen" class="block font-semibold">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="w-full">
        </div>

        
        <div>
    <label for="estado" class="block font-semibold">Estado</label>
    <select name="estado" id="estado" class="w-full border rounded px-3 py-2">
        <option value="1">Disponible</option>
        <option value="0">No disponible</option>
        <option value="2">Mantenimiento</option>
    </select>
</div>


<div class="mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="es_compartida" value="1" class="form-checkbox"
               {{ old('es_compartida', $habitacion->es_compartida ?? false) ? 'checked' : '' }}>
        <span class="ml-2 text-gray-700">¿Es compartida?</span>
    </label>
</div>




        <div>
            <button type="submit" class="bg-coopgreen text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection
