<nav class="bg-white dark:bg-coopblue border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">

        {{-- Logo COOPBUENO --}}
        <div class="flex items-center">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/coopbueno_logo.png') }}" alt="Logo COOPBUENO" class="h-12 w-auto">
            </a>
            <span class="ml-3 font-bold text-coopgreen text-xl hidden sm:inline-block">
                COOPBUENO
            </span>
        </div>

        {{-- Rest of your navigation --}}
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            {{-- Aquí puedes dejar el dropdown de usuario o menú --}}
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth
        </div>

    </div>
</nav>
