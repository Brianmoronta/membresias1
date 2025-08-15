@component('mail::message')
# ¡Hola {{ $member->name }}!

Queremos recordarte que tu membresía vence el **{{ \Carbon\Carbon::parse($member->fecha_vencimiento_membresia)->format('d/m/Y') }}**.

Te invitamos a renovarla a tiempo para seguir disfrutando de todos los beneficios.

@component('mail::button', ['url' => 'https://todovirtual.cloud'])
Renovar Ahora
@endcomponent

Gracias por ser parte de nuestra comunidad.

Atentamente,<br>
**Equipo Todo Virtual**
@endcomponent
