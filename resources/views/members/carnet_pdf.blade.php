<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carnet del Miembro</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            page-break-after: always;
        }

        .card {
            width: 86mm;
            height: 54mm;
            border-radius: 10px;
            padding: 15px 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 70px;
            height: auto;
        }

        .body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info {
            flex: 2;
            padding-right: 10px;
        }

        .info h2 {
            margin: 0;
            font-size: 18px;
        }

        .info p {
            margin: 3px 0;
            font-size: 13px;
        }

        .qr-container {
            text-align: center;
        }

        .qr-container img {
            width: 80px;
            height: 80px;
        }

        .qr-container p {
            font-size: 9px;
            margin-top: 4px;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            margin-top: 5px;
        }

        .card-back h3 {
            text-align: center;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .card-back ul {
            font-size: 12px;
            padding-left: 18px;
        }

        .card-back .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<!-- 🟢 Frente del Carnet -->
<div class="page">
    <div class="card" style="background-color: {{ $member->membershipType->color ?? '#003366' }}; color: white;">
        

        <div class="body">
            <div class="info">
                <h2>{{ $member->name }}</h2>
                <p><strong>Código Miembro:</strong> {{ $member->codigo_sistema }}</p>
                <p><strong>Correo:</strong> {{ $member->email }}</p>
                <p><strong>Teléfono:</strong> {{ $member->phone }}</p>
                <p><strong>Cédula:</strong> {{ $member->cedula }}</p>
                <p><strong>Tipo Membresía:</strong> {{ $member->membershipType->nombre ?? 'N/A' }}</p>
            </div>
            <div class="qr-container">
                <img src="{{ $qrVisita }}" alt="QR Visita">
                <p><strong>Escanea este QR<br>para registrar la Visita</strong></p>
            </div>
        </div>

        <div class="footer">
            Propiedad de COOPBUENO · Presentar al utilizar servicios
        </div>
    </div>
</div>

<!-- 🟡 Reverso del Carnet -->
<div class="page">
    <div class="card card-back" style="background-color: #ffffff; color: #000;">
        
        <div class="body">
            <div class="info">
                <h3>Políticas de Uso</h3>
                <ul>
                    <li>El carnet es personal e intransferible.</li>
                    <li>Debe presentarse al usar los servicios.</li>
                    <li>El uso indebido puede causar sanciones.</li>
                    <li>Escanee el QR para más información.</li>
                </ul>
            </div>
            <div class="qr-container">
                <img src="{{ $qrPoliticas }}" alt="QR Políticas">
                <p><strong>Escanea para ver políticas</strong></p>
            </div>
        </div>

        <div class="footer">
            Más información en <strong>https://app.todovirtual.cloud/</strong>
        </div>
    </div>
</div>

</body>
</html>
