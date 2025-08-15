@extends('layouts.public')

@section('content')

@if($hero)
<section class="relative w-full min-h-screen bg-cover bg-center pt-24 md:pt-32 overflow-hidden"
         style="background-image: url('{{ asset('images/' . basename($hero->imagen)) }}')">

    <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center text-white text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
            {{ $hero->titulo }}
        </h1>
        <p class="text-xl mt-3 drop-shadow-md">
            {{ $hero->subtitulo }}
        </p>
        @if((int) $hero->mostrar_boton === 1)
        <a href="{{ $hero->boton_url ?? '#' }}"
           class="mt-6 bg-white text-green-700 px-6 py-2 rounded shadow hover:bg-green-100 transition font-semibold">
            {{ $hero->boton_texto ?? 'Más información' }}
        </a>
        @endif
    </div>
</section>
@endif

@endsection
