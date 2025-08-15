<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carnets en Lote</title>
    <style>
        @page { margin: 0.5cm; }
        body { font-family: sans-serif; font-size: 11px; }

        .carnet {
            width: 340px;
            height: 200px;
            border: 1px solid #004884;
            padding: 10px;
            margin-bottom: 20px;
            display: inline-block;
            page-break-inside: avoid;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #004884;
            margin-bottom: 8px;
        }

        .logo {
            height: 40px;
            margin-right: 10px;
        }

        .info {
            display: flex;
            justify-content: space-between;
        }

        .photo {
            width: 75px;
            height: 85px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .details {
            font-size: 11px;
            line-height: 1.4;
        }

        .footer {
            font-size: 9px;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

@foreach($members as $member)
    <div class="carnet">
        <div class="header">
            <img src="{{ public_path('images/coopbueno_logo.png') }}" class="logo" alt="Logo">
            <div>
                <strong>COOPBUENO</strong><br>
                <small>Cooperativa de Ahorro y Crédito</small>
            </div>
        </div>

        <div class="info">
            <div class="details">
                <p><strong>Nombre:</strong> {{ $member->name }}</p>
                <p><strong>No. Socio:</strong> {{ $member->membership_number }}</p>
                <p><strong>Teléfono:</strong> {{ $member->phone ?? '-' }}</p>
            </div>
            @if($member->photo)
                <img src="{{ public_path('storage/' . $member->photo) }}" class="photo" alt="Foto">
            @endif
        </div>

        <div class="footer">
            Propiedad de COOPBUENO · Presentar al utilizar servicios.
        </div>
    </div>
@endforeach

</body>
</html>
