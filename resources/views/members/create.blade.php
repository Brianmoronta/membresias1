@extends('layouts.app')

@section('content')
<div class="p-6 bg-coopblue min-h-screen text-white">
    <h1 class="text-2xl font-bold text-coopgreen mb-6">Registrar Nuevo Miembro</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Ups!</strong> Hubo algunos problemas con tu entrada.
            <ul class="mt-2 ml-4 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" class="bg-white text-black p-6 rounded shadow">
        @csrf

        <div x-data="{ tab: 'datos' }">
            <div class="flex gap-4 mb-4">
                <button type="button" @click="tab = 'datos'" class="px-4 py-2 rounded bg-gray-200 text-black" :class="{ 'bg-coopgreen text-white': tab === 'datos' }">Datos Personales</button>
                <button type="button" @click="tab = 'contacto'" class="px-4 py-2 rounded bg-gray-200 text-black" :class="{ 'bg-coopgreen text-white': tab === 'contacto' }">Contacto</button>
                <button type="button" @click="tab = 'membresia'" class="px-4 py-2 rounded bg-gray-200 text-black" :class="{ 'bg-coopgreen text-white': tab === 'membresia' }">Membresía</button>
                <button type="button" @click="tab = 'otros'" class="px-4 py-2 rounded bg-gray-200 text-black" :class="{ 'bg-coopgreen text-white': tab === 'otros' }">Otros</button>
            </div>

            <div x-show="tab === 'datos'">
                @include('members.partials.form-datos')
            </div>

            <div x-show="tab === 'contacto'">
                @include('members.partials.form-contacto')
            </div>

            <div x-show="tab === 'membresia'">
                @include('members.partials.form-membresia')
            </div>

            <div x-show="tab === 'otros'">
                @include('members.partials.form-otros')
            </div>
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('member.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded shadow">
                Volver al Dashboard
            </a>
            <button type="submit" class="bg-coopgreen hover:bg-green-600 text-white py-2 px-6 rounded shadow">Guardar</button>
        </div>
    </form>
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

        function resetearCampos() {
            costoInput.value = '';
            descuentoInput.value = '';
            totalInput.value = '';
        }

        function calcularTotal() {
            const selectedTipo = selectMembresia.selectedOptions[0];
            const selectedDescuento = selectDescuento.selectedOptions[0];

            if (!selectedTipo || !selectedTipo.dataset.costo) {
                resetearCampos();
                return;
            }

            const costo = parseFloat(selectedTipo.dataset.costo);
            costoInput.value = costo.toFixed(2);

            if (!selectedDescuento || selectedDescuento.value === '') {
                descuentoInput.value = '';
                totalInput.value = '';
                return;
            }

            let descuentoTotal = 0;
            if (!selectedDescuento.text.includes('NINGUNO')) {
                descuentoTotal = parseFloat((costo * 0.20).toFixed(2));
            }

            const totalFinal = parseFloat((costo - descuentoTotal).toFixed(2));
            descuentoInput.value = descuentoTotal.toFixed(2);
            totalInput.value = totalFinal.toFixed(2);
        }

        selectMembresia.addEventListener('change', function () {
            resetearCampos();
        });

        selectDescuento.addEventListener('change', calcularTotal);
    });
</script>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Validar formato de cédula DOM: 000-0000000-0
        const cedulaInput = document.getElementById('cedula');
        cedulaInput?.addEventListener('input', function () {
            this.value = this.value
                .replace(/\D/g, '')                // Solo números
                .replace(/(\d{3})(\d)/, '$1-$2')
                .replace(/(\d{3})-(\d{7})(\d)/, '$1-$2-$3')
                .slice(0, 13);
        });

        // Validar teléfono: solo números (máximo 10 dígitos)
        ['phone', 'telefono_secundario'].forEach(id => {
            const input = document.getElementById(id);
            input?.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });
        });
    });
</script>
@endpush


@endpush
@endsection
