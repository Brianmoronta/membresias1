@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6 text-black">
    <h1 class="text-2xl font-bold mb-4">Listado de Usuarios</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-coopblue text-white">
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Correo</th>
                <th class="border px-4 py-2">Rol</th>
                <th class="border px-4 py-2">Sucursal</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td class="border px-4 py-2">{{ $usuario->name }}</td>
                <td class="border px-4 py-2">{{ $usuario->email }}</td>
                <td class="border px-4 py-2">
                    {{ $usuario->getRoleNames()->first() ?? 'Sin rol' }}
                </td>
                <td class="border px-4 py-2">
                    {{ $usuario->sucursal->nombre ?? 'Sin sucursal' }}
                </td>
                <td class="border px-4 py-2 text-center">
                    <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                       class="bg-coopgreen text-white px-3 py-1 rounded hover:bg-green-600">
                       Editar Rol
                    </a>

                    <a href="{{ route('admin.usuarios.edit-user', $usuario->id) }}"
                       class="bg-blue-500 text-white px-1 py-1 rounded hover:bg-blue-700 mr-2">
                       Editar Usuario
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
