@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 mt-10 rounded shadow">
    <h1 class="text-xl font-bold text-coopgreen mb-4">Reposición de Carnet</h1>

    <p class="mb-4 text-gray-700">Cliente: <strong>{{ $member->name }}</strong></p>
    <p class="mb-4 text-gray-700">Monto a pagar: <strong>RD$ {{ number_format($costo, 2) }}</strong></p>

    <form method="POST" action="{{ route('reposicion-carnet.store', $member->id) }}">
        @csrf

        {{-- Campo oculto para el monto --}}
        <input type="hidden" name="monto" value="{{ $costo }}">

        {{-- Forma de pago --}}
        <div class="mb-4">
            <label for="forma_pago" class="block text-sm font-medium text-gray-700">Forma de Pago</label>
            <select name="forma_pago" id="forma_pago" class="w-full border-gray-300 rounded mt-1 text-black" required>
                <option value="">Seleccione una forma</option>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="online">Online</option>
            </select>
        </div>

        {{-- Referencia (solo si no es efectivo) --}}
        <div class="mb-4" id="referencia_div" style="display: none;">
            <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia</label>
            <input type="text" name="referencia" id="referencia" class="w-full border-gray-300 rounded mt-1 text-black">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('members.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancelar</a>
            <button type="submit" class="bg-coopgreen text-white px-6 py-2 rounded hover:bg-green-600">Registrar Pago</button>
        </div>
    </form>
</div>

{{-- Script para mostrar/ocultar referencia --}}
<script>
    document.getElementById('forma_pago').addEventListener('change', function () {
        const refDiv = document.getElementById('referencia_div');
        if (this.value === 'efectivo') {
            refDiv.style.display = 'none';
            document.getElementById('referencia').value = '';
        } else {
            refDiv.style.display = 'block';
        }
    });
</script>
@endsection
