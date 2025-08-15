    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Club Vista a las Montañas</title>
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
    </head>
    <body class="bg-green-50 text-gray-900">

        <!-- Header Responsive -->
        <header class="bg-green-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <h1 class="text-xl font-bold cursor-pointer" onclick="window.location.href='{{ url()->current() }}'">
                🌲 Club Vista a las Montañas
            </h1>

            <!-- Botón hamburguesa -->
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <i class="fas fa-bars text-white text-2xl"></i>
            </button>

            <!-- Menú -->
            <nav id="menu" class="hidden md:flex md:items-center md:space-x-4 text-sm mt-4 md:mt-0">
                <a href="#actividades" class="hover:text-yellow-300 transition">Actividades</a>
                <a href="#revista" class="hover:text-yellow-300 transition">Revista</a>
                <a href="#politicas" class="hover:text-yellow-300 transition">Políticas</a>
                <a href="#contacto" class="hover:text-yellow-300 transition">Contacto</a>
                <a href="#reserva" class="hover:text-yellow-300 transition">Reserva</a>
                <a href="#pago" class="hover:text-yellow-300 transition">Pago</a>

                @guest
                    <a href="{{ route('login') }}" class="bg-white text-green-900 px-4 py-1 rounded-full text-sm font-medium hover:bg-gray-100 transition">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-green-900 px-4 py-1 rounded-full text-sm font-medium hover:bg-yellow-300 transition">Registrarse</a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-white text-green-900 px-4 py-1 rounded-full text-sm font-medium hover:bg-gray-200 transition">Ir al Panel</a>
                @endguest
            </nav>
        </div>

        <!-- Menú responsive (móvil) -->
        <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 space-y-2 bg-green-800">
            <a href="#actividades" class="block text-sm hover:text-yellow-300">Actividades</a>
            <a href="#revista" class="block text-sm hover:text-yellow-300">Revista</a>
            <a href="#politicas" class="block text-sm hover:text-yellow-300">Políticas</a>
            <a href="#contacto" class="block text-sm hover:text-yellow-300">Contacto</a>
            <a href="#reserva" class="block text-sm hover:text-yellow-300">Reserva</a>
            <a href="#pago" class="block text-sm hover:text-yellow-300">Pago</a>

            @guest
                <a href="{{ route('login') }}" class="block bg-white text-green-900 px-4 py-1 rounded-full text-sm font-medium hover:bg-gray-100 transition">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="block bg-yellow-400 text-green-900 px-4 py-1 rounded-full text-sm font-medium hover:bg-yellow-300 transition">Registrarse</a>
            @else
                <a href="{{ route('dashboard') }}" class="block bg-white text-green-900 px-4 py-1 rounded-full text-sm font-medium hover:bg-gray-200 transition">Ir al Panel</a>
            @endguest
        </div>
    </header>

        <!-- Hero Section -->
        <section class="hero-bg relative min-h-screen flex items-center justify-center text-white text-center">
            <div class="absolute inset-0 overlay"></div>
            <div class="relative z-10 px-6" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Respira Naturaleza y Conecta con la Montaña</h2>
                <p class="text-lg md:text-xl mb-6">Únete al Club Vista a las Montañas y disfruta de un entorno ecológico único</p>
                <a href="{{ route('register') }}" class="bg-yellow-400 text-green-900 px-6 py-3 rounded-full font-semibold hover:bg-yellow-300">Hazte Miembro</a>
            </div>
        </section>

        <!-- Actividades -->
        <section id="actividades" class="pt-[80px] py-16 bg-white text-center" data-aos="fade-up">
            <h3 class="text-3xl font-bold mb-6">🌿 Actividades</h3>
            <div class="max-w-4xl mx-auto grid md:grid-cols-3 gap-8 px-6">
                <div>
                    <h4 class="text-xl font-semibold">Senderismo</h4>
                    <p>Explora rutas rodeadas de montañas y aire puro.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">Yoga Ecológico</h4>
                    <p>Relaja cuerpo y mente en un ambiente natural.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">Camping</h4>
                    <p>Disfruta noches estrelladas junto a cascadas naturales.</p>
                </div>
            </div>
        </section>

        <!-- Revista -->
        <section id="revista" class="pt-[80px] py-12 bg-green-100 text-center" data-aos="fade-right">
            <h3 class="text-2xl font-bold mb-6">📰 Nuestra Revista</h3>
            <p class="mb-8">Lee las últimas noticias, fotos y eventos del Club. ¡Explora lo que hemos vivido!</p>
            <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
                <div class="bg-white rounded shadow-md p-4">
                    <img src="{{ asset('images/bienestar.png') }}" alt="Retiro de Bienestar 2025" class="rounded mb-2 w-full h-48 object-cover">
                    <h4 class="font-semibold">Retiro de Bienestar 2025</h4>
                    <p class="text-sm text-gray-600">Una jornada mágica entre cascadas, fogatas y meditación en la cima.</p>
                </div>
                <div class="bg-white rounded shadow-md p-4">
                    <img src="{{ asset('images/senderismo.png') }}" alt="Día de Senderismo Familiar" class="rounded mb-2 w-full h-48 object-cover">
                    <h4 class="font-semibold text-lg">Día de Senderismo Familiar</h4>
                    <p class="text-sm text-gray-600">Más de 50 familias exploraron juntos el Bosque Encantado de la región.</p>
                </div>
                <div class="bg-white rounded shadow-md p-4">
                    <img src="{{ asset('images/campamento.png') }}" alt="Campamento Nocturno" class="rounded mb-2 w-full h-48 object-cover">
                    <h4 class="font-semibold">Campamento Nocturno</h4>
                    <p class="text-sm text-gray-600">Estrellas, historias y chocolate caliente junto a la cascada central.</p>
                </div>
            </div>
        </section>


        <!-- Reserva -->
       
<section id="reserva" class="pt-[80px] py-12 bg-white text-center" data-aos="zoom-in-up">
    <h3 class="text-2xl font-bold mb-4">📅 Reserva Online</h3>
    <p class="mb-6">Agenda tus visitas guiadas y participa en eventos especiales.</p>

    <div class="flex justify-center">
        <a href="{{ route('register', ['desde_agendar' => 1]) }}" 
        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded-full inline-flex items-center">
    📅 Agendar ahora
</a>



</a>

    </div>
</section>

<!-- Modal de Calendario -->
<div id="modalReserva" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl relative">
        <h2 class="text-xl font-bold mb-4 text-center text-coopgreen">Selecciona tu Fecha de Reserva</h2>

        <!-- Contenedor del calendario -->
        <div id="calendarioReservas" class="bg-gray-100 rounded p-4"></div>

        <!-- Botón para cerrar -->
        <button onclick="document.getElementById('modalReserva').classList.add('hidden')"
            class="absolute top-2 right-4 text-gray-700 hover:text-red-500 font-bold text-xl">
            &times;
        </button>
    </div>
</div>


</section>

        <!-- Pago -->
    {{-- <section id="pago" class="pt-[80px] py-12 bg-green-100 text-center" data-aos="fade-up">
            <h3 class="text-2xl font-bold mb-4">💳 Realiza tu Pago</h3>
            <p>Completa tu membresía pagando en línea de forma segura.</p>
            <a href="{{ route('logout') }}" class="mt-4 inline-block bg-yellow-400 text-green-900 px-6 py-3 rounded-full font-semibold hover:bg-yellow-300">Ir al Pago</a>
        </section>
    s--}}
        <!-- Agregado justo antes del Footer -->
    <section class="pt-[80px] py-12 bg-white text-center" data-aos="fade-up">
        <h3 class="text-2xl font-bold mb-6">✨ Beneficios de ser Miembro</h3>
        <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-6 text-left px-6">
            <ul class="space-y-2">
                <li>✅ Acceso exclusivo a zonas ecológicas protegidas</li>
                <li>✅ Reservas prioritarias para eventos especiales</li>
                <li>✅ Descuentos en entradas para acompañantes</li>
                <li>✅ Carnet personalizado con código QR</li>
            </ul>
            <ul class="space-y-2">
                <li>✅ Invitaciones a retiros y campamentos</li>
                <li>✅ Acceso anticipado a la revista ecológica</li>
                <li>✅ Eventos exclusivos para miembros</li>
                <li>✅ Reconocimiento digital por compromiso ambiental</li>
            </ul>
        </div>
    </section>

    <section class="py-12 bg-green-200 text-center" data-aos="zoom-in">
        <h3 class="text-2xl font-bold mb-6">😍 Testimonios</h3>
        <div class="flex flex-wrap justify-center gap-6 max-w-5xl mx-auto px-4">
            <div class="bg-white shadow-md rounded p-4 max-w-xs">
                <p class="text-sm italic">"Una experiencia inolvidable. Las rutas son hermosas y el equipo es muy amable."</p>
                <p class="mt-2 font-semibold text-green-800">- María P.</p>
            </div>
            <div class="bg-white shadow-md rounded p-4 max-w-xs">
                <p class="text-sm italic">"Fácil registrarse y reservar. Todo muy organizado, lo recomiendo al 100%."</p>
                <p class="mt-2 font-semibold text-green-800">- Carlos R.</p>
            </div>
        </div>
    </section>

    <section class="py-16 bg-green-700 text-white text-center" data-aos="fade-up">
        <h3 class="text-3xl font-bold mb-2">Estás a un paso de ser parte de la naturaleza</h3>
        <p class="mb-6">Conviértete en miembro y vive la experiencia desde adentro</p>
        <a href="{{ route('register') }}" class="bg-yellow-400 text-green-900 px-6 py-3 rounded-full font-semibold hover:bg-yellow-300 transition">Unirme Ahora</a>
    </section>


        <!-- Footer con íconos -->
        <footer class="bg-green-900 text-white text-center py-6 mt-10">
            <div class="mb-4">
                <p class="text-lg font-semibold">Síguenos en nuestras redes</p>
                <div class="flex justify-center space-x-6 mt-2 text-2xl">
                    <a href="https://facebook.com" target="_blank" class="hover:text-yellow-400"><i class="fab fa-facebook"></i></a>
                    <a href="https://instagram.com" target="_blank" class="hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/18095551234" target="_blank" class="hover:text-yellow-400"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <p class="mt-2">&copy; {{ date('Y') }} Club Vista a las Montañas. Todos los derechos reservados.</p>
        </footer>

        <!-- Scripts -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 1000, once: true });

            document.getElementById('menu-toggle').addEventListener('click', () => {
                document.getElementById('menu').classList.toggle('hidden');
            });
        </script>

<!-- Modal Reserva -->
<div id="modalReserva" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
        <!-- Botón de cerrar -->
        <button onclick="document.getElementById('modalReserva').classList.add('hidden')"
            class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl">&times;</button>

        <h3 class="text-xl font-bold mb-4 text-center">🗓️ Reservar Visita</h3>

        <form action="{{ route('reservas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="fecha" class="block font-semibold mb-1">Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
            <div>
                <label for="hora" class="block font-semibold mb-1">Hora:</label>
                <input type="time" id="hora" name="hora" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
            <div>
                <label for="nombre" class="block font-semibold mb-1">Tu Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <button type="submit" class="w-full bg-green-800 text-white py-2 rounded hover:bg-green-700 transition">
                Confirmar Reserva
            </button>
        </form>
    </div>
</div>

    </body>
    </html>
