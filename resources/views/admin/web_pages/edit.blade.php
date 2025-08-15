@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Editar página</h1>

    <form action="{{ route('admin.web-pages.update', $pagina->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.web_pages._form', ['pagina' => $pagina])

        <div class="mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Actualizar Página
            </button>
            <a href="{{ route('admin.web-pages.index') }}" class="ml-4 text-gray-600 hover:text-black">Cancelar</a>
        </div>
    </form>
</div>
@endsection
