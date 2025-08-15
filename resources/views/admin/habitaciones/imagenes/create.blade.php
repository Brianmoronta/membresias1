@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-black">🖼️ Subir imágenes para la habitación: {{ $habitacion->nombre }}</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="uploadForm" action="{{ route('admin.habitaciones.imagenes.store', $habitacion->id) }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded">
        @csrf
        <label class="block mb-2 font-semibold">Selecciona las imágenes:</label>
        <input type="file" name="imagenes[]" id="imagenes" multiple accept="image/*" class="mb-4 border p-2 rounded w-full">

        <!-- Previsualización -->
        <div id="preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4"></div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Subir imágenes</button>
    </form>

    <hr class="my-6">

    <h3 class="text-lg font-semibold mb-2">Imágenes existentes:</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($habitacion->imagenes as $imagen)
            <div class="relative group border rounded overflow-hidden shadow">
                <img src="{{ asset($imagen->ruta) }}" alt="Imagen" class="w-full h-40 object-cover">
                <form action="{{ route('admin.habitaciones.imagenes.delete', $imagen->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 hover:text-red-700">🗑 Eliminar</button>
</form>
            </div>
        @empty
            <p class="text-gray-600 col-span-full">No hay imágenes disponibles.</p>
        @endforelse
    </div>
</div>

<!-- JS para previsualización -->
<script>
    document.getElementById('imagenes').addEventListener('change', function (event) {
        let preview = document.getElementById('preview');
        preview.innerHTML = '';

        Array.from(event.target.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('h-40', 'object-cover', 'rounded', 'shadow');
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
