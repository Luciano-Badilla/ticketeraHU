@php
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
    .search_and_filters_div {
        display: flex;
        flex-direction: row;
    }


    @media (min-width: 640px) {

        .search_and_filters_div {
            display: flex;
            flex-direction: row;
        }
    }

    /*pantallas grandes*/
    @media (min-width: 768px) {

        .search_and_filters_div {
            display: flex;
            flex-direction: row;
        }

    }

    /* Estilos para pantallas pequeñas (móviles) */
    @media (max-width: 767px) {

        .search_and_filters_div {
            display: flex;
            flex-direction: column;
        }


    }
</style>

<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg bg-white">
                @if (session('success'))
                    <div class="alert-success">
                        <p style="padding: 0.3%; text-align: center">{{ session('success') }}</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center p-3 bg-light rounded shadow-sm w-full">
                    <div class="flex flex-col" style="width: 95%">
                        <div class="justify-between search_and_filters_div mb-2">
                            <form action="{{ route('ticket.show') }}" method="GET">
                                @csrf
                                <div class="flex items-center space-x-1 mt-4">
                                    <input type="email"
                                        class="form-control p-2 border rounded-lg h-full w-full lg:min-w-full"
                                        name="email" id="search_input" placeholder="Ingrese su email"
                                        value="{{ request('email') }}" required>
                                    <button type="submit" class="btn btn-dark flex items-center h-9"
                                        id="searchByEmail">
                                        <i id="search_icon" class="fa-solid fa-magnifying-glass"></i>
                                        <div id="loading_icon" class="spinner-border spinner-border-sm" role="status"
                                            style="display: none;">
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center max-w-md" id="no_alerts" style="margin: 0 auto;">
                            @if ($tickets->isEmpty())
                                <!-- Verifica si no hay tickets -->
                                <div class="p-6 rounded-lg mt-3">
                                    <div
                                        class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fa-solid fa-ticket text-3xl"></i>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No se encontraron tickets</h2>
                                    <p class="text-gray-600 mb-6">
                                        No hay tickets disponibles con el email ingresado.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col gap-2">
                            @if ($tickets->isNotEmpty())
                                <form id="filters-form">
                                    <div class="flex flex-wrap gap-4">
                                        <!-- Buscador general -->
                                        <div class="w-full sm:w-1/4">
                                            <input type="text" id="search"
                                                class="border-gray-300 rounded-xl shadow-md w-full"
                                                placeholder="Buscar por ID">
                                        </div>

                                        <!-- Selector de fecha -->
                                        <div class="w-full sm:w-1/4">
                                            <input type="date" id="fecha"
                                                class="border-gray-300 rounded-xl shadow-md w-full">
                                        </div>

                                        <!-- Problema (select) -->
                                        <div class="w-full sm:w-1/4">
                                            <select id="problema"
                                                class="border-gray-300 rounded-xl shadow-md w-full p-2">
                                                <option value="">Seleccione un problema</option>
                                                @foreach (TipoProblemaModel::all() as $tipoProblema)
                                                    <option value="{{ $tipoProblema->nombre }}">
                                                        {{ $tipoProblema->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Departamento (select) -->
                                        <div class="w-full sm:w-1/4">
                                            <select id="departamento"
                                                class="border-gray-300 rounded-xl shadow-md w-full p-2">
                                                <option value="">Seleccione un departamento</option>
                                                @foreach (DepartamentoModel::all() as $departamento)
                                                    <option value="{{ $departamento->nombre }}">
                                                        {{ $departamento->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Estado (select) -->
                                        <div class="w-full sm:w-1/4">
                                            <select id="estado"
                                                class="border-gray-300 rounded-xl shadow-md w-full p-2">
                                                <option value="">Seleccione un estado</option>
                                                @foreach (EstadoModel::all() as $estado)
                                                    <option value="{{ $estado->nombre }}">{{ $estado->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                @foreach ($tickets->sortByDesc('created_at') as $ticket)
                                    <x-ticket :ticket="$ticket" />
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    $(document).ready(function() {
        $('#searchByEmail').click(function() {
            if ($('#search_input').val() != '') {
                $('#search_icon').hide();
                $('#loading_icon').show();
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filters-form');
        const tickets = document.querySelectorAll('.ticket');

        form.addEventListener('input', function() {
            const search = document.getElementById('search').value.toLowerCase();
            const fecha = document.getElementById('fecha').value;
            const problema = document.getElementById('problema').value.toLowerCase();
            const departamento = document.getElementById('departamento').value.toLowerCase();
            const estado = document.getElementById('estado').value.toLowerCase();

            tickets.forEach(ticket => {
                const ticketId = ticket.getAttribute('data-id').toLowerCase();
                const ticketFecha = ticket.getAttribute('data-fecha');
                const ticketProblema = ticket.getAttribute('data-problema').toLowerCase();
                const ticketDepartamento = ticket.getAttribute('data-departamento')
                .toLowerCase();
                const ticketEstado = ticket.getAttribute('data-estado').toLowerCase();

                const matchesSearch = !search || ticketId === search;
                const matchesFecha = !fecha || ticketFecha === fecha;
                const matchesProblema = !problema || ticketProblema === problema;
                const matchesDepartamento = !departamento || ticketDepartamento ===
                departamento;
                const matchesEstado = !estado || ticketEstado === estado;

                if (matchesSearch && matchesFecha && matchesProblema &&
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
</script>
