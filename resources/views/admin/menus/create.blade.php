@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold mb-4">Crear nuevo ítem de menú</h1>

    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">URL</label>
            <input type="text" name="url" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="/#seccion" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Orden</label>
            <input type="number" name="orden" class="w-full border border-gray-300 rounded px-3 py-2" value="0" required>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="visible" value="1" class="mr-2" checked>
                Visible en el menú
            </label>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
        <a href="{{ route('admin.menus.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection
