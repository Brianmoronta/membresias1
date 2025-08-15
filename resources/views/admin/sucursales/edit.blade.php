@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow text-black">
    <h2 class="text-2xl font-bold mb-4 text-coopgreen">Editar Sucursal</h2>

    <form action="{{ route('admin.sucursales.update', $sucursal) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $sucursal->nombre }}" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="direccion" class="block text-gray-700">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="{{ $sucursal->direccion }}" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="telefono" class="block text-gray-700">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ $sucursal->telefono }}" class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.sucursales.index') }}" class="text-gray-600 hover:underline">← Volver</a>
            <button type="submit" class="bg-coopgreen text-white px-4 py-2 rounded hover:bg-green-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection
