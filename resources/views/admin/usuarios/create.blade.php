@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6 text-black">
    <h1 class="text-2xl font-bold mb-4 text-coopgreen">Crear Nuevo Usuario</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Ups!</strong> Revisa los siguientes errores:
            <ul class="mt-2 ml-4 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" id="password"
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium text-gray-700">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="role" class="block font-medium text-gray-700">Rol</label>
            <select name="role" id="role" class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Selecciona un rol --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Socio</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="idsucursal" class="block font-medium text-gray-700">Sucursal (opcional)</label>
            <select name="idsucursal" id="idsucursal" class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Sin sucursal (superadmin) --</option>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}" {{ old('idsucursal') == $sucursal->id ? 'selected' : '' }}>
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
                       {{ old('es_usuario_club') ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">¿Es usuario del club?</span>
            </label>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.usuarios.index') }}" class="text-gray-600 hover:underline">← Volver</a>
            <button type="submit" class="bg-coopgreen text-white px-4 py-2 rounded hover:bg-green-700">
                Crear Usuario
            </button>
        </div>
    </form>
</div>
@endsection
