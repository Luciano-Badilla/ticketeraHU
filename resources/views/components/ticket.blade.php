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
    style="text-decoration: none !important; cursor: pointer;" data-id="{{ $ticket->id }}"
    data-email="{{ ClienteModel::find($ticket->cliente_id)->email }}" data-fecha="{{ $ticket->created_at->format('Y-m-d') }}"
    data-problema="{{ TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}" data-departamento="{{ DepartamentoModel::find($ticket->departamento_id)->nombre }}"
    data-estado="{{ EstadoModel::find($ticket->estado_id)->nombre }}"
    onclick="window.location.href='{{ route('ticket.gest', ['id' => $ticket->id]) }}';">

    <!-- Ícono del ticket -->
    <div class="items-start">
        <i class="fa-solid fa-ticket text-lg text-gray-700"></i>
    </div>

    <!-- Información principal del ticket -->
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}" class="ticket-link flex flex-col rounded-lg"
        onclick="event.stopPropagation();"> <!-- Evitar redirección duplicada -->
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
            <i class="fa-solid fa-hourglass-end text-gray-500"></i>
            <span class="text-sm lg:text-xs">{{ EstadoModel::find($ticket->estado_id)->nombre }}</span>
        </div>
    </div>
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}"
        class="ticket-link flex flex-col rounded-lg btn btn-dark" onclick="event.stopPropagation();">Ver ticket
    </a>

</div>
