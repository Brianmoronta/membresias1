<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1470&q=80');">
         
        <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-xl p-8 w-full max-w-md text-gray-900">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                @if(request('desde_agendar') == 1)
                    <input type="hidden" name="desde_agendar" value="1">
                @endif


                <h2 class="text-2xl font-bold text-center mb-6 text-green-700">Regístrate – Club Vista a las Montañas</h2>

<!-- Nombre -->
<div class="mb-4">
    <label for="name" class="block text-sm font-semibold text-black mb-1">Nombre completo</label>
    <x-text-input id="name" class="block mt-1 w-full bg-white bg-opacity-20 text-white placeholder-white border border-white" 
        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2 text-yellow-200" />
</div>

<!-- Cédula -->
<div class="mb-4">
    <label for="cedula" class="block text-sm font-semibold text-black mb-1">Cédula</label>
    <x-text-input id="cedula" class="block mt-1 w-full bg-white bg-opacity-20 text-white placeholder-white border border-white" 
        type="text" name="cedula" :value="old('cedula')" required />
    <x-input-error :messages="$errors->get('cedula')" class="mt-2 text-yellow-200" />
</div>

<!-- Email -->
<div class="mb-4">
    <label for="email" class="block text-sm font-semibold text-black mb-1">Correo electrónico</label>
    <x-text-input id="email" class="block mt-1 w-full bg-white bg-opacity-20 text-white placeholder-white border border-white"
        type="email" name="email" :value="old('email')" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-200" />
</div>

<!-- Contraseña -->
<div class="mb-4">
    <label for="password" class="block text-sm font-semibold text-black mb-1">Contraseña</label>
    <x-text-input id="password" class="block mt-1 w-full bg-white bg-opacity-20 text-white placeholder-white border border-white"
        type="password" name="password" required autocomplete="new-password" />
    <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-200" />
</div>

<!-- Confirmar Contraseña -->
<div class="mb-6">
    <label for="password_confirmation" class="block text-sm font-semibold text-black mb-1">Confirmar contraseña</label>
    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white bg-opacity-20 text-white placeholder-white border border-white"
        type="password" name="password_confirmation" required autocomplete="new-password" />
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-yellow-200" />
</div>
                <!-- Acciones -->
                <div class="flex items-center justify-between">
                    <a class="underline text-sm text-gray-700 hover:text-green-600" href="{{ route('login', ['desde_agendar' => request('desde_agendar')]) }}">
                        ¿Ya tienes cuenta?
                    </a>


                    <x-primary-button class="bg-green-700 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Registrarse
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para autocompletar -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const email = sessionStorage.getItem('registro_email');
            const cedula = sessionStorage.getItem('registro_cedula');

            if (email) {
                const emailInput = document.querySelector('input[name="email"]');
                if (emailInput) emailInput.value = email;
            }

            if (cedula) {
                const cedulaInput = document.querySelector('input[name="cedula"]');
                if (cedulaInput) cedulaInput.value = cedula;
            }
        });
    </script>
</x-guest-layout>
