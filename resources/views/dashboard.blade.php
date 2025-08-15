@extends('layouts.app')

@section('content')
<div class="p-6 bg-coopblue min-h-screen">
    <h1 class="text-2xl font-bold text-coopgreen mb-6">Panel General - COOPBUENO</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-lime-500 text-white p-6 rounded-lg shadow">
         <a href="{{ route('members.index') }}" class="block bg-lime-500 text-white p-6 rounded-lg shadow hover:bg-lime-600 transition">
            <h2 class="text-lg font-semibold">Total de Socios</h2>
            <p class="text-4xl mt-2">{{ $totalSocios }}</p>
         </a>
    </div>

        

        <div class="bg-blue-600 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Carnets Generados</h2>
            <p class="text-4xl mt-2">{{ $carnetsGenerados }}</p>
        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Usuarios Totales</h2>
            <p class="text-4xl mt-2">{{ $totalUsuarios }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('members.create') }}" class="inline-block bg-coopgreen text-white px-6 py-3 rounded-md shadow hover:bg-green-600 transition">
            + Registrar Nuevo Miembro
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
        <!-- Evolución mensual -->
        <div class="bg-white p-6 rounded-lg shadow h-[400px]">
            <h2 class="text-lg font-bold text-coopblue mb-4">Evolución mensual de socios</h2>
            <div class="w-full h-[320px]">
                <canvas id="sociosChart"></canvas>
            </div>
        </div>
    
        <!-- Distribución por tipo -->
        <div class="bg-white p-6 rounded-lg shadow h-[400px]">
            <h2 class="text-lg font-bold text-coopblue mb-4">Distribución por tipo de membresía</h2>
            <div class="w-full h-[320px] max-w-[340px] mx-auto">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('sociosChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($meses) !!},
                datasets: [{
                    label: 'Socios por mes',
                    data: {!! json_encode($sociosPorMes) !!},
                    backgroundColor: '#78BE20',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: false }
                }
            }
        });
    
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($porTipoMembresia)) !!},
                datasets: [{
                    label: 'Distribución por tipo',
                    data: {!! json_encode(array_values($porTipoMembresia)) !!},
                    backgroundColor: ['#78BE20', '#FFC107', '#17A2B8'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: false }
                }
            }
        });
    </script>
@endsection
