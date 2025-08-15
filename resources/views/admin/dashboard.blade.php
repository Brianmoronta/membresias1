@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6 text-black">
    <h1 class="text-2xl font-bold text-coopgreen mb-6">Dashboard General</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('members.index') }}" class="bg-coopgreen text-white p-4 rounded shadow hover:bg-green-600 transition duration-200 block">
            <h2 class="text-lg font-semibold">Socios Registrados</h2>
            <p class="text-3xl mt-2">{{ $totalSocios }}</p>
        </a>

        <div class="bg-coopgreen text-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Movimientos de Caja</h2>
            <p class="text-3xl mt-2">{{ $movimientosCaja }}</p>
        </div>

        <div class="bg-coopgreen text-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Confirmado</h2>
            <p class="text-3xl mt-2">RD$ {{ number_format($totalConfirmado, 2) }}</p>
        </div>
    </div>

    @if(auth()->user()->idsucursal === 0)
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold text-coopgreen mb-4">Socios Registrados por Mes</h2>
        <canvas id="sociosChart" height="100"></canvas>
    </div>
    @endif
</div>
@endsection

@push('scripts')
@if(auth()->user()->idsucursal === 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('sociosChart').getContext('2d');
    const data = {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Socios por Mes',
            data: {!! json_encode($datos) !!},
            borderColor: '#78C91D',
            backgroundColor: 'rgba(168, 224, 99, 0.5)',
            fill: true,
            tension: 0.3
        }]
    };

    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endif
@endpush
