@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow text-black">
    <h2 class="text-2xl font-bold mb-4 text-coopgreen">Editar Rol de Usuario</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 mb-4 rounded shadow">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-bold mb-2">Rol:</label>
            <select name="role" id="role" class="w-full border rounded p-2">
                @foreach($roles as $rol)
                    <option value="{{ $rol }}" {{ $user->hasRole($rol) ? 'selected' : '' }}>
                        {{ ucfirst($rol) }}
                    </option>
                @endforeach
            </select>
        </div>

        

        <div class="flex justify-between">
            <a href="{{ route('admin.usuarios.index') }}" class="text-gray-600 hover:underline">← Volver</a>
            <button type="submit" class="bg-coopgreen text-white px-4 py-2 rounded hover:bg-green-700">
                Actualizar Rol
            </button>
        </div>
    </form>
</div>
@endsection