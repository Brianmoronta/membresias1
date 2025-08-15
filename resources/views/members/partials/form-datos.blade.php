<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    {{-- Nombre --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nombre<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name', $member->name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- No. Socio --}}
    <div>
        <label for="membership_number" class="block text-sm font-medium text-gray-700">No. Socio<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="membership_number" id="membership_number" value="{{ old('membership_number', $member->membership_number ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- Cédula --}}
    <div>
        <label for="cedula" class="block text-sm font-medium text-gray-700">Cédula<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="cedula" id="cedula" value="{{ old('cedula', $member->cedula ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- Fecha de Nacimiento --}}
    <div>
        <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento<span class="text-red-500 font-bold">*</span></label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $member->fecha_nacimiento ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- Fecha de Vencimiento de Membresía --}}
    <div>
        <label for="fecha_vencimiento_membresia" class="block text-sm font-medium text-gray-700">Fecha de Vencimiento de Membresía<span class="text-red-500 font-bold">*</span></label>
        <input type="date" name="fecha_vencimiento_membresia" id="fecha_vencimiento_membresia"
               value="{{ old('fecha_vencimiento_membresia', isset($member->fecha_vencimiento_membresia) ? $member->fecha_vencimiento_membresia->format('Y-m-d') : now()->addYear()->format('Y-m-d')) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    {{-- Preferencia Alimenticia --}}
    <div>
        <label for="preferencia_alimenticia" class="block text-sm font-medium text-gray-700">Preferencia Alimenticia<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="preferencia_alimenticia" id="preferencia_alimenticia"
               value="{{ old('preferencia_alimenticia', $member->preferencia_alimenticia ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
</div>
