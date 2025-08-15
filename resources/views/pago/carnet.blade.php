@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2 class="mb-3">💳 Pago de Carnet Digital</h2>

    <p><strong>Socio:</strong> {{ $socio->name }}</p>
    <p><strong>Número de membresía:</strong> {{ $socio->membership_number }}</p>
    <p><strong>Monto a pagar:</strong> RD${{ number_format($socio->costo_membresia, 2) }}</p>

    <a href="#" class="btn btn-success mt-3">
        Realizar pago del carnet (simulado)
    </a>

    <p class="text-muted mt-4">
        Este es un enlace simulado. Una vez tengamos integración con Carnet, aquí redirigiremos al pago real.
    </p>
</div>
@endsection
