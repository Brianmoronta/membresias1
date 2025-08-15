@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 mt-10 rounded shadow">
    <h1 class="text-xl font-bold mb-4 text-coopgreen">Registrar Tipo de Membresía</h1>

    <form action="{{ route('membership-types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Plan</label>
            <input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-300 mt-1 text-black" required>
        </div>

        <div class="mb-4">
            <label for="costo" class="block text-sm font-medium text-gray-700">Costo</label>
            <input type="number" step="0.01" name="costo" id="costo" class="w-full rounded border-gray-300 mt-1 text-black" required>
        </div>

        <div class="mb-4">
            <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento (%)</label>
            <input type="number" step="0.01" name="descuento" id="descuento" class="w-full rounded border-gray-300 mt-1 text-black">
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción / Beneficios</label>
            <textarea name="descripcion" id="descripcion" class="w-full rounded border-gray-300 mt-1 text-black" rows="4"></textarea>
        </div>

        <div class="mt-4">
            <label for="cantidad_invitados" class="block text-white">Cantidad de Invitados</label>
            <input type="number" name="cantidad_invitados" id="cantidad_invitados"
                value="{{ old('cantidad_invitados', $membershipType->cantidad_invitados ?? 0) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
        </div>

        <div class="mb-4">
            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
            <input type="color" name="color" id="color" value="{{ old('color', $membershipType->color ?? '#000000') }}" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="mb-4">
            <label for="background_image" class="block text-sm font-medium text-gray-700">Fondo del Carnet (opcional)</label>
            <input type="file" name="background_image" id="background_image" accept="image/*"
                class="mt-1 block w-full border border-gray-300 rounded py-2 px-3 shadow-sm focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="costo_perdida" class="block text-sm font-medium text-gray-700">Costo por pérdida del carnet</label>
            <input type="number" step="0.01" name="costo_perdida" id="costo_perdida"
                   value="{{ old('costo_perdida', $membershipType->costo_perdida ?? 0) }}"
                   class="w-full rounded border-gray-300 mt-1 text-black">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('membership-types.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Volver</a>
            <button type="submit" class="bg-coopgreen text-white px-6 py-2 rounded hover:bg-green-600">Guardar</button>
        </div>
    </form>
</div>
@endsection
