@props(['ticket'])

@php
    use App\Models\DashboardTicketModel;
    use App\Models\EstadoModel;
    use App\Models\TipoProblemaModel;
    use App\Models\DepartamentoModel;
    use App\Models\PrioridadModel;
    use App\Models\ClienteModel;
@endphp

<style>
    .ticket:hover {
        background-color: #e9e9e9 !important;
    }
</style>

<div class="ticket bg-white shadow-md rounded-xl w-full p-4 flex flex-col gap-3 lg:grid lg:grid-cols-[auto_120px_1fr_100px] lg:gap-2 lg:items-center transition-all duration-300 ease-in-out"
    style="text-decoration: none !important">

    <!-- Ícono del ticket -->
    <div class="items-start">
        <i class="fa-solid fa-ticket text-lg text-gray-700"></i>
    </div>

    <!-- Información principal del ticket -->
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}" class="ticket-link flex flex-col rounded-lg">
        <span><strong>Ticket #{{ $ticket->id }}</strong></span>
        <span class="text-xs text-gray-500">{{ $ticket->created_at->format('d/m/y H:i') }}</span>
    </a>

    <!-- Detalles adicionales -->
    <div class="grid grid-cols-1 gap-3 lg:grid-cols-6 lg:gap-4">
        <div class="flex items-center gap-2 lg:gap-1">
            <i class="fa-solid fa-circle-info text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ $ticket->asunto }}</span>
        </div>
        <div class="flex items-center gap-2 lg:gap-1">
            <i class="fa-solid fa-user text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ ClienteModel::find($ticket->cliente_id)->email }}</span>
        </div>
        <div class="flex items-center gap-2 lg:gap-1">
            <i class="fa-solid fa-triangle-exclamation text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}</span>
        </div>
        <div class="flex items-center gap-2 lg:gap-1">
            <i class="fa-solid fa-building text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ DepartamentoModel::find($ticket->departamento_id)->nombre }}</span>
        </div>
        <div class="flex items-center gap-2 lg:gap-1">
            <i class="fa-solid fa-flag text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ PrioridadModel::find($ticket->prioridad_id)->nombre }}</span>
        </div>
        <div class="flex items-center gap-2 lg:gap-1">
            <i class="fa-solid fa-hourglass-end text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ EstadoModel::find($ticket->estado_id)->nombre }}</span>
        </div>
    </div>

    <!-- Botón para cerrar -->
    @if ($ticket->estado_id != 2)
        @auth
            <div class="flex justify-center">
                <!-- Formulario -->
                <form id="close-ticket-form-{{ $ticket->id }}"
                    action="{{ route('ticket.close', ['id' => $ticket->id]) }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- Botón -->
                <button type="button" onclick="document.getElementById('close-ticket-form-{{ $ticket->id }}').submit();"
                    class="btn btn-danger px-3 py-2 text-sm lg:px-2 lg:py-1 lg:text-xs">
                    Cerrar
                </button>
            </div>

        @endauth
    @endif

</div>
