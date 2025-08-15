@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold mb-4 text-gray-900">Editar Ítem de Menú</h1>

    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-gray-800 font-semibold mb-1">Nombre</label>
            <input type="text" id="nombre" name="nombre"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900"
                   value="{{ $menu->nombre }}" required>
        </div>

        <div class="mb-4">
            <label for="url" class="block text-gray-800 font-semibold mb-1">URL</label>
            <input type="text" id="url" name="url"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900"
                   value="{{ $menu->url }}" required>
        </div>

        <div class="mb-4">
            <label for="orden" class="block text-gray-800 font-semibold mb-1">Orden</label>
            <input type="number" id="orden" name="orden"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900"
                   value="{{ $menu->orden }}" required>
        </div>

        <div class="mb-6">
            <label class="inline-flex items-center text-gray-800 font-medium">
                <input type="checkbox" name="visible" value="1" class="mr-2"
                       {{ $menu->visible ? 'checked' : '' }}>
                Mostrar en el menú
            </label>
        </div>

        <div class="flex items-center">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Actualizar
            </button>

            <a href="{{ route('admin.menus.index') }}"
               class="ml-4 text-gray-600 hover:underline font-medium">
               Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
