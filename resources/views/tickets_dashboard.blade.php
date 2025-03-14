@php
    use App\Models\DashboardTicketModel;
    use App\Models\EstadoModel;
    use App\Models\TipoProblemaModel;
    use App\Models\DepartamentoModel;
    use App\Models\AreaModel;
    use App\Models\PrioridadModel;
    use App\Models\ClienteModel;
    use Carbon\Carbon;
@endphp
<script src="https://cdn.tailwindcss.com"></script>
<style>
    tr:hover {
        background-color: #cccbcb;
        cursor: pointer;
    }
</style>

@php
    $mesActual = ucfirst(Carbon::now()->locale('es')->translatedFormat('F'));
    $añoActual = Carbon::now()->format('Y');
@endphp

<x-app-layout>
    <div class="py-2">
        <div class="mx-auto lg:px-8">
            <div class="w-full lg:w-3/4 mx-auto">
                <div class="d-flex justify-content-center p-3 w-full">
                    <div class="flex flex-col bg-white rounded-xl mx-auto w-auto">
                        @if (session('success'))
                            <div class="alert-success rounded-t-xl p-1 sm:p-1">
                                <p class="text-center text-md sm:text-md">{{ session('success') }}</p>
                            </div>
                        @endif


                        <!-- Filtros de búsqueda -->
                        <form id="filters-form" class="p-3">
                            <div class="flex flex-wrap gap-4">
                                <!-- Buscador general -->
                                <div class="w-full sm:w-1/4">
                                    <input type="text" id="search"
                                        class="border-gray-300 rounded-xl shadow-md w-full border"
                                        placeholder="Buscar por asunto o ID">
                                </div>

                                <!-- Email del cliente -->
                                <div class="w-full sm:w-1/4">
                                    <input type="email" id="email"
                                        class="border-gray-300 rounded-xl shadow-md w-full border"
                                        placeholder="Buscar por email">
                                </div>

                                <!-- Selector de fecha -->
                                <div class="w-full sm:w-1/4">
                                    <input type="date" id="fecha"
                                        class="border-gray-300 rounded-xl shadow-md w-full border">
                                </div>

                                <!-- Problema (select) -->
                                <div class="w-full sm:w-1/4">
                                    <select id="problema" class="border-gray-300 rounded-xl shadow-md w-full p-2 border">
                                        <option value="">Seleccione un problema</option>
                                        @foreach (TipoProblemaModel::orderBy('nombre')->get() as $tipoProblema)
                                            <option value="{{ $tipoProblema->nombre }}">{{ $tipoProblema->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Departamento (select) -->
                                <div class="w-full sm:w-1/4">
                                    <select id="departamento" class="border-gray-300 rounded-xl shadow-md w-full p-2 border">
                                        <option value="">Seleccione un departamento</option>
                                        @foreach (DepartamentoModel::orderBy('nombre')->get() as $departamento)
                                            <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Estado (select) -->
                                <div class="w-full sm:w-1/4">
                                    <select id="estado" class="border-gray-300 rounded-xl shadow-md w-full p-2 border">
                                        <option value="">Seleccione un estado</option>
                                        @foreach (EstadoModel::orderBy('nombre')->get() as $estado)
                                            <option value="{{ $estado->nombre }}">{{ $estado->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="text-center max-w-md" id="no_alerts" style="margin: 0 auto;">
                            @if ($tickets->isEmpty())
                                <div class="p-6 rounded-lg mt-3">
                                    <div
                                        class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fa-solid fa-ticket text-md sm:text-lg"></i>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No se encontraron tickets</h2>
                                    <p class="text-gray-600 mb-6">No hay tickets disponibles.</p>
                                </div>
                            @endif
                        </div>

                        @if ($tickets->isNotEmpty())
                            @if ($isMobile)
                                @foreach ($tickets->sortByDesc('created_at') as $ticket)
                                    <x-ticket :ticket="$ticket" />
                                @endforeach
                            @else
                                <div class="flex flex-col gap-2">
                                    <div>
                                        <table class="min-w-full">
                                            <thead>
                                                <tr class="block sm:table-row">
                                                    <th class="py-3 px-6 text-left block sm:table-cell">ID</th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Fecha</th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Asunto</th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Email del
                                                        cliente
                                                    </th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Problema</th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Departamento
                                                    </th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Sub área</th>
                                                    <th class="py-3 px-6 text-left block sm:table-cell">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ticket-list" class="text-gray-600 text-sm font-light">
                                                @foreach ($tickets->sortByDesc('created_at') as $ticket)
                                                    <tr class="border-b border-gray-200 ticket font-bold"
                                                        data-id="{{ $ticket->id }}">
                                                        <td class="py-3 px-6 text-left text-md block sm:table-cell">
                                                            <a
                                                                href="{{ route('ticket.gest', ['id' => $ticket->id]) }}">#{{ $ticket->id }}</a>
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ $ticket->created_at->format('d/m/y H:i') }}
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ $ticket->asunto }}
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ ClienteModel::find($ticket->cliente_id)->email }}
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ DepartamentoModel::find($ticket->departamento_id)->nombre }}
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ AreaModel::find($ticket->area_id)->nombre ?? 'Sub área no asignada' }}
                                                        </td>
                                                        <td
                                                            class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                            {{ EstadoModel::find($ticket->estado_id)->nombre }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function adjustZoomForResolution() {
        document.body.style.zoom = "0.9"; // Método simple
    }

    // Ejecuta al cargar la página
    adjustZoomForResolution();

    // Opcional: Revisa cuando cambie el tamaño de la ventana
    window.addEventListener("resize", adjustZoomForResolution);

    if (window.innerWidth <= 600) {

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filters-form');
            const tickets = document.querySelectorAll('.ticket');

            form.addEventListener('input', function() {
                const search = document.getElementById('search').value.toLowerCase();
                const fecha = document.getElementById('fecha').value;
                const email = document.getElementById('email').value.toLowerCase();
                const problema = document.getElementById('problema').value.toLowerCase();
                const departamento = document.getElementById('departamento').value.toLowerCase();
                const estado = document.getElementById('estado').value.toLowerCase();

                tickets.forEach(ticket => {
                    const ticketId = ticket.getAttribute('data-id').toLowerCase();
                    const ticketFecha = ticket.getAttribute('data-fecha');
                    const ticketEmail = ticket.getAttribute('data-email').toLowerCase();
                    const ticketProblema = ticket.getAttribute('data-problema').toLowerCase();
                    const ticketDepartamento = ticket.getAttribute('data-departamento')
                        .toLowerCase();
                    const ticketEstado = ticket.getAttribute('data-estado').toLowerCase();

                    const matchesSearch = !search || ticketId === search;
                    const matchesFecha = !fecha || ticketFecha === fecha;
                    const matchesProblema = !problema || ticketProblema === problema;
                    const matchesEmail = !email || ticketEmail === email;
                    const matchesDepartamento = !departamento || ticketDepartamento ===
                        departamento;
                    const matchesEstado = !estado || ticketEstado === estado;

                    if (matchesSearch && matchesFecha && matchesProblema && matchesEmail &&
                        matchesDepartamento && matchesEstado) {
                        ticket.classList.remove('d-none');
                        ticket.classList.add('d-flex'); // O d-block si no usas flexbox
                        ticket.classList.add('lg:flex-row'); // O d-block si no usas flexbox
                    } else {
                        ticket.classList.add('d-none');
                        ticket.classList.remove('d-flex');
                    }
                });
            });
        });
    } else {
        // Filtrado en el lado del cliente
        $(document).on('input', '#filters-form input, #filters-form select', function() {
            var searchText = $('#search').val().toLowerCase();
            var fecha = $('#fecha').val(); // Formato 'yyyy-mm-dd'
            var email = $('#email').val();
            var problema = $('#problema').val();
            var departamento = $('#departamento').val();
            var estado = $('#estado').val();

            $('.ticket').each(function() {
                var ticket = $(this);

                // Obtener valores de la fila
                var ticketId = ticket.find('td').eq(0).text().toLowerCase();
                var ticketAsunto = ticket.find('td').eq(2).text().toLowerCase();
                var ticketFecha = ticket.find('td').eq(1).text().trim(); // Formato 'dd/mm/yy hh:mm'
                var ticketEmail = ticket.find('td').eq(3).text().toLowerCase();
                var ticketProblema = ticket.find('td').eq(4).text().toLowerCase();
                var ticketDepartamento = ticket.find('td').eq(5).text().toLowerCase();
                var ticketEstado = ticket.find('td').eq(7).text().toLowerCase();

                var matches = true;

                // Filtro por asunto o ID
                if (searchText && !(ticketAsunto.includes(searchText) || ticketId.includes(
                        searchText))) {
                    matches = false;
                }

                // Filtro por fecha (si se seleccionó una fecha)
                if (fecha) {
                    // Extraer solo la fecha de la cadena 'dd/mm/yy hh:mm'
                    var ticketDateParts = ticketFecha.split(' ')[0].split('/'); // 'dd/mm/yy'
                    var ticketFormattedDate = '20' + ticketDateParts[2] + '-' + ticketDateParts[1] +
                        '-' +
                        ticketDateParts[0]; // 'yyyy-mm-dd'

                    if (ticketFormattedDate !== fecha) {
                        matches = false;
                    }
                }

                if (email && !ticketEmail.includes(email.toLowerCase())) {
                    matches = false;
                }

                // Filtro por tipo de problema
                if (problema && !ticketProblema.includes(problema.toLowerCase())) {
                    matches = false;
                }

                // Filtro por departamento
                if (departamento && !ticketDepartamento.includes(departamento.toLowerCase())) {
                    matches = false;
                }

                // Filtro por estado
                if (estado && !ticketEstado.includes(estado.toLowerCase())) {
                    matches = false;
                }

                // Mostrar u ocultar fila según los filtros
                if (matches) {
                    ticket.show();
                } else {
                    ticket.hide();
                }
            });
        });
    }

    // Manejar el click en el contenedor de tickets
    $(".ticket").on("click", function() {
        var ticketId = $(this).data("id");
        if (ticketId == null) {
            return;
        } else {
            window.location.href = "{{ route('ticket.gest', ['id' => '']) }}/" + ticketId;
        }
    });

    // Prevenir propagación en el botón "Cerrar"
    $(".btn-danger").on("click", function(event) {
        event.stopPropagation();
    });
</script>
