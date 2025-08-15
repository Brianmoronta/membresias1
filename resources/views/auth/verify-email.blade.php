<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1470&q=80');">
        <div class="bg-white bg-opacity-90 shadow-lg rounded-xl p-8 w-full max-w-md text-gray-900 text-center">

            <h2 class="text-2xl font-bold mb-4 text-gray-800">Verifica tu correo</h2>

            <div class="mb-4 text-sm text-gray-700">
                {{ __('Gracias por registrarte. Antes de continuar, verifica tu correo electrónico haciendo clic en el enlace que te enviamos. Si no lo has recibido, podemos enviarte uno nuevo.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Te hemos enviado un nuevo enlace de verificación.') }}
                </div>
            @endif

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="bg-green-700 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Reenviar correo
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-800 hover:text-green-700">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
