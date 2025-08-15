@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-coopblue p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-coopgreen mb-4">📅 Reservas Agendadas</h1>

    <div id="calendar" class="bg-white p-4 rounded shadow text-black"></div>
</div>

<!-- Modal Detalle Reserva -->
<div id="modalReserva" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white text-black p-6 rounded-lg w-full max-w-md shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Detalles de la Reserva</h2>
        <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
        <p><strong>Correo:</strong> <span id="modalEmail"></span></p>
        <p><strong>Teléfono:</strong> <span id="modalTelefono"></span></p>
        <p><strong>Check-In:</strong> <span id="modalCheckIn"></span></p>
        <p><strong>Check-Out:</strong> <span id="modalCheckOut"></span></p>

        <div class="mt-4 flex flex-col space-y-2">
            <a id="btnEditar" href="#" class="bg-blue-600 text-white px-4 py-2 rounded text-center">✏️ Editar Reserva</a>

            <form method="POST" action="" id="formEliminar">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded w-full">🗑️ Eliminar Reserva</button>
            </form>

            <button onclick="cerrarModal()" class="bg-gray-300 px-3 py-1 rounded mt-2">Cerrar</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function cerrarModal() {
        document.getElementById('modalReserva').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            events: @json($eventos),
            eventColor: '#28a745',

            eventClick: function(info) {
                // Mostrar modal
                document.getElementById('modalReserva').classList.remove('hidden');

                // Asignar datos
                document.getElementById('modalNombre').innerText = info.event.title;
                document.getElementById('modalEmail').innerText = info.event.extendedProps.email || 'N/A';
                document.getElementById('modalTelefono').innerText = info.event.extendedProps.telefono || 'N/A';
                document.getElementById('modalCheckIn').innerText = info.event.startStr;
                document.getElementById('modalCheckOut').innerText = info.event.endStr;

                // Editar
                const btnEditar = document.getElementById('btnEditar');
                btnEditar.href = `/reservas/${info.event.id}/edit`;

                // Eliminar
                document.getElementById('formEliminar').action = `/reservas/${info.event.id}`;
            }
        });

        calendar.render();
    });
</script>
@endpush
