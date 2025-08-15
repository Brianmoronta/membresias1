<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Club Vista a las Montañas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TailwindCSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }
        .hero-bg {
            background-image: url('{{ asset("images/MONTANAS.png") }}');
            background-size: cover;
            background-position: center;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col text-gray-900 overflow-x-hidden">


    <!-- Header -->
    @include('layouts.partials.nav')

    <!-- Contenido dinámico -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });

        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.getElementById('menu').classList.toggle('hidden');
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
