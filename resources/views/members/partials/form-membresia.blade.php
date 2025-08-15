<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    {{-- Tipo de Membresía --}}
    <div>
        <label for="membership_type_id" class="block text-sm font-medium text-gray-700">Tipo de Membresía<span class="text-red-500 font-bold">*</span></label>
        <select name="membership_type_id" id="membership_type_id" class="form-select w-full mt-1" required>
            <option value="">Seleccione una opción</option>
            @foreach($membershipTypes as $type)
                <option value="{{ $type->id }}"
                        data-costo="{{ $type->costo }}"
                        data-porcentaje="{{ $type->descuento }}"
                        {{ old('membership_type_id', $member->membership_type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->nombre }} - RD${{ number_format($type->costo, 2) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Tipo de Socio --}}
    <div>
        <label for="discount_id" class="block text-sm font-medium text-gray-700">Tipo de Socio (Descuento)<span class="text-red-500 font-bold">*</span></label>
        <select name="discount_id" id="discount_id" class="form-select w-full mt-1" required>
            <option value="">-- Selecciona un tipo de socio --</option>
            @foreach($discounts as $discount)
                <option value="{{ $discount->id }}"
                        data-porcentaje="{{ $discount->porcentaje }}"
                        {{ old('discount_id', $member->discount_id ?? '') == $discount->id ? 'selected' : '' }}>
                    {{ $discount->nombre }} ({{ $discount->porcentaje }}%)
                </option>
            @endforeach
        </select>
    </div>

    {{-- Costo Membresía --}}
    <div>
        <label for="costo_membresia" class="block text-sm font-medium text-gray-700">Costo de Membresía<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="costo_membresia" id="costo_membresia"
               value="{{ old('costo_membresia', $member->costo_membresia ?? '') }}"
               readonly
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
    </div>

    {{-- Descuento RD$ --}}
    <div>
        <label for="descuento_membresia" class="block text-sm font-medium text-gray-700">Descuento por Membresía (RD$)<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="descuento_membresia" id="descuento_membresia"
               value="{{ old('descuento_membresia', $member->descuento_membresia ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" readonly>
    </div>

    {{-- Total a Pagar --}}
    <div>
        <label for="total_membresia" class="block text-sm font-medium text-gray-700">Total a Pagar (RD$)<span class="text-red-500 font-bold">*</span></label>
        <input type="text" name="total_membresia" id="total_membresia"
               value="{{ old('total_membresia', $member->total_membresia ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" readonly>
    </div>

    {{-- Forma de Pago --}}
    <div>
        <label for="forma_pago" class="block text-sm font-medium text-gray-700">Forma de Pago<span class="text-red-500 font-bold">*</span></label>
        <select name="forma_pago" id="forma_pago" class="form-select w-full mt-1" required>
            <option value="">-- Selecciona una forma de pago --</option>
            <option value="efectivo" {{ old('forma_pago', $member->forma_pago ?? '') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
            <option value="online" {{ old('forma_pago', $member->forma_pago ?? '') == 'online' ? 'selected' : '' }}>Pago en línea</option>
          
        </select>
    </div>
</div>
