@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow text-gray-800">
    <h1 class="text-2xl font-bold text-coopgreen mb-4">Políticas de Membresía</h1>

    <p class="mb-4">Estas políticas aplican a todos los socios que posean una membresía activa en COOPBUENO.</p>

    <ol class="list-decimal ml-5 space-y-2 text-sm leading-relaxed">
        <li>El carnet es personal e intransferible. Está prohibido prestarlo o alterarlo.</li>
        <li>Debe presentarse en cada uso de los servicios o instalaciones afiliadas.</li>
        <li>El uso indebido conlleva sanciones, incluyendo suspensión o cancelación.</li>
        <li>Los beneficios y descuentos dependen del plan adquirido por el socio.</li>
        <li>Es responsabilidad del socio mantener sus datos actualizados.</li>
        <li>La vigencia de la membresía se determina desde la fecha de afiliación hasta la fecha de vencimiento registrada.</li>
        <li>Las políticas pueden actualizarse sin previo aviso, pero serán notificadas vía correo electrónico.</li>
    </ol>

    <div class="mt-6 text-sm text-gray-600">
        Para consultas adicionales o aclaraciones, comuníquese con nosotros al <strong>809-848-7429</strong> o por correo a <strong>contacto@todovirtual.cloud</strong>.
    </div>

    <div class="mt-6 text-xs text-right text-gray-500">
        Última actualización: {{ now()->format('d/m/Y') }}
    </div>
</div>
@endsection
