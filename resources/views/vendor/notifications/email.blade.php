@component('mail::message')
<img src="{{ asset('images/logo-todovirtual.png') }}" alt="TodoVirtual" width="150" style="margin-bottom: 20px;">

# ¡Hola!

Por favor haz clic en el botón de abajo para verificar tu dirección de correo electrónico.

@component('mail::button', ['url' => $actionUrl])
Verificar correo electrónico
@endcomponent

Si no creaste una cuenta, no se requiere realizar ninguna acción.

Saludos,  
**Club Vista a las Montañas**

@if (!empty($actionUrl))
---

Si tienes problemas para hacer clic en el botón "Verificar correo electrónico", copia y pega la siguiente URL en tu navegador:

[{{ $actionUrl }}]({{ $actionUrl }})
@endif
@endcomponent
