@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md dark:bg-gray-900">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">🔒 Cambiar Contraseña</h2>

    @if (session('status'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 text-red-500 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cambiar-clave.actualizar') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nueva Contraseña</label>
            <input id="password" name="password" type="password" required class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirmar Contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="text-center">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                Actualizar Contraseña
            </button>
        </div>
    </form>
</div>
@endsection
