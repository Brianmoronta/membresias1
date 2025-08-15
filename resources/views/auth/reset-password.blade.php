<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1470&q=80');">
        <div class="bg-white bg-opacity-10 backdrop-blur-sm shadow-lg rounded-xl p-8 w-full max-w-md text-white">

            <h1 class="text-gray-800 text-2xl font-bold mb-6 text-center">Restablecer contraseña</h1>



            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token oculto -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-4">
    <label for="email" class="block text-gray-800 font-semibold text-sm mb-1">Correo electrónico</label>
    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="w-full px-4 py-2 bg-white text-black rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
</div>

<div class="mb-4">
    <label for="password" class="block text-gray-800 font-semibold text-sm mb-1">Nueva contraseña</label>
    <input id="password" type="password" name="password" required class="w-full px-4 py-2 bg-white text-black rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
</div>

<div class="mb-4">
    <label for="password_confirmation" class="block text-gray-800 font-semibold text-sm mb-1">Confirmar contraseña</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-4 py-2 bg-white text-black rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
</div>


                <!-- Botón -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-gray-800 hover:underline text-sm block mb-4 text-center">Volver al login</a>

                    <x-primary-button class="bg-green-700 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Restablecer
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
