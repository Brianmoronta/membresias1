@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow text-black">
    <h2 class="text-2xl font-bold mb-4 text-coopgreen">Editar Usuario</h2>

    <form method="POST" action="{{ route('admin.usuarios.update-user', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Nueva Contraseña <span class="text-sm text-gray-500">(Opcional)</span></label>
            <input type="password" name="password" id="password"
                   class="w-full border border-gray-300 rounded p-2"
                   placeholder="Déjalo en blanco si no deseas cambiarla">
        </div>

        <div class="mb-4">
            <label for="idsucursal" class="block text-gray-700">Sucursal</label>
            <select name="idsucursal" id="idsucursal" class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Selecciona una sucursal --</option>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}" {{ old('idsucursal', $user->idsucursal) == $sucursal->id ? 'selected' : '' }}>
                        {{ $sucursal->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Checkbox: ¿Es usuario del club? --}}
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="es_usuario_club" value="1"
                       class="form-checkbox text-coopgreen"
                       {{ old('es_usuario_club', $user->es_usuario_club) ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">¿Es usuario del club?</span>
            </label>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.usuarios.index') }}" class="text-gray-600 hover:underline">← Volver</a>
            <button type="submit" class="bg-coopgreen text-white px-4 py-2 rounded hover:bg-green-700">
                Actualizar Usuario
            </button>
        </div>
    </form>
</div>
@endsection
