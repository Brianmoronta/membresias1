@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Detalle de la Habitación</h2>

    <div class="mb-4">
        <label class="block font-semibold text-black">Nombre:</label>
        <p class="text-black">{{ $habitacion->nombre }}</p>
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-black">Descripción:</label>
        <p class="text-black">{{ $habitacion->descripcion }}</p>
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-black">Capacidad:</label>
        <p class="text-black">{{ $habitacion->capacidad }} personas</p>
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-black">Precio:</label>
        <p class="text-black">RD$ {{ number_format($habitacion->precio, 2) }}</p>
    </div>

    <div class="mb-6">
        <label class="block font-semibold text-black">Imagen:</label>
        @if ($habitacion->imagen)
            <img src="{{ asset($habitacion->imagen) }}" alt="Imagen de la habitación" class="w-full max-w-md rounded shadow mt-2">
        @else
            <p class="text-gray-500">No hay imagen disponible</p>
        @endif
    </div>

    <a href="{{ route('admin.habitaciones.index') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded">
        ← Volver al listado
    </a>
</div>
@endsection
