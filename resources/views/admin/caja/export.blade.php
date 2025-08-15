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
