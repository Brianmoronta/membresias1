@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Listado de Habitaciones</h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 text-right">
        <a href="{{ route('admin.habitaciones.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
            + Nueva Habitación
        </a>
    </div>

    @if($habitaciones->count())
        @php
            $colores = [
                'Disponible' => 'bg-green-100 text-green-700',
                'No disponible' => 'bg-red-100 text-red-700',
                'Mantenimiento' => 'bg-yellow-100 text-yellow-700',
            ];
        @endphp

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden text-sm">
    <thead class="bg-gray-100 text-black">
        <tr>
            
            <th class="px-4 py-3 text-left">Nombre</th>
            <th class="px-4 py-3 text-left">Descripción</th>
            <th class="px-4 py-3 text-left">Capacidad</th>
            <th class="px-4 py-3 text-left">Precio</th>
            <th class="px-4 py-3 text-left">Estado</th>
            <th class="px-4 py-3 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($habitaciones as $habitacion)
            <tr class="border-t hover:bg-gray-50">
                        

                <td class="px-4 py-2 text-black">{{ $habitacion->nombre }}</td>
                <td class="px-4 py-2 text-black">{{ Str::limit($habitacion->descripcion, 40) }}</td>
                <td class="px-4 py-2 text-black">{{ $habitacion->capacidad }}</td>
                <td class="px-4 py-2 text-black">RD$ {{ number_format($habitacion->precio, 2) }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colores[$habitacion->estado_texto] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $habitacion->estado_texto }}
                    </span>
                </td>

                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.habitaciones.edit', $habitacion->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            Editar
                        </a>

                        <a href="{{ route('admin.habitaciones.imagenes.create', $habitacion->id) }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs">
                            Ver Imágenes
                        </a>

                        <form action="{{ route('admin.habitaciones.destroy', $habitacion->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta habitación?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
        </div>
    @else
        <p class="text-black mt-4">No hay habitaciones registradas aún.</p>
    @endif
</div>
@endsection
