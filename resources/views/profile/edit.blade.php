<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Actualizar información del perfil -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Actualizar contraseña -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar cuenta -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Mostrar reservas del usuario -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">🗓️ Mis Reservas</h3>

                    @forelse ($reservas as $reserva)
                        <div class="mb-4 p-4 rounded bg-gray-100 dark:bg-gray-700">
                            <p><strong>Actividad:</strong> {{ $reserva->actividad }}</p>
                            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}</p>
                            @if($reserva->comentario)
                                <p><strong>Comentario:</strong> {{ $reserva->comentario }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No tienes reservas registradas todavía.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
