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
    }
</style>

@php
    $mesActual = ucfirst(Carbon::now()->locale('es')->translatedFormat('F'));
    $añoActual = Carbon::now()->format('Y');
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <div class="d-flex justify-content-center p-3 w-full">
                    <div class="flex flex-col bg-white rounded-xl" style="width: 75%">
                        @if (session('success'))
                            <div class="alert-success rounded-t-xl">
                                <p style="padding: 0.3%; text-align: center">{{ session('success') }}</p>
                            </div>
                        @endif
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
                                        No hay tickets disponibles.
                                    </p>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col gap-2">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="hidden">
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                        <th class="py-3 px-6 text-left"></th>
                                    </tr>
                                </thead>
                                <tbody id="departmentList" class="text-gray-600 text-sm font-light">
                                    @foreach ($tickets->sortByDesc('created_at') as $ticket)
                                        <tr class="border-b border-gray-200">
                                            <td class="py-3 px-6 text-left text-md">#{{ $ticket->id }}</td>
                                            <td class="py-3 px-6 text-left text-md">
                                                {{ $ticket->created_at->format('d/m/y H:i') }}</td>
                                            <td class="py-3 px-6 text-left text-md"><i
                                                    class="fa-solid fa-circle-info text-gray-500"></i>
                                                {{ $ticket->asunto }}</td>
                                            <td class="py-3 px-6 text-left text-md"><i
                                                    class="fa-solid fa-user text-gray-500"></i>
                                                {{ ClienteModel::find($ticket->cliente_id)->email }}</td>
                                            <td class="py-3 px-6 text-left text-md"><i
                                                    class="fa-solid fa-triangle-exclamation text-gray-500"></i>
                                                {{ TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}</td>
                                            <td class="py-3 px-6 text-left text-md"><i
                                                    class="fa-solid fa-building text-gray-500"></i>
                                                {{ DepartamentoModel::find($ticket->departamento_id)->nombre }}</td>
                                            <td class="py-3 px-6 text-left text-md"><i
                                                    class="fa-solid fa-hourglass-end text-gray-500"></i>
                                                {{ EstadoModel::find($ticket->estado_id)->nombre }}</td>
                                            <td class="py-3 px-6 text-left text-md">
                                                @if ($ticket->estado_id != 4)
                                                    @auth
                                                        <div class="flex justify-center">
                                                            <!-- Formulario -->
                                                            <form id="close-ticket-form-{{ $ticket->id }}"
                                                                action="{{ route('ticket.close', ['id' => $ticket->id]) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                            </form>

                                                            <!-- Botón -->
                                                            <button type="button"
                                                                onclick="document.getElementById('close-ticket-form-{{ $ticket->id }}').submit();"
                                                                class="btn btn-danger rounded-xl"><i
                                                                    class="fa-solid fa-clipboard-check mr-2"></i>Cerrar
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
