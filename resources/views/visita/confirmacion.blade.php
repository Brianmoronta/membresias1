@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-2xl font-bold text-green-600">¡Gracias por tu visita, {{ $member->name }}! 🎉</h2>
        <p class="mt-4 text-gray-600">Esta es tu visita número <strong>{{ $member->total_visitas }}</strong>.</p>
        <p class="mt-2 text-sm text-gray-400">Fecha: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</div>
@endsection
