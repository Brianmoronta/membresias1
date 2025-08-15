<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1470&q=80');">

        <div class="bg-white bg-opacity-90 backdrop-blur-md shadow-2xl rounded-2xl p-8 w-full max-w-md text-gray-900">

            <!-- Estado de sesión -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h2 class="text-3xl font-bold text-center mb-6 text-green-800">Iniciar Sesión</h2>

                <!-- ✅ Agregar hidden si viene desde Agendar -->
                @if(request('desde_agendar') == 1)
                    <input type="hidden" name="desde_agendar" value="1">
                @endif

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold mb-1 ml-1">
                        Correo electrónico
                    </label>

                    <input id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="tucorreo@ejemplo.com"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:border-green-600 bg-white text-gray-900" />

                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold mb-1 ml-1">
                        Contraseña
                    </label>

                    <input id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:border-green-600 bg-white text-gray-900" />

                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Recordarme + Olvidé contraseña -->
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox"
                               name="remember"
                               class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-400">
                        <span class="ml-2 text-sm text-gray-800">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-800 hover:text-green-600 underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Botón -->
                <div>
                    <button type="submit"
                        class="w-full bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
                        Iniciar sesión
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
