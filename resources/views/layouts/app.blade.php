<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- SwiperJS JS -->

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COOPBUENO – Sistema de Membresías</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="min-h-screen bg-coopblue text-white font-sans antialiased">
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleMenu = document.getElementById('toggleMenu');
        const menu = document.getElementById('menuMobile');
        if (toggleMenu && menu) {
            toggleMenu.addEventListener('click', function () {
                menu.classList.toggle('hidden');
            });
        }
    });
</script>
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif
<header class="bg-white dark:bg-coopblue shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div>
            @yield('header')
        </div>
    </div>
</header>
@auth
@php
    $user = auth()->user();
    $socio = \App\Models\Member::where('email', $user->email)->first();
@endphp
<nav class="bg-coopgray text-white px-4 py-3 shadow-md">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="text-lg font-bold">
            {{ $user->role === 'admin' ? 'Panel de Administración' : 'Panel del Socio' }}
        </div>
        <div class="sm:hidden">
            <button id="toggleMenu" class="text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="hidden sm:flex space-x-6 items-center">
            @if($user->role === 'admin' && ($user->idsucursal === 0 || $user->es_usuario_club == 1))
                @if($user->idsucursal === 0)
                    <a href="{{ route('admin.dashboard') }}">Inicio Admin</a>
                @endif
                <a href="{{ route('members.index') }}">Socios</a>
                <a href="{{ route('admin.caja.index') }}">Caja</a>
                <div class="relative group">
                    <button class="hover:underline focus:outline-none">Más Opciones</button>
                    <div class="absolute hidden group-hover:block bg-coopblue text-white shadow-lg rounded mt-2 z-10 min-w-[200px]">
                        @if($user->idsucursal === 0 || $user->es_usuario_club == 1)
                            <a href="{{ route('reservas.admin') }}" class="block px-4 py-2 hover:bg-coopgreen">📅 Reservas Agendadas</a>
                        @endif
                        <a href="#" class="block px-4 py-2 hover:bg-coopgreen">📊 Reportes</a>
                        <a href="#" class="block px-4 py-2 hover:bg-coopgreen">⚙ Configuraciones</a>
                        <a href="{{ route('admin.habitaciones.index') }}" class="block px-4 py-2 hover:bg-coopgreen">🛏 Habitaciones</a>
                    </div>
                </div>
                @if($user->idsucursal === 0)
                    <a href="{{ route('membership-types.index') }}">Tipos de Membresía</a>
                    <a href="{{ route('admin.sucursales.index') }}">Sucursales</a>
                    <a href="{{ route('exportar.socios') }}">Exportar Excel</a>
                    <div class="relative group">
                        <button class="hover:underline focus:outline-none">Usuarios</button>
                        <div class="absolute hidden group-hover:block bg-coopblue text-white shadow-lg rounded mt-2 z-10 min-w-[200px]">
                            <a href="{{ route('admin.usuarios.index') }}" class="block px-4 py-2 hover:bg-coopgreen">Listado de Usuarios</a>
                            <a href="{{ route('admin.usuarios.create') }}" class="block px-4 py-2 hover:bg-coopgreen">Crear Usuario</a>
                        </div>
                    </div>
                @endif
            @elseif($user->role === 'user')
                <a href="{{ route('member.dashboard') }}">Inicio Socio</a>
                @if($socio)
                    <a href="{{ route('members.showByNumber', $socio->membership_number) }}">Mi Perfil</a>
                @endif
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 px-3 py-2 rounded text-white">Cerrar sesión</button>
            </form>
        </div>
        <!-- Menú móvil se mantiene igual por simplicidad -->
    </div>
</nav>
@endauth
<main class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @yield('content')
    </div>
</main>
@stack('scripts')
@yield('scripts')
</body>
</html>