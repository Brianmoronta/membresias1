@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-xl font-bold mb-4">📒 Registrar Movimiento de Gasto</h3>
    
    @if(session('success'))
    <div class="flex items-center bg-green-100 border border-green-600 text-black text-sm rounded-md px-4 py-3 mb-4 shadow" role="alert">
        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="flex items-center bg-red-100 border border-red-600 text-red-900 text-sm rounded-md px-4 py-3 mb-4 shadow" role="alert">
        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-red-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
@endif




    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf

        <div class="mb-4">
            <label for="membership_number" class="block text-sm font-medium text-white">Socio</label>
            <select name="membership_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
                <option value="">-- Seleccionar --</option>
                @foreach($socios as $socio)
                    <option value="{{ $socio->membership_number }}">
                        {{ $socio->name }} ({{ $socio->membership_number }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="monto" class="block text-sm font-medium text-white">Monto</label>
            <input type="number" step="0.01" name="monto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
        </div>

        <div class="mb-4">
            <label for="concepto" class="block text-sm font-medium text-white">Concepto (opcional)</label>
            <input type="text" name="concepto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
        </div>

        <div class="mb-4">
            <label for="fecha" class="block text-sm font-medium text-white">Fecha</label>
            <input type="date" name="fecha" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            Registrar Gasto
        </button>
    </form>
</div>
@endsection
