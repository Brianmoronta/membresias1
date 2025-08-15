<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carnet del Miembro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }

        .card {
            width: 350px;
            height: 200px;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 40px auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-front {
            position: relative;
            background-color: {{ $member->membershipType->color ?? '#003366' }};
            border: 3px solid {{ $member->membershipType->color ?? '#003366' }};
            box-shadow: 0 0 10px {{ $member->membershipType->color ?? '#003366' }};
            color: white;
        }

        .card-back {
            background-color: #ffffff;
            color: #000000;
            border: 2px solid #ccc;
            box-shadow: 0 0 5px #aaa;
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

        .qr-container svg {
            width: 90px;
            height: 90px;
        }

        .qr-container p {
            font-size: 9px;
            margin-top: 4px;
            color: white;
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

        .card-front::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4); /* sombra oscura encima de la imagen */
            z-index: 0;
            border-radius: 10px;
        }

        .card-front > * {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

{{-- 🟢 Frente del Carnet --}}
<div class="card card-front" style="background-image: url('{{ $fondo }}'); background-size: cover; background-position: center;">
    <div class="header">
        <img src="{{ public_path('images/coopbueno_logo.svg') }}" alt="Logo">
    </div>

    <div class="body">
        <div class="info">
            <h2>{{ $member->name }}</h2>
            <p><strong>Código Sistema:</strong> {{ $member->codigo_sistema }}</p>
            <p><strong>Correo:</strong> {{ $member->email }}</p>
            <p><strong>Teléfono:</strong> {{ $member->phone }}</p>
            <p><strong>Cédula:</strong> {{ $member->cedula }}</p>
            <p><strong>Tipo Membresía:</strong> {{ $member->membershipType->nombre ?? 'N/A' }}</p>
        </div>

        <div class="qr-container">
            {!! $qrSvg !!}
            <p><strong>Escanea este QR<br>para registrar la Visita</strong></p>
        </div>
    </div>

    <div class="footer">
        Propiedad de COOPBUENO · Presentar al utilizar servicios
    </div>
</div>

{{-- 🔁 Parte Trasera del Carnet --}}
<div class="card card-back">
    <div class="header">
        <img src="{{ public_path('images/coopbueno_logo.svg') }}" alt="Logo">
    </div>

    <div class="body">
        <div class="info" style="flex: 1;">
            <h3>Políticas de Uso</h3>
            <ul>
                <li>El carnet es personal e intransferible.</li>
                <li>Debe presentarse al usar los servicios.</li>
                <li>El uso indebido puede causar sanciones.</li>
                <li>Escanee el QR para más información.</li>
            </ul>
        </div>

        <div class="qr-container" style="flex: 1; text-align: center;">
            @php
                $qrPolUrl = url('/politicas-membresia');
                $writer = new \BaconQrCode\Writer(
                    new \BaconQrCode\Renderer\ImageRenderer(
                        new \BaconQrCode\Renderer\RendererStyle\RendererStyle(160),
                        new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
                    )
                );
                $qrSvgPoliticas = $writer->writeString($qrPolUrl);
            @endphp

            {!! $qrSvgPoliticas !!}
            <p style="font-size: 10px; color: #333;">Escanea para ver políticas</p>
        </div>
    </div>

    <div class="footer">
        Más información en <strong>https://app.todovirtual.cloud/</strong>
    </div>
</div>

</body>
</html>
