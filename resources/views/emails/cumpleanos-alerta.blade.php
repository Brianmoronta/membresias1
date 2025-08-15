<h2>🎉 Alerta de Cumpleaños</h2>
<p>Hola,</p>
<p>El socio <strong>{{ $member->name }}</strong> cumple años el <strong>{{ \Carbon\Carbon::parse($member->fecha_nacimiento)->format('d/m') }}</strong>.</p>
<p>Faltan <strong>{{ $diasRestantes }}</strong> días.</p>
<p>Prepárate para celebrarlo o enviar una felicitación especial.</p>
