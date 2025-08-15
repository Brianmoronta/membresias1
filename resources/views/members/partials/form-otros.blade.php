<div class="mt-4">
    <label for="imagen_cedula" class="block text-sm font-medium text-gray-700 mb-1">
        Imagen de la Cédula <span class="text-red-500 font-bold">*</span>
    </label>
    <input type="file" name="imagen_cedula" id="imagen_cedula" accept="image/*" required
           onchange="previewCedula(event)"
           class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm">

    <div id="cedulaPreviewContainer" class="mt-3 hidden">
        <img id="cedulaPreview"
             src=""
             alt="Vista previa de cédula"
             class="h-32 rounded shadow-lg transition-transform duration-300 hover:scale-150 cursor-zoom-in">
    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('photo');
        const preview = document.getElementById('preview-photo');

        photoInput?.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                preview.src = '#';
            }
        });
    });


    function previewCedula(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('cedulaPreview');
            preview.src = e.target.result;
            document.getElementById('cedulaPreviewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

</script>

@endpush
