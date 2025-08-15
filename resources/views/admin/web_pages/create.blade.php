@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Crear nueva página</h1>

    <form action="{{ route('admin.web-pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.web_pages._form', ['pagina' => null])
        
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Guardar Página
            </button>
            <a href="{{ route('admin.web-pages.index') }}" class="ml-4 text-gray-600 hover:text-black">Cancelar</a>
        </div>
    </form>
</div>
@endsection
