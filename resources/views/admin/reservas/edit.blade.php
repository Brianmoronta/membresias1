@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-black">
    <h2 class="text-2xl font-bold mb-4">✏️ Editar Reserva</h2>

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nombre:</label>
            <input type="text" value="{{ $reserva->usuario->name ?? 'N/A' }}" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Correo:</label>
            <input type="email" value="{{ $reserva->usuario->email ?? 'N/A' }}" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Teléfono:</label>
            <input type="text" value="{{ $reserva->usuario->telefono ?? 'N/A' }}" class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Check-In:</label>
            <input type="date" name="check_in" value="{{ $reserva->check_in }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Check-Out:</label>
            <input type="date" name="check_out" value="{{ $reserva->check_out }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">💾 Guardar Cambios</button>
    </form>
</div>
@endsection
