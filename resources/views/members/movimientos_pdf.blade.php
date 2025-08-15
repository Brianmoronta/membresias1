<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Movimientos del Socio</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Movimientos del Socio: {{ $member->name }} ({{ $member->membership_number }})</h2>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Monto (RD$)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $mov)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($mov->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $mov->concepto ?? '-' }}</td>
                    <td>RD${{ number_format($mov->monto, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
