<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
    <title>Resumen de Caja</title>
</head>
<body>
    <h2>📋 Resumen de Movimientos de Caja</h2>
    <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Socio</th>
                <th>Concepto</th>
                <th>Monto (RD$)</th>
                <th>Forma de Pago</th>
                <th>Registrado por</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movimientos as $mov)
                <tr>
                    <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $mov->member->name ?? 'N/A' }}</td>
                    <td>{{ $mov->concepto }}</td>
                    <td>{{ number_format($mov->monto, 2) }}</td>
                    <td>{{ ucfirst($mov->forma_pago) }}</td>
                    <td>{{ $mov->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 20px; font-weight: bold;">
        Total General: RD$ {{ number_format($total, 2) }}
    </p>
</body>
</html>
