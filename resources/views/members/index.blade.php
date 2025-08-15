@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-bold text-coopgreen leading-tight">
        {{ __('Lista de Socios COOPBUENO') }}
    </h2>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function exportarPDF() {
        const element = document.querySelector('.table-responsive') ?? document.body;
        const opt = {
            margin: 0.3,
            filename: 'socios_coopbueno.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(element).set(opt).save();
    }
</script>

@section('content')
<div class="py-4 px-4" x-data="{ openModal: false, modalContent: '' }">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('members.create') }}"
           class="inline-flex items-center px-4 py-2 bg-coopgreen text-white font-semibold rounded-md shadow hover:bg-green-700 transition">
            + Registrar nuevo
        </a>

        @auth
            @if(auth()->user()->role === 'admin')
                <form method="GET" action="{{ route('exportar.socios') }}" class="flex items-end gap-2">
                    <div>
                        <label for="desde" class="block text-white">Desde:</label>
                        <input type="date" id="desde" name="desde" class="rounded-md border-gray-300 shadow-sm text-black" required>
                    </div>
                    <div>
                        <label for="hasta" class="block text-white">Hasta:</label>
                        <input type="date" id="hasta" name="hasta" class="rounded-md border-gray-300 shadow-sm text-black" required>
                    </div>
                    <div>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16V4H4zm8 4v8m0 0l-4-4m4 4l4-4" />
                            </svg>
                            Exportar Excel de Socios
                        </button>
                    </div>
                </form>
            @endif
        @endauth
    </div>

    @if($members->count())
    <div class="overflow-x-auto">
        <form action="{{ route('members.index') }}" method="GET" class="flex space-x-2 mb-4 items-center">
            <input 
                type="text" 
                name="buscar" 
                value="{{ request('buscar') }}" 
                class="p-2 rounded-md border border-gray-300 w-full max-w-sm text-black" 
                placeholder="Buscar socio...">
            <button type="submit" class="bg-lime-500 text-white px-4 py-2 rounded hover:bg-lime-600 transition">
                Buscar
            </button>
            @if(request('buscar'))
                <a href="{{ route('members.index') }}" 
                   class="bg-red-500 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancelar
                </a>
            @endif
            <button type="button"
                @click="openModal = true; modalContent = `{{ addslashes($beneficiosTexto) }}`"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Ver Beneficios
            </button>
        </form>
<table class="min-w-full bg-white dark:bg-gray-800 rounded shadow table-auto">
    <thead class="text-sm text-black bg-coopgray dark:bg-gray-700">
        <tr>
            <th class="px-4 py-3 font-semibold">#</th>
            <th class="px-4 py-3 font-semibold">Nombre</th>
            <th class="px-4 py-3 font-semibold">Correo</th>
            <th class="px-4 py-3 font-semibold">No. Socio</th>
            <th class="px-4 py-3 font-semibold">Código Sistema</th>
            <th class="px-4 py-3 font-semibold">Teléfono</th>
            <th class="px-4 py-3 font-semibold text-center">Carnet</th>
            <th class="px-4 py-3 font-semibold text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
        <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
            <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 align-middle">{{ $member->name }}</td>
            <td class="px-4 py-2 align-middle">{{ $member->email }}</td>
            <td class="px-4 py-2 align-middle">{{ $member->membership_number }}</td>
            <td class="px-4 py-2 align-middle">{{ $member->codigo_sistema }}</td>
            <td class="px-4 py-2 align-middle">{{ $member->phone }}</td>

            {{-- CARNET --}}
            <td class="px-4 py-2 text-center">
                @if(auth()->user()->idsucursal == 0)
                    <div class="flex flex-col items-center gap-1 w-24 mx-auto">
                        <a href="{{ route('members.carnet', $member) }}" target="_blank"
                           class="text-blue-500 hover:underline text-sm">Carnet</a>
                        <a href="{{ route('members.carnet.pdf', $member->id) }}"
                           class="text-blue-500 hover:underline text-sm">Carnet PDF</a>
                    </div>
                @else
                    <div class="flex justify-center">
                        <form action="{{ route('members.carnet.pdf', $member->id) }}" method="GET" target="_blank">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                Imprimir
                            </button>
                        </form>
                    </div>
                @endif
            </td>

            {{-- ACCIONES --}}
            <td class="px-4 py-2 text-center">
                <div class="flex flex-col items-center gap-1 w-24 mx-auto">
                    @if(auth()->user()->idsucursal == 0)
                        <a href="{{ route('members.edit', $member->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm w-full text-center">Editar</a>

                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('¿Seguro que deseas eliminar este socio?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm w-full">
                                Eliminar
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->idsucursal == 0 || auth()->user()->es_usuario_club || (!auth()->user()->es_usuario_club && $member->usuario && $member->usuario->es_usuario_club))
                        <a href="{{ route('reposicion-carnet.create', $member->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm w-full text-center">
                            Reposición
                        </a>
                    @else
                        <span class="text-gray-400 text-sm">---</span>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>





        {{-- MODAL NUEVO RESPONSIVE FUNCIONAL --}}
        <div 
            x-show="openModal" 
            x-transition
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
        >
            <div class="relative bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4 overflow-hidden">
                <button 
                    @click="openModal = false"
                    class="absolute top-2 right-4 text-gray-500 hover:text-red-600 text-3xl font-bold z-10"
                >
                    &times;
                </button>
                <div class="p-6 max-h-[80vh] overflow-y-auto">
                    <h2 class="text-lg font-bold text-coopgreen mb-4">
                        Beneficios por tipo de membresía
                    </h2>
                    <p class="text-sm text-gray-700 whitespace-pre-line" x-text="modalContent"></p>
                </div>
            </div>
        </div>

        <div class="mt-6">
            {{ $members->links() }}
        </div>

        @php
            $dashboardUrl = auth()->user()->role === 'admin' ? route('admin.dashboard') : route('member.dashboard');
        @endphp

        <a href="{{ $dashboardUrl }}"
           class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded-md shadow hover:bg-gray-700 transition">
            Volver al Dashboard
        </a>
    </div>
    @else
        <p class="text-white text-center mt-8">No hay miembros registrados.</p>
    @endif
</div>
@endsection
