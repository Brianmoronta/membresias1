@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4 text-gray-900">Gestión de Menú</h1>

    <a href="{{ route('admin.menus.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block font-semibold">
       + Nuevo Ítem
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-left table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-900">
                <th class="p-2">Nombre</th>
                <th class="p-2">URL</th>
                <th class="p-2">Orden</th>
                <th class="p-2">Visible</th>
                <th class="p-2 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-2 text-gray-900">{{ $menu->nombre }}</td>
                    <td class="p-2 text-gray-900">{{ $menu->url }}</td>
                    <td class="p-2 text-gray-900">{{ $menu->orden }}</td>
                    <td class="p-2 text-gray-900">{{ $menu->visible ? 'Sí' : 'No' }}</td>
                    <td class="p-2 text-right">
                        <a href="{{ route('admin.menus.edit', $menu) }}"
                           class="text-blue-600 hover:text-blue-800 font-semibold underline mr-2">
                           Editar
                        </a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('¿Eliminar este ítem?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 font-semibold underline">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
