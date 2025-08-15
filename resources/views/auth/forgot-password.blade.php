<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1470&q=80');">

        <div class="bg-white bg-opacity-80 backdrop-blur-sm shadow-lg rounded-xl p-8 w-full max-w-md text-gray-800">
            
            <div class="mb-6 text-sm text-center text-gray-800">
                {{ __('¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo y te enviaremos un enlace para restablecerla.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-base font-bold text-gray-900 mb-1 ml-2">Correo electrónico</label>

                    <x-text-input id="email"
                        class="block mt-1 w-full bg-white text-gray-900 placeholder-gray-500 border border-gray-300 focus:ring-green-600 focus:border-green-600 rounded-md shadow-sm"
                        type="email" name="email" :value="old('email')" required autofocus />

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm underline text-green-800 hover:text-green-600">
                        Volver al login
                    </a>

                    <x-primary-button class="bg-green-700 hover:bg-green-600 text-white px-6 py-2 rounded shadow-md">
                        Enviar enlace
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
