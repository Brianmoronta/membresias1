@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-6">
    <div id="resumenReserva" class="text-gray-100 text-lg font-medium">
        Selecciona una fecha para ver los detalles...
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="text-sm text-gray-100">Seleccionar habitación:</label>
            <select name="habitacion_id" id="habitacion_id" class="w-full border border-gray-300 rounded px-2 py-2 text-sm text-black">
                @foreach($habitaciones as $hab)
                    <option value="{{ $hab->id }}" 
                            data-capacidad="{{ $hab->capacidad }}"
                            {{ $habitacionSeleccionada && $hab->id == $habitacionSeleccionada->id ? 'selected' : '' }}>
                        {{ $hab->nombre }} - Capacidad: {{ $hab->capacidad }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-100">Cantidad de huéspedes:</label>
            <input type="number" id="guests" name="guests" min="1" value="1"
                   class="w-full border border-gray-300 rounded px-2 py-2 text-sm text-black">
        </div>

        <div>
            <label class="text-sm text-gray-100">Cantidad de habitaciones:</label>
            <input type="number" id="rooms" name="rooms" min="1" value="1"
                   class="w-full border border-gray-300 rounded px-2 py-2 text-sm text-black">
        </div>
    </div>

    
    <div id="detalleHabitacion" class="p-6 rounded-2xl bg-gray-800 text-white shadow-lg max-w-7xl flex flex-col md:flex-row gap-8 items-start w-full border border-gray-700">
    
    <!-- Carrusel de imágenes aún más amplio -->
    <div class="w-full md:w-[600px]">
        <div class="swiper mySwiper rounded-lg overflow-hidden border border-gray-600 shadow-md">
            <div class="swiper-wrapper" id="imagenesCarrusel"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <!-- Detalles de la habitación -->
    <div class="flex-1 text-left">
        <h3 id="nombreHabitacion" class="text-3xl font-extrabold mb-4">Nombre habitación</h3>
        <p id="descripcionHabitacion" class="text-base text-gray-300 italic mb-5">Descripción corta...</p>
        <p class="text-xl mb-3">
            <span class="font-bold text-green-400">Precio:</span>
            <span id="precioHabitacion"></span>
        </p>
        <p class="text-xl">
            <span class="font-bold text-yellow-300">Capacidad:</span>
            <span id="capacidadHabitacion"></span> 
        </p>
    </div>
</div>  

    {{-- Leyendas arriba del calendario --}}
    <div class="flex space-x-4 text-sm">
        <div class="flex items-center space-x-2">
            <span class="inline-block w-3 h-3 bg-red-500 rounded-full"></span>
            <span class="text-gray-100">Reservado</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
            <span class="text-gray-100">Disponible</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="inline-block w-3 h-3 bg-yellow-400 rounded-full"></span>
            <span class="text-gray-100">Promoción</span>
        </div>
    </div>

    <div id="tusReservas">
        @if($tusReservas->count())
            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded mb-4">
                <strong>🛏 Tus reservas:</strong>
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
    </div>

    <div id="calendarioReservas" class="mb-4"></div>
    @auth
        <button id="confirmarBtn"
            class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded w-full">
            Confirmar Reserva
        </button>
    @else
        <a href="{{ route('login') }}"
           onclick="localStorage.setItem('desdeCalendario', '1');"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full block text-center">
           Iniciar sesión para reservar
        </a>
    @endauth

    <div id="mensajeFinal" class="hidden mt-4 text-green-700 font-semibold">
        ✅ Reserva guardada correctamente.
    </div>
</div>
@endsection

@section('scripts')

<style>
    #calendarioReservas {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
    }
    .fc-daygrid-day {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        position: relative;
    }
    .fc-daygrid-day-number {
        color: #1b1b1b !important;
        font-weight: 500;
        font-size: 14px;
    }
    .fc-col-header-cell-cushion {
        color: #1b1b1b !important;
        font-weight: bold;
    }
    .fc-daygrid-day.fc-day-today {
        background-color: #e9ecef !important;
    }
    .fc-day.fc-selected {
        background-color: #74c69d !important;
        color: black !important;
    }
    .fc-day-green-dot .fc-daygrid-day-frame::after,
    .fc-day-red-dot .fc-daygrid-day-frame::after,
    .fc-day-yellow-dot .fc-daygrid-day-frame::after {
        content: "";
        display: block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin: 0 auto;
        margin-top: 4px;
    }
    .fc-day-green-dot .fc-daygrid-day-frame::after { background-color: #28a745; }
    .fc-day-red-dot .fc-daygrid-day-frame::after { background-color: #dc3545; }
    .fc-day-yellow-dot .fc-daygrid-day-frame::after { background-color: #facc15; }
    .fc .fc-button {
        background-color: #1b4332 !important;
        border: none;
    }
    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
        background-color: #74c69d !important;
        color: black;
    }
    .fc-toolbar-title {
    color: #000000 !important; /* Negro */
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendarioReservas');
        const resumenEl = document.getElementById('resumenReserva');
        const selectHabitacion = document.getElementById('habitacion_id');
        const confirmarBtn = document.getElementById('confirmarBtn');
        const mensajeFinal = document.getElementById('mensajeFinal');

        let fechaInicio = null;
        let fechaFin = null;

        let fechasOcupadas = @json($fechasOcupadas);
        const fechasPromocion = @json($fechasPromocion);
        const hoy = new Date();
        const fechaHoy = hoy.toISOString().split("T")[0];

        selectHabitacion.addEventListener('change', function () {
            const habitacionId = this.value;
            const capacidad = parseInt(this.options[this.selectedIndex].dataset.capacidad);
            document.getElementById('guests').max = capacidad;

// 👇 Obtener y mostrar detalles de la habitación seleccionada
fetch(`/habitaciones/${habitacionId}/info`)
    .then(res => res.json())
    .then(data => {
        const divDetalle = document.getElementById('detalleHabitacion');
        divDetalle.classList.remove('hidden');

        // Mostrar info textual
        document.getElementById('nombreHabitacion').innerText = data.nombre;
        document.getElementById('descripcionHabitacion').innerText = data.descripcion || "Sin descripción disponible";
        document.getElementById('precioHabitacion').innerText = `RD$ ${parseFloat(data.precio).toFixed(2)} / noche`;
        document.getElementById('capacidadHabitacion').innerText = `${data.capacidad} personas`;

        // Cargar imágenes al carrusel
        const contenedor = document.getElementById('imagenesCarrusel');
        contenedor.innerHTML = '';

        if (data.imagenes && data.imagenes.length > 0) {
            data.imagenes.forEach(imagen => {
                contenedor.innerHTML += `
                    <div class="swiper-slide">
                        <img src="${imagen}" class="w-full h-80 object-cover transition-transform duration-300 hover:scale-125" alt="Imagen">
                    </div>
                `;
            });
        } else {
            contenedor.innerHTML = `
                <div class="swiper-slide">
                    <div class="w-full h-32 flex items-center justify-center text-gray-400 italic">
                        Sin imágenes disponibles
                    </div>
                </div>
            `;
        }

        // Reiniciar carrusel si ya existe
        if (window.miSwiper) {
            window.miSwiper.destroy(true, true);
        }

        // Inicializar carrusel de nuevo
        window.miSwiper = new Swiper(".mySwiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    })
    .catch(error => {
        console.error("Error al obtener los datos de la habitación:", error);
    });



            fetch(`/reservas/fechas/${habitacionId}`)
                .then(res => res.json())
                .then(data => {
                    fechasOcupadas = data.fechas;
                    calendar.refetchEvents();
                    calendar.setOption('datesSet', calendar.getOption('datesSet'));
                    calendar.dispatch({ type: 'datesSet', start: calendar.view.currentStart, end: calendar.view.currentEnd });
                    resumenEl.innerHTML = 'Selecciona una fecha para ver los detalles...';
                })
                .catch(err => {
                    alert("⛔ Error al obtener disponibilidad");
                    console.error(err);
                });
        });

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            locale: 'es',
            dayMaxEvents: true,
            validRange: { start: fechaHoy },
            initialDate: fechaHoy,
            select: function(info) {
                fechaInicio = info.startStr;
                fechaFin = info.endStr;

                calendar.getEvents().forEach(e => {
                    if (e.extendedProps.tipo === 'seleccion') e.remove();
                });

                let conflicto = false;
                let current = new Date(fechaInicio);
                const fechaFinObj = new Date(fechaFin);

                while (current < fechaFinObj) {
                    const actualStr = current.toISOString().split('T')[0];
                    if (fechasOcupadas.includes(actualStr)) {
                        conflicto = true;
                        break;
                    }
                    current.setDate(current.getDate() + 1);
                }

                calendar.addEvent({
                    start: fechaInicio,
                    end: fechaFin,
                    display: 'background',
                    backgroundColor: conflicto ? '#dc3545' : '#74c69d',
                    tipo: 'seleccion'
                });

                const start = new Date(fechaInicio);
                const end = new Date(fechaFin);
                const diffTime = Math.abs(end - start);
                const noches = Math.max(Math.ceil(diffTime / (1000 * 60 * 60 * 24)), 1);
                const formato = d => d.toISOString().split("T")[0];

                resumenEl.innerHTML = `${conflicto ? "🚫 <strong>¡Conflicto de fechas!</strong><br>" : ""}
                    📅 <strong>${formato(start)} - ${formato(end)}</strong> (${noches} noche${noches > 1 ? 's' : ''})`;
            },
            datesSet: function(info) {
                const start = new Date(info.start);
                const end = new Date(info.end);
                setTimeout(() => {
                    let current = new Date(start);
                    while (current < end) {
                        const fecha = current.toISOString().split('T')[0];
                        const cell = document.querySelector('[data-date="' + fecha + '"]');
                        if (cell) {
                            cell.classList.remove('fc-day-green-dot', 'fc-day-red-dot', 'fc-day-yellow-dot');
                            if (fechasOcupadas.includes(fecha)) {
                                cell.classList.add('fc-day-red-dot');
                            } else if (fechasPromocion.includes(fecha)) {
                                cell.classList.add('fc-day-yellow-dot');
                            } else {
                                cell.classList.add('fc-day-green-dot');
                            }
                        }
                        current.setDate(current.getDate() + 1);
                    }
                }, 10);
            }
        });

        calendar.render();

        if (localStorage.getItem('desdeCalendario') === '1') {
            confirmarBtn.scrollIntoView({ behavior: 'smooth' });
            localStorage.removeItem('desdeCalendario');
        }

        confirmarBtn.addEventListener('click', function () {
    if (!fechaInicio || !fechaFin) {
        alert("⚠️ Por favor selecciona un rango de fechas.");
        return;
    }

    const fechaInicioObj = new Date(fechaInicio);
    const fechaFinObj = new Date(fechaFin);
    let conflicto = false;
    let current = new Date(fechaInicioObj);

    while (current < fechaFinObj) {
        const actualStr = current.toISOString().split('T')[0];
        if (fechasOcupadas.includes(actualStr)) {
            conflicto = true;
            break;
        }
        current.setDate(current.getDate() + 1);
    }

    if (conflicto) {
        alert("🚫 Ya existe una reserva en esas fechas. Por favor selecciona otro rango.");
        return;
    }

    const habitacion_id = document.getElementById('habitacion_id').value;
    const capacidad = parseInt(document.querySelector('#habitacion_id option:checked').dataset.capacidad);
    const cantidadHuespedes = parseInt(document.getElementById('guests').value);
    const cantidadHabitaciones = parseInt(document.getElementById('rooms').value);

    if (cantidadHuespedes > capacidad * cantidadHabitaciones) {
        alert(`🚫 No puedes reservar más personas de las permitidas. Máximo permitido: ${capacidad * cantidadHabitaciones}`);
        return;
    }

    fetch("/reservas", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            check_in: fechaInicio,
            check_out: fechaFin,
            rooms: cantidadHabitaciones,
            guests: cantidadHuespedes,
            habitacion_id: habitacion_id
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            mensajeFinal.classList.remove('hidden');
            confirmarBtn.disabled = true;
            confirmarBtn.innerText = "✅ Reserva Confirmada";

            // Marcar fechas ocupadas en el calendario
            let current = new Date(fechaInicio);
            const end = new Date(fechaFin);
            while (current < end) {
                const fechaStr = current.toISOString().split('T')[0];
                if (!fechasOcupadas.includes(fechaStr)) {
                    fechasOcupadas.push(fechaStr);
                }
                current.setDate(current.getDate() + 1);
            }

            calendar.setOption('datesSet', calendar.getOption('datesSet'));
            calendar.dispatch({ type: 'datesSet', start: calendar.view.currentStart, end: calendar.view.currentEnd });

            // ✅ Aquí pones el código AJAX para recargar "Tus reservas"
        fetch("/mis-reservas/fragmento")
            .then(res => res.text())
            .then(html => {
                document.getElementById('tusReservas').innerHTML = html;
            });

            // Reset
            fechaInicio = null;
            fechaFin = null;
            confirmarBtn.disabled = false;
            confirmarBtn.innerText = "Confirmar Reserva";
            resumenEl.innerHTML = "Selecciona una fecha para ver los detalles...";
        } else {
            alert(data.message || "⛔ No se pudo guardar la reserva.");
        }
    })
    .catch(err => {
        alert("⛔ Error de conexión");
        console.error(err);
    });
});

    });
</script>
@endsection

