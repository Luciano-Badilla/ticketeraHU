@php
    use App\Models\DashboardTicketModel;
    use App\Models\EstadoModel;
    use App\Models\TipoProblemaModel;
    use App\Models\DepartamentoModel;
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
                    <div class="flex flex-col bg-white rounded-xl w-full mx-auto">
                        @if (session('success'))
                            <div class="alert-success rounded-t-xl p-2 sm:p-3">
                                <p class="text-center text-xs sm:text-sm">{{ session('success') }}</p>
                            </div>
                        @endif
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
                        <div class="flex flex-col gap-2">

                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="block sm:table-row">
                                            <th class="py-3 px-6 text-left block sm:table-cell">ID</th>
                                            <th class="py-3 px-6 text-left block sm:table-cell">Fecha</th>
                                            <th class="py-3 px-6 text-left block sm:table-cell">Asunto</th>
                                            <th class="py-3 px-6 text-left block sm:table-cell">Email del cliente
                                            </th>
                                            <th class="py-3 px-6 text-left block sm:table-cell">Problema</th>
                                            <th class="py-3 px-6 text-left block sm:table-cell">Departamento</th>
                                            <th class="py-3 px-6 text-left block sm:table-cell">Estado</th>
                                            <th class="py-3 px-6 text-left block sm:table-cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="departmentList" class="text-gray-600 text-sm font-light">
                                        @foreach ($tickets->sortByDesc('created_at') as $ticket)
                                            <tr class="border-b border-gray-200 ticket" data-id="{{ $ticket->id }}">
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
                                                    {{ EstadoModel::find($ticket->estado_id)->nombre }}
                                                </td>
                                                <td
                                                    class="py-3 px-6 text-left text-md whitespace-nowrap block sm:table-cell">
                                                    @if ($ticket->estado_id != 4)
                                                        @auth
                                                            <div class="flex justify-center">
                                                                <form id="close-ticket-form-{{ $ticket->id }}"
                                                                    action="{{ route('ticket.close', ['id' => $ticket->id]) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                                <button type="button"
                                                                    onclick="document.getElementById('close-ticket-form-{{ $ticket->id }}').submit();"
                                                                    class="btn btn-danger rounded-xl text-sm sm:text-base">
                                                                    <i class="fa-solid fa-clipboard-check mr-2"></i>Cerrar
                                                                </button>
                                                            </div>
                                                        @endauth
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
<script>
    $(".ticket").on("click", function() {
        var ticketId = $(this).data("id");
        if (ticketId == null) {
            return;
        } else {
            window.location.href = "{{ route('ticket.gest', ['id' => '']) }}/" + ticketId;
        }
    });
</script>
