<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1470&q=80');">
        <div class="bg-white bg-opacity-10 backdrop-blur-sm shadow-lg rounded-xl p-8 w-full max-w-md text-white">
            
            <div class="mb-6 text-sm text-white text-center">
                {{ __('Esta es un área segura del sistema. Por favor, confirma tu contraseña antes de continuar.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
                    <x-text-input id="password" class="block mt-1 w-full bg-white bg-opacity-20 text-white placeholder-white border border-white"
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-200" />
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm underline text-white hover:text-green-200">
                        Volver al login
                    </a>

                    <x-primary-button class="bg-green-700 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Confirmar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
