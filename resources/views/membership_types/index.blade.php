@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-coopgreen">Tipos de Membresía</h1>
        <a href="{{ route('membership-types.create') }}" class="bg-coopgreen text-white px-4 py-2 rounded shadow hover:bg-green-700">
            + Nuevo Plan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border bg-black text-white">#</th>
                <th class="px-4 py-2 border bg-black text-white">Nombre</th>
                <th class="px-4 py-2 border bg-black text-white">Costo</th>
                <th class="px-4 py-2 border bg-black text-white">Descuento</th>
                <th class="px-4 py-2 border bg-black text-white">Cantidad de Invitados</th>
                <th class="px-4 py-2 border bg-black text-white">Color</th>
                <th class="px-4 py-2 border bg-black text-white">Fondo</th>
                <th class="px-4 py-2 border bg-black text-white">Pérdida Carnet</th>
                <th class="px-4 py-2 border bg-black text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tipos as $tipo)
                <tr>
                    <td class="border px-4 py-2 text-black">{{ $tipo->id }}</td>
                    <td class="border px-4 py-2 text-black">
                        <span class="inline-block w-3 h-3 rounded-full mr-2 align-middle" style="background-color: {{ $tipo->color ?? '#000' }}"></span>
                        {{ $tipo->nombre }}
                    </td>
                    <td class="border px-4 py-2 text-black">RD$ {{ number_format($tipo->costo, 2) }}</td>
                    <td class="border px-4 py-2 text-black">{{ $tipo->descuento }}%</td>
                    <td class="border px-4 py-2 text-black">{{ $tipo->cantidad_invitados }}</td>
                    <td class="border px-4 py-2">
                        <span class="inline-block w-5 h-5 rounded-full border" style="background-color: {{ $tipo->color ?? '#000' }}"></span>
                    </td>
                    <td class="border px-4 py-2">
                        @if ($tipo->background_image)
                            <img src="{{ asset($tipo->background_image) }}" alt="Fondo" class="w-16 h-10 object-cover rounded border">
                        @else
                            <span class="text-gray-400 italic">Sin fondo</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2 text-black">
                        RD$ {{ number_format($tipo->costo_perdida ?? 0, 2) }}
                    </td>
                    <td class="border px-4 py-2 flex gap-2 text-black">
                        <a href="{{ route('membership-types.edit', $tipo->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</a>
                        <form action="{{ route('membership-types.destroy', $tipo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este plan?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center py-4">No hay tipos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $tipos->links() }}
    </div>
</div>
@endsection
