<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded shadow text-black">
        <h2 class="text-2xl font-bold mb-4">🖼 Imágenes de la habitación: <span class="text-coopblue">{{ $habitacion->nombre }}</span></h2>

        {{-- Formulario de subida --}}
        <div class="bg-gray-100 p-4 rounded-md mb-6 border border-gray-300">
            <form action="{{ route('admin.habitaciones.imagenes.store', $habitacion->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block mb-2 font-semibold text-sm">Subir nuevas imágenes:</label>
                <input type="file" name="imagenes[]" multiple accept="image/*" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-2 mb-4">
                <button type="submit" class="bg-coopblue hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Subir imágenes
                </button>
            </form>
        </div>

        {{-- Galería de imágenes --}}
        <h3 class="text-lg font-semibold mb-2">Imágenes existentes:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($habitacion->imagenes as $imagen)
                <div class="border rounded-lg overflow-hidden shadow hover:scale-105 transition-transform duration-200">
                    <img src="{{ asset($imagen->ruta) }}" alt="Imagen habitación" class="w-full h-40 object-cover">
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">No hay imágenes disponibles para esta habitación.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
