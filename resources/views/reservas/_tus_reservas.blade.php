@if($tusReservas->count())
    <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded mb-4">
        <strong>🛏️ Tus reservas:</strong>
        <ul class="list-disc ml-5">
            @foreach($tusReservas as $reserva)
                <li>
                    Del {{ \Carbon\Carbon::parse($reserva->check_in)->format('d/m/Y') }}
                    al {{ \Carbon\Carbon::parse($reserva->check_out)->format('d/m/Y') }},
                    {{ $reserva->rooms }} habitación(es), {{ $reserva->guests }} persona(s)
                </li>
            @endforeach
        </ul>
    </div>
@endif
