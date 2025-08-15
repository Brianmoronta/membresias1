@component('mail::message')
# Hola {{ $member->name }} 👋

Gracias por registrarte en nuestra plataforma.  
A continuación, te compartimos tus derechos y deberes como miembro activo:

---

## 🟢 Derechos:
- Acceso a las instalaciones según tu tipo de membresía.
- Participación en actividades y beneficios del club/cooperativa.

## 🔴 Deberes:
- Cumplir con el reglamento interno.
- Mantener tus datos actualizados.

@component('mail::button', ['url' => url('/pago/carnet/' . $member->id)])
💳 Pagar carnet digital
@endcomponent

Gracias por formar parte de nuestra comunidad.  

— El equipo de TodoVirtual
@endcomponent
