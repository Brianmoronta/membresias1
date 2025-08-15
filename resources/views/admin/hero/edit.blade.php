@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Editar Sección Principal (Hero)</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Título --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Título Principal</label>
            <input type="text" name="titulo" value="{{ old('titulo', $hero->titulo) }}"
                   class="mt-1 block w-full p-2 border border-gray-300 rounded text-gray-900">
        </div>

        {{-- Subtítulo --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Subtítulo</label>
            <input type="text" name="subtitulo" value="{{ old('subtitulo', $hero->subtitulo) }}"
                   class="mt-1 block w-full p-2 border border-gray-300 rounded text-gray-900">
        </div>

        {{-- Imagen --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Imagen de fondo</label>
            <input type="file" name="imagen" class="mt-1 text-gray-900">

            @if ($hero->imagen)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $hero->imagen) }}" class="w-full max-w-md rounded shadow">
                </div>
            @endif
        </div>

        {{-- Botón --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Texto del botón</label>
            <input type="text" name="boton_texto" value="{{ old('boton_texto', $hero->boton_texto) }}"
                   class="mt-1 block w-full p-2 border border-gray-300 rounded text-gray-900">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">URL del botón</label>
            <input type="text" name="boton_url" value="{{ old('boton_url', $hero->boton_url) }}"
                   class="mt-1 block w-full p-2 border border-gray-300 rounded text-gray-900">
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="mostrar_boton" id="mostrar_boton"
                   {{ $hero->mostrar_boton ? 'checked' : '' }}
                   class="mr-2">
            <label for="mostrar_boton" class="text-sm font-medium text-gray-700">Mostrar botón en el hero</label>
        </div>

        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded">
            Guardar Cambios
        </button>
    </form>
</div>
@endsection
