<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- TÍTULO --}}
    <div>
        <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="titulo" id="titulo"
            value="{{ old('titulo', $pagina->titulo ?? '') }}"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">
    </div>

    {{-- TIPO --}}
    <div>
        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Página</label>
        <input type="text" name="tipo" id="tipo"
            value="{{ old('tipo', $pagina->tipo ?? '') }}"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900"
            placeholder="inicio, nosotros, contacto...">
    </div>
</div>

{{-- IMAGEN DESTACADA --}}
<div class="mt-4">
    <label class="block text-sm font-medium text-gray-700">Imagen destacada</label>
    <input type="file" name="imagen_destacada" class="mt-1 text-gray-900">

    @if(!empty($pagina->imagen_destacada))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $pagina->imagen_destacada) }}" alt="Imagen actual" class="w-40 border rounded">
        </div>
    @endif
</div>

{{-- CONTENIDO --}}
<div class="mt-4">
    <label for="contenido" class="block text-sm font-medium text-gray-700">Contenido</label>
    <textarea name="contenido" id="editorContenido" rows="10"
        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">{{ old('contenido', $pagina->contenido ?? '') }}</textarea>
</div>

{{-- CKEditor --}}
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editorContenido', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
