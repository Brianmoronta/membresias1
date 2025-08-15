@component('mail::message')
# ¡Hola {{ $user->name }}!

Por favor, haz clic en el botón de abajo para verificar tu correo:

@component('mail::button', ['url' => $url])
Verificar correo
@endcomponent

Gracias,<br>
El equipo de Club Vista a la Montaña
@endcomponent
