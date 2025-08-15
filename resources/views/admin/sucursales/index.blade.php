@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow text-black">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-coopgreen">Sucursales</h1>
        <a href="{{ route('admin.sucursales.create') }}" class="bg-coopgreen text-white px-4 py-2 rounded hover:bg-green-700">
            + Nueva Sucursal
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-coopblue text-white">
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Dirección</th>
                <th class="border px-4 py-2">Teléfono</th>
                <th class="border px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sucursales as $sucursal)
                <tr>
                    <td class="border px-4 py-2">{{ $sucursal->nombre }}</td>
                    <td class="border px-4 py-2">{{ $sucursal->direccion }}</td>
                    <td class="border px-4 py-2">{{ $sucursal->telefono }}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('admin.sucursales.edit', $sucursal->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Editar
                        </a>
                        <form action="{{ route('admin.sucursales.destroy', $sucursal->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta sucursal?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
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
