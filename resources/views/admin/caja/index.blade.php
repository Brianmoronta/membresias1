@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 text-black">
    <h1 class="text-2xl font-bold mb-4">📦 Movimientos de Caja</h1>

    <a href="{{ route('admin.caja.exportar', request()->query()) }}"
        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 inline-block mb-4">
        📄 Exportar a Excel
    </a>

    <a href="{{ route('admin.caja.pdf', request()->query()) }}"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 inline-block mb-4 ml-2">
        🖨️ Exportar PDF
    </a>

    <form method="GET" action="{{ route('admin.caja.index') }}" class="mb-4 flex flex-wrap gap-4 bg-white p-4 rounded shadow-sm">
        <div>
            <label for="codigo" class="block text-sm font-medium text-black">Código del Socio</label>
            <input type="text" name="codigo" id="codigo" value="{{ request('codigo') }}" class="form-input rounded w-full border border-gray-300 px-3 py-1 text-black">
        </div>

        <div>
            <label for="cedula" class="block text-sm font-medium text-black">Cédula del Socio</label>
            <input type="text" name="cedula" id="cedula" value="{{ request('cedula') }}"
                class="form-input rounded w-full border border-gray-300 px-3 py-1 text-black">
        </div>

        <div>
            <label for="desde" class="block text-sm font-medium text-black">Desde</label>
            <input type="date" name="desde" id="desde" value="{{ request('desde') }}" class="form-input rounded border border-gray-300 px-3 py-1 text-black">
        </div>

        <div>
            <label for="hasta" class="block text-sm font-medium text-black">Hasta</label>
            <input type="date" name="hasta" id="hasta" value="{{ request('hasta') }}" class="form-input rounded border border-gray-300 px-3 py-1 text-black">
        </div>

        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrar</button>
        </div>

        @if(request('codigo') || request('cedula') || request('desde') || request('hasta'))
        <div class="flex items-end">
            <a href="{{ route('admin.caja.index') }}"
                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar Filtro
            </a>
        </div>
        @endif
    </form>

    <table class="table-auto w-full bg-white shadow-md rounded text-black">
        <thead class="bg-gray-100 text-sm text-gray-600 uppercase">
            <tr>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Socio</th>
                <th class="px-4 py-2">Concepto</th>
                <th class="px-4 py-2">Monto (RD$)</th>
                <th class="px-4 py-2">Forma de Pago</th>
                <th class="px-4 py-2">Registrado por</th>
            </tr>
        </thead>

        <tbody>
            @forelse($movimientos as $mov)
                <tr class="border-t hover:bg-gray-50 text-sm text-black">
                    <td class="px-4 py-2">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2">{{ optional($mov->member)->codigo_sistema ?? 'Sin código' }}</td>
                    <td class="px-4 py-2">{{ optional($mov->member)->name ?? 'Sin socio' }}</td>
                    <td class="px-4 py-2">{{ $mov->concepto }}</td>
                    <td class="px-4 py-2">RD$ {{ number_format($mov->monto, 2) }}</td>
                    <td class="px-4 py-2 capitalize">{{ $mov->forma_pago }}</td>
                    <td class="px-4 py-2">{{ optional($mov->user)->name ?? 'N/A' }}</td>
                </tr>

                <tr class="text-sm text-center">
                    <td colspan="7" class="py-2">
                        @if(auth()->user()->role === 'admin' && $mov->estado === 'pendiente')
                            @if(in_array(strtolower($mov->forma_pago), ['tarjeta', 'transferencia', 'otro']))
                                <button onclick="abrirModal({{ $mov->id }})" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">
                                    💳 Confirmar con Referencia
                                </button>
                            @else
                                <form action="{{ route('caja.confirmar', $mov->id) }}" method="POST" onsubmit="return confirm('¿Confirmar este pago?')">
                                    @csrf
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm flex items-center gap-1">
                                        ❌ Confirmar Pago
                                    </button>
                                </form>
                            @endif
                        @elseif($mov->estado === 'confirmado')
                            <span class="text-green-700 font-semibold flex items-center gap-1">
                                ✅ Pago Confirmado
                            </span>
                        @else
                            <span class="text-yellow-600 font-medium">⏳ Pendiente</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500 py-4">No hay movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="bg-gray-100 mt-4 p-3 rounded text-right text-lg font-semibold">
        Total Filtrado: RD$ {{ number_format($totalIngresos, 2) }}
    </div>

    <div class="mt-4">
        {{ $movimientos->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal -->
<div id="modalReferencia" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-sm">
        <h2 class="text-lg font-bold mb-4">Confirmar Pago</h2>
        <form id="formReferencia" method="POST">
            @csrf
            <input type="hidden" name="movimiento_id" id="movimiento_id">
            <label for="referencia" class="block text-sm font-medium text-gray-700 mb-1">Número de Referencia</label>
            <input type="text" name="referencia" id="referencia" required class="w-full border rounded px-3 py-2 mb-4 text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="cerrarModal()" class="bg-gray-500 text-white px-3 py-1 rounded">Cancelar</button>
                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Confirmar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function abrirModal(id) {
        document.getElementById('modalReferencia').classList.remove('hidden');
        document.getElementById('movimiento_id').value = id;
        document.getElementById('formReferencia').action = '/admin/caja/confirmar-con-referencia/' + id;
    }

    function cerrarModal() {
        document.getElementById('modalReferencia').classList.add('hidden');
        document.getElementById('referencia').value = '';
    }
</script>
@endsection
