@extends('layouts.app')

@section('content')
<div class="container mt-6">

    <h2 class="text-2xl font-bold mb-4">👤 Detalles del Socio</h2>

    <div class="bg-white rounded-lg shadow-md p-6 text-black">
    <p><strong>Nombre:</strong> {{ $member->name }}</p>
    <p><strong>Número de membresía:</strong> {{ $member->membership_number }}</p>
    <p><strong>Código del Sistema:</strong> {{ $member->codigo_sistema }}</p> {{-- NUEVA LÍNEA --}}
    <p><strong>Correo:</strong> {{ $member->email ?? 'N/A' }}</p>
    <p><strong>Teléfono:</strong> {{ $member->phone ?? 'N/A' }}</p>
    <p><strong>Cédula:</strong> {{ $member->cedula ?? 'N/A' }}</p>
    <p><strong>Preferencia alimenticia:</strong> {{ $member->preferencia_alimenticia ?? 'N/A' }}</p>
    <p><strong>Costo membresía:</strong> RD${{ number_format($member->costo_membresia, 2) }}</p>
    <p><strong>Descuento:</strong> RD${{ number_format($member->descuento_membresia ?? 0, 2) }}</p>
    <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($member->fecha_nacimiento)->format('d/m/Y') }}</p>
    <p><strong>Fecha vencimiento:</strong> {{ \Carbon\Carbon::parse($member->fecha_vencimiento_membresia)->format('d/m/Y') }}</p>
</div>

    <h4 class="text-lg font-semibold mb-3 mt-6">📊 Últimos movimientos registrados</h4>

    
    <form method="GET" class="mb-4 flex gap-4 items-end">
        <div>
            <label for="fecha_inicio" class="text-white">Desde:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio"
                   value="{{ request('fecha_inicio') }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-black">
        </div>
        <div>
            <label for="fecha_fin" class="text-white">Hasta:</label>
            <input type="date" name="fecha_fin" id="fecha_fin"
                   value="{{ request('fecha_fin') }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-black">
        </div>
        <div>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Filtrar
            </button>
        </div>
    </form>

    @php
        $fecha_inicio = request('fecha_inicio');
        $fecha_fin = request('fecha_fin');
    @endphp

<a href="{{ route('members.movimientos.pdf', $member->membership_number) }}?fecha_inicio={{ $fecha_inicio }}&fecha_fin={{ $fecha_fin }}"
   class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm inline-block mb-3">
   📄 Descargar PDF
</a>

<table class="w-full text-sm border-collapse border border-gray-300 shadow-sm">
    <thead class="bg-gray-100 text-black">
        <tr>
            <th class="px-4 py-2 text-left">Fecha</th>
            <th class="px-4 py-2 text-left">Concepto</th>
            <th class="px-4 py-2" style="text-align: right;">Monto (RD$)</th>
        </tr>
    </thead>
    
    <tbody class="bg-blue-900 text-white">
        @forelse($movimientos as $mov)
            <tr class="border-t border-gray-300">
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($mov->fecha)->format('d/m/Y') }}</td>
                <td class="px-4 py-2">{{ $mov->concepto ?? '-' }}</td>
                <td class="px-4 py-2 font-semibold" style="text-align: right;">
                    RD${{ number_format($mov->monto, 2) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-4 py-2 text-center text-gray-300">No hay movimientos registrados.</td>
            </tr>
        @endforelse
    </tbody>
    
</table>

    @if(auth()->user()->role === 'admin')
    <a href="{{ route('members.index') }}" class="mt-4 inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        ← Volver al listado
    </a>
@else
    <a href="{{ route('member.dashboard') }}" class="mt-4 inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        ← Volver al inicio
    </a>
@endif

</div>
@endsection
