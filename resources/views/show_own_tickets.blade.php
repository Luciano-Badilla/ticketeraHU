@php
    use App\Models\DashboardTicketModel;
    use App\Models\ClienteModel;
    use Carbon\Carbon;
@endphp
<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* styles.css */

    .responsive-container {
        padding: 1rem;
        background-color: white;
        border: 1px solid #e5e7eb;
        /* border-gray-200 */
        border-radius: 0.5rem;
        /* rounded-lg */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* shadow-md */
        display: flex;
        flex-direction: column;
        /* Apilar verticalmente en móviles */
        gap: 1.25rem;
        /* gap-5 */
        margin: 5px;
    }

    .responsive-container .item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        /* gap-4 */
        max-width: 25%;
    }

    .responsive-container .item i {
        font-size: 25px;
        /* text-blue-600 */
    }

    .responsive-container .item div {
        margin-left: 1%;
    }

    .responsive-container .flex-1 {
        flex: 1;
    }

    #filter-div-responsive {
        display: flex;
        flex-direction: row;
        /* Filtros en fila por defecto */
        flex-wrap: wrap;
        /* Permite que los filtros se ajusten en varias filas si es necesario */
        gap: 15px;
        /* Espacio entre filtros */
    }

    #deleteFilters {
        align-self: flex-start;
    }

    #date-filters {
        margin-top: -5.5%;
        /* Margen superior para pantallas grandes */
        display: flex;
        flex-direction: row;
        gap: 10px;
        /* Espacio entre filtros */
    }

    #range-filters {
        display: none;
        /* Ocultar por defecto */
        flex-direction: row;
        gap: 10px;
        /* Espacio entre filtros */
    }

    .search_and_filters_div {
        display: flex;
        flex-direction: row;
    }

    .estado {
        /* Centra horizontalmente (opcional) */
        color: white;
        text-align: center;
        font-size: 10px;
        /* Asegúrate de que no se exceda del 50% */
        height: auto;
        padding: 5px;
        /* Ajusta la altura para centrar el contenido verticalmente */
    }

    .estado_background {
        background-color: #343A40;
        border-radius: 0.375rem;
    }

    .custom-scrollbar {
        max-height: 70px;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        /* Ancho de la barra de desplazamiento */
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        /* Color del pulgar de la barra de desplazamiento */
        border-radius: 10px;
        /* Radio de esquina del pulgar */
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
        /* Color de la pista de la barra de desplazamiento */
    }


    @media (min-width: 640px) {
        .responsive-container {
            flex-direction: row;
            /* Cambiar a fila en pantallas grandes */
            gap: 1.25rem;
            /* gap-5 */
        }

        .search_and_filters_div {
            display: flex;
            flex-direction: row;
        }
    }

    /*pantallas grandes*/
    @media (min-width: 768px) {

        #filter_this_month,
        #filter_scheduled,
        #filter_expired,
        #filterButton {
            max-width: auto;
            margin-top: -10px;
        }

        #deleteFilters {
            margin-left: 10px;
        }

        .responsive-container .item i {
            margin-top: 2%;
        }

        #range-filters {
            flex-direction: row;
            /* Filtros en fila en pantallas grandes */
            margin-top: -5.8%;
            /* Ajuste del margen superior para pantallas grandes */
        }

        .search_and_filters_div {
            display: flex;
            flex-direction: row;
        }

        .custom-scrollbar {
            max-height: 100px;
            overflow: auto;
            text-align: start;

        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            /* Ancho de la barra de desplazamiento */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            /* Color del pulgar de la barra de desplazamiento */
            border-radius: 10px;
            /* Radio de esquina del pulgar */
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            /* Color de la pista de la barra de desplazamiento */
        }

    }

    /* Estilos para pantallas pequeñas (móviles) */
    @media (max-width: 767px) {

        #filterButton,
        #filter_this_month,
        #filter_scheduled,
        #filter_expired,
        #deleteFilters {
            width: auto;
        }

        .responsive-container .item i {
            margin-top: 5%;
        }

        .responsive-container .item {
            max-width: 120%;
            height: 150%;
        }

        #filter-div-responsive {
            flex-direction: column;
            width: 100%
                /* Filtros en columna en pantallas pequeñas */
        }

        #deleteFilters {
            align-self: center;
        }

        #date-filters {
            flex-direction: row;
            /* Filtros en columna en pantallas pequeñas */
            margin-top: -7%;
            /* Ajustar el margen superior en móviles */
        }

        .search_and_filters_div {
            display: flex;
            flex-direction: column;
        }

        .search_input_div {
            margin-top: 2%;
        }

        .custom-scrollbar {
            max-height: 200px;
            overflow: auto;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            /* Ancho de la barra de desplazamiento */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            /* Color del pulgar de la barra de desplazamiento */
            border-radius: 10px;
            /* Radio de esquina del pulgar */
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            /* Color de la pista de la barra de desplazamiento */
        }


    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .text-m {
        font-size: 1rem;
    }

    .font-semibold {
        font-weight: 600;
    }

    .font-medium {
        font-weight: 500;
    }

    .font-normal {
        font-weight: 400;
    }

    .text-gray-900 {
        color: #111827;
    }

    .text-gray-600 {
        color: #4b5563;
    }

    .text-gray-800 {
        color: #1f2937;
    }

    .text-gray-100 {
        color: #f3f4f6;
    }

    .text-gray-300 {
        color: #d1d5db;
    }

    .text-gray-200 {
        color: #e5e7eb;
    }

    .dark .text-blue-400 {
        color: #93c5fd;
    }

    .dark .text-gray-800 {
        color: #d1d5db;
    }

    .dark .text-gray-100 {
        color: #f9fafb;
    }
</style>

@php

    $mesActual = ucfirst(Carbon::now()->locale('es')->translatedFormat('F'));
    $añoActual = Carbon::now()->format('Y');

@endphp

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
                                        class="form-control p-2 border rounded-xl h-full w-full lg:min-w-full"
                                        name="email" id="search_input" placeholder="Ingrese su email"
                                        value="{{ request('email') }}" required>
                                    <button type="submit" class="btn btn-dark flex items-center h-9"
                                        id="searchByEmail">
                                        <i id="search_icon" class="fa-solid fa-magnifying-glass"></i>
                                        <div id="loading_icon" class="spinner-border spinner-border-sm" role="status"
                                            style="display: none;">
                                            <span class="visually-hidden">Loading...</span>
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
                            @foreach ($tickets->sortByDesc('created_at') as $ticket)
                                <x-ticket :ticket="$ticket" />
                            @endforeach
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
</script>
