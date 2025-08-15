@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-coopblue py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-coopgreen mb-6">Renovación de membresía</h1>

        <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nombre<span class="text-red-500 font-bold">*</span></label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">No. Socio<span class="text-red-500 font-bold">*</span></label>
                <input type="text" name="membership_number" value="{{ old('membership_number', $member->membership_number) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Correo<span class="text-red-500 font-bold">*</span></label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Teléfono<span class="text-red-500 font-bold">*</span></label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Teléfono secundario<span class="text-red-500 font-bold">*</span></label>
                <input type="text" name="telefono_secundario" id="telefono_secundario" value="{{ old('telefono_secundario', $member->telefono_secundario) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Cédula<span class="text-red-500 font-bold">*</label>
                <input type="text" name="cedula" value="{{ old('cedula', $member->cedula) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
            </div>
            
            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de nacimiento<span class="text-red-500 font-bold">*</span></label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                       value="{{ old('fecha_nacimiento', $member->fecha_nacimiento ? date('Y-m-d', strtotime($member->fecha_nacimiento)) : '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black" required>
            </div>
            

            <div class="mb-4">
                <label for="fecha_vencimiento_membresia" class="block text-sm font-medium text-gray-700">Fecha de vencimiento de membresía</label>
                <input type="date" name="fecha_vencimiento_membresia" id="fecha_vencimiento_membresia"
                    value="{{ old('fecha_vencimiento_membresia', $member->fecha_vencimiento_membresia ? \Carbon\Carbon::parse($member->fecha_vencimiento_membresia)->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
            </div>

            
            <div class="mb-4">
    <label for="imagen_cedula" class="block text-sm font-medium text-gray-700">
        Imagen escaneada de la Cédula <span class="text-red-500 font-bold">*</span>
    </label>
    <input type="file" name="imagen_cedula" id="imagen_cedula" accept="image/*"
           class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md"
           {{ isset($member) ? '' : 'required' }}>
    
    @if ($member->imagen_cedula)
    <div class="mb-2">
        <img src="{{ asset('storage/' . $member->imagen_cedula) }}" alt="Imagen escaneada de cédula" class="w-40 border rounded">
        <p class="text-xs text-gray-500 mt-1">Imagen actual de la cédula</p>
    </div>
@endif

    @error('imagen_cedula')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
    
<div class="mb-3">
    <label for="membership_type_id" class="block text-sm font-medium text-gray-700">Tipo de Membresía<span class="text-red-500 font-bold">*</span></label>
    <select name="membership_type_id" id="membership_type_id" class="form-select text-black" required>
        <option value="">Seleccione una opción</option>
        @foreach ($membershipTypes as $type)
            <option 
                value="{{ $type->id }}"
                data-costo="{{ $type->costo }}"
                data-porcentaje="{{ $type->descuento }}"
                {{ old('membership_type_id', $member->membership_type_id) == $type->id ? 'selected' : '' }}>
                {{ $type->nombre }} - RD${{ number_format($type->costo, 2) }}
            </option>
        @endforeach
    </select>
</div>



<div class="mb-3">
    <label for="discount_id" class="block text-sm font-medium text-gray-700">Tipo de Socio (Descuento)<span class="text-red-500 font-bold">*</span></label>
    <select name="discount_id" id="discount_id" class="form-select text-black" required>
        <option value="">-- Selecciona un tipo de socio --</option>
        @foreach($discounts as $discount)
            <option 
                value="{{ $discount->id }}" 
                data-porcentaje="{{ $discount->porcentaje }}"
                {{ old('discount_id', $member->discount_id) == $discount->id ? 'selected' : '' }}>
                {{ $discount->nombre }} ({{ $discount->porcentaje }}%)
            </option>
        @endforeach
    </select>
</div>


<div class="mb-4">
    <label for="forma_pago" class="block text-sm font-medium text-gray-700">
        Forma de Pago <span class="text-red-500 font-bold">*</span>
    </label>
    <select name="forma_pago" id="forma_pago" class="form-select w-full mt-1 border border-gray-300 rounded-md text-black" required>
        <option value="">-- Selecciona una forma de pago --</option>
        <option value="efectivo" {{ (old('forma_pago') ?? $member->forma_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
        <option value="online" {{ (old('forma_pago') ?? $member->forma_pago) == 'online' ? 'selected' : '' }}>Pago en línea</option>
    </select>
    @error('forma_pago')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


    
            
            <div class="mb-4">
                <label for="costo_membresia" class="block text-sm font-medium text-gray-700">Costo de Membresía</label>
                <input type="text" name="costo_membresia" id="costo_membresia"
                    value="{{ old('costo_membresia', $member->costo_membresia) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" readonly>
            </div>
            
            <div class="mb-4">
                <label for="descuento_membresia" class="block text-sm font-medium text-gray-700">Descuento por Membresía (RD$)</label>
                <input type="number" name="descuento_membresia" id="descuento_membresia"
                    value="{{ old('descuento_membresia', $member->descuento_membresia) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" readonly>
            </div>
            
            <div class="mb-4">
                <label for="total_membresia" class="block text-sm font-medium text-gray-700">Total a Pagar (RD$)</label>
                <input type="text" name="total_membresia" id="total_membresia"
                    value="{{ number_format($member->costo_membresia - $member->descuento_membresia, 2) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" readonly>
            </div>
            
            <div class="mb-4">
                <label for="preferencia_alimenticia" class="block text-sm font-medium text-gray-700">Preferencia Alimenticia</label>
                <input type="text" name="preferencia_alimenticia" value="{{ old('preferencia_alimenticia', $member->preferencia_alimenticia) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
            </div>
                
            <div class="flex justify-between items-center">
                <a href="{{ route('members.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded shadow hover:bg-gray-700">Volver al Dashboard</a>
                <button type="submit" class="bg-coopgreen text-white px-6 py-2 rounded shadow hover:bg-green-600">Actualizar</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const membershipTypes = @json($membershipTypes);
    const discounts = @json($discounts);

    document.addEventListener('DOMContentLoaded', function () {
        const selectMembresia = document.getElementById('membership_type_id');
        const selectDescuento = document.getElementById('discount_id');
        const costoInput = document.getElementById('costo_membresia');
        const descuentoInput = document.getElementById('descuento_membresia');
        const totalInput = document.getElementById('total_membresia');

        function calcularTotal() {
            const selectedTipo = selectMembresia.selectedOptions[0];
            const selectedDescuento = selectDescuento.selectedOptions[0];

            if (!selectedTipo || !selectedTipo.dataset.costo) {
                costoInput.value = '';
                descuentoInput.value = '';
                totalInput.value = '';
                return;
            }

            const costo = parseFloat(selectedTipo.dataset.costo);
            const porcentajeSocio = parseFloat(selectedDescuento?.dataset.porcentaje || 0);

            let descuentoTotal = 0;

            if (selectedDescuento && selectedDescuento.text.includes('NINGUNO')) {
                // No aplica descuento
                descuentoTotal = 0;
            } else {
                // Aplica solo 20% global
                descuentoTotal = parseFloat((costo * 0.20).toFixed(2));
            }

            const totalFinal = parseFloat((costo - descuentoTotal).toFixed(2));

            costoInput.value = costo.toFixed(2);
            descuentoInput.value = descuentoTotal.toFixed(2);
            totalInput.value = totalFinal.toFixed(2);
        }

        selectMembresia.addEventListener('change', calcularTotal);
        selectDescuento.addEventListener('change', calcularTotal);

        // Por si ya vienen seleccionados al cargar
        calcularTotal();
    });
</script>
@endpush






@endsection