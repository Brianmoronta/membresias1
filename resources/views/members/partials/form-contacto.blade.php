<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    {{-- Correo --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico<span class="text-red-500 font-bold">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email', $member->email ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- Teléfono Principal --}}
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono Principal<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $member->phone ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- Teléfono Secundario --}}
    <div>
        <label for="telefono_secundario" class="block text-sm font-medium text-gray-700">Teléfono Secundario<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="telefono_secundario" id="telefono_secundario" value="{{ old('telefono_secundario', $member->telefono_secundario ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Máscara CÉDULA: 000-0000000-0
    const cedulaInput = document.getElementById('cedula');
    cedulaInput?.addEventListener('input', function () {
        this.value = this.value
            .replace(/\D/g, '')
            .replace(/^(\d{3})(\d)/, '$1-$2')
            .replace(/-(\d{7})(\d)/, '-$1-$2')
            .slice(0, 13);
    });

    // Máscara TELÉFONO: 000-000-0000
    function formatPhone(input) {
        input?.addEventListener('input', function () {
            let val = this.value.replace(/\D/g, '');
            if (val.length > 10) val = val.slice(0, 10);
            if (val.length >= 7) {
                this.value = val.replace(/(\d{3})(\d{3})(\d{1,4})/, '$1-$2-$3');
            } else if (val.length >= 4) {
                this.value = val.replace(/(\d{3})(\d{1,3})/, '$1-$2');
            } else {
                this.value = val;
            }
        });
    }

    formatPhone(document.getElementById('phone'));
    formatPhone(document.getElementById('telefono_secundario'));
});
</script>
@endpush
