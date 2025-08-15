@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-900">Editar Habitación</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.habitaciones.update', $habitacion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-black font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded px-4 py-2 text-black" value="{{ old('nombre', $habitacion->nombre) }}" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-black font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full border border-gray-300 rounded px-4 py-2  text-black"">{{ old('descripcion', $habitacion->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="capacidad" class="block text-black font-semibold mb-1">Capacidad</label>
            <input type="number" name="capacidad" id="capacidad" class="w-full border border-gray-300 rounded px-4 py-2  text-black"" min="1" value="{{ old('capacidad', $habitacion->capacidad) }}" required>
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-black font-semibold mb-1">Precio por Noche (RD$)</label>
            <input type="number" name="precio" id="precio" class="w-full border border-gray-300 rounded px-4 py-2  text-black"" step="0.01" min="0" value="{{ old('precio', $habitacion->precio) }}" required>
        </div>

        <div class="mb-6">
            <label for="imagen" class="block text-black font-semibold mb-1">Imagen Nueva (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="w-full border border-gray-300 rounded px-4 py-2">
            
            @if ($habitacion->imagen)
                <div class="mt-2">
                    <p class="text-black mb-1">Imagen actual:</p>
                    <img src="{{ asset($habitacion->imagen) }}" alt="Imagen actual" class="w-40 rounded shadow">
                </div>
            @endif
        </div>

<div class="mb-4">
    <label for="estado" class="block text-black font-semibold mb-1">Estado</label>
    <select name="estado" id="estado" class="w-full border border-gray-300 rounded px-4 py-2 text-black">
        <option value="1" {{ $habitacion->estado == 1 ? 'selected' : '' }}>Disponible</option>
        <option value="0" {{ $habitacion->estado == 0 ? 'selected' : '' }}>No disponible</option>
        <option value="2" {{ $habitacion->estado == 2 ? 'selected' : '' }}>Mantenimiento</option>
    </select>
</div>

<div class="mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="es_compartida" value="1" class="form-checkbox"
               {{ old('es_compartida', $habitacion->es_compartida ?? false) ? 'checked' : '' }}>
        <span class="ml-2 text-gray-700">¿Es compartida?</span>
    </label>
</div>


        <div class="flex justify-end">
            <a href="{{ route('admin.habitaciones.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded mr-2">Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
                Actualizar Habitación
            </button>
        </div>
    </form>
</div>
@endsection
