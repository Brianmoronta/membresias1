@component('mail::message')
<div style="text-align: center;">
    <img src="{{ asset('images/logo-todovirtual.png') }}" alt="TodoVirtual" width="120" style="margin-bottom: 20px;">
</div>

# ¡Hola {{ $user->name }}! 👋

¡Gracias por unirte a **Club Vista a la Montaña**!  
Estamos emocionados de tenerte en nuestra comunidad.

Tu cuenta ha sido creada exitosamente, solo falta un pequeño paso:

@component('mail::button', ['url' => $verificationUrl])
Verificar mi correo
@endcomponent

Al verificar tu correo podrás:

- Acceder a todas las funcionalidades de la plataforma ✅  
- Recibir alertas y beneficios personalizados 📬  
- Formar parte del Club Vista Las Montañas 🏔️  

---

Si no creaste esta cuenta, puedes ignorar este correo.

Saludos cordiales,  
**El equipo de Club Vista a la Montaña**

<small>Este mensaje fue enviado automáticamente. No respondas a este correo.</small>
@endcomponent
