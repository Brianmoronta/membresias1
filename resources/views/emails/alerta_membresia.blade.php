<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta de Membresía</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <h2 style="color: #0c5460;">📢 Alerta de Vencimiento de Membresía</h2>

    <p>Hola,</p>

    <p>El socio <strong>{{ $member->name }}</strong> tiene una membresía que vencerá el <strong>{{ \Carbon\Carbon::parse($member->fecha_vencimiento_membresia)->format('d/m/Y') }}</strong>.</p>

    <p>Por favor, toma acción para renovar la membresía o notificar al socio con tiempo.</p>

    <br>
    <p>🕒 Esta alerta fue generada automáticamente por el sistema de membresías.</p>

    <p style="color: #6c757d;">— Todo Virtual Cloud</p>
</body>
</html>
