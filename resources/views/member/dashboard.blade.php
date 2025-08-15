@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold text-coopgreen leading-tight">
        Panel del Socio
    </h2>
@endsection

@section('content')
    {{-- Bienvenida --}}
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-xl p-6 border border-gray-700 w-full max-w-4xl mx-auto">
        <h3 class="text-xl font-bold text-green-400 mb-2">👋 Bienvenido al sistema de socios</h3>
        <p class="text-gray-200 text-sm sm:text-base">Aquí puedes consultar tus movimientos, datos de membresía y más.</p>

        @auth
            <p class="text-gray-300 mt-2 text-sm sm:text-base">Bienvenido, <span class="font-semibold">{{ Auth::user()->name }}</span></p>
        @endauth

        {{-- Botones --}}
        <div class="mt-6 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('reservas.calendario') }}"
               class="inline-flex justify-center items-center bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-5 py-2 rounded-full shadow transition w-full sm:w-auto">
                📅 Agendar ahora
            </a>
        </div>
    </div>

    {{-- Sección de Reservas --}}
    <div class="mt-8 bg-gradient-to-br from-gray-800 to-gray-900 shadow-lg rounded-xl p-6 border border-gray-700 w-full max-w-4xl mx-auto">
        <h4 class="text-xl font-bold text-blue-300 mb-4">📅 Mis Reservas</h4>

        @if($reservas->count())
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <input type="text" id="filtroBusqueda" placeholder="🔍 Filtrar por fecha o comentario..."
                       class="w-full sm:w-1/2 px-3 py-2 rounded-md border border-gray-500 text-sm text-black focus:ring-2 focus:ring-green-400">

                <div class="flex gap-2">
                    <button onclick="filtrarReservas()"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-md text-sm">
                        Aplicar filtro
                    </button>

                    <button id="cancelarFiltro"
                            onclick="cancelarFiltro()"
                            class="hidden bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-md text-sm">
                        Cancelar filtro
                    </button>
                </div>
            </div>

            <ul id="listaReservas" class="space-y-4 text-white">
                @foreach($reservas as $reserva)
                    <li class="bg-gray-700 bg-opacity-30 rounded-lg p-4 border border-gray-600 text-sm sm:text-base">
                        <p><strong>🗓️ Check-in:</strong> {{ \Carbon\Carbon::parse($reserva->check_in)->format('d/m/Y') }}</p>
                        <p><strong>🏁 Check-out:</strong> {{ \Carbon\Carbon::parse($reserva->check_out)->format('d/m/Y') }}</p>
                        <p><strong>🛏️ Habitaciones:</strong> {{ $reserva->rooms }}</p>
                        <p><strong>👥 Personas:</strong> {{ $reserva->guests }}</p>
                        @if($reserva->comentario)
                            <p><strong>💬 Comentario:</strong> {{ $reserva->comentario }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-300">No tienes reservas registradas aún.</p>
        @endif
    </div>

    {{-- Script para filtro en tiempo real --}}
    <script>
        function filtrarReservas() {
            const filtro = document.getElementById('filtroBusqueda').value.toLowerCase();
            const reservas = document.querySelectorAll('#listaReservas li');
            let hayCoincidencias = false;

            reservas.forEach((reserva) => {
                const texto = reserva.innerText.toLowerCase();
                const coincide = texto.includes(filtro);
                reserva.style.display = coincide ? 'block' : 'none';
                if (coincide) hayCoincidencias = true;
            });

            // Mostrar botón cancelar si hay al menos un match
            document.getElementById('cancelarFiltro').classList.toggle('hidden', !hayCoincidencias);
        }

        function cancelarFiltro() {
            const reservas = document.querySelectorAll('#listaReservas li');
            reservas.forEach((reserva) => {
                reserva.style.display = 'block';
            });
            document.getElementById('filtroBusqueda').value = '';
            document.getElementById('cancelarFiltro').classList.add('hidden');
        }
    </script>
@endsection
