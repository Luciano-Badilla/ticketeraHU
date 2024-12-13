@php
    use App\Models\DashboardTicketModel;
    use App\Models\ClienteModel;
    use App\Models\TicketModel;
    use Carbon\Carbon;
@endphp
<script src="https://cdn.tailwindcss.com"></script>
<style>
    a.estado:hover {
        background-color: rgb(245, 245, 245) !important;
    }

    a.area:hover {
        background-color: rgb(245, 245, 245) !important;
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
                @if (session('success'))
                    <div class="alert-success">
                        <p style="padding: 0.3%; text-align: center">{{ session('success') }}</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center p-3 w-full">
                    <div class="flex flex-col w-full lg:w-2/4">

                        <div>
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 mb-8">
                                @if ($estados->isEmpty())
                                    <!-- Verifica si no hay tickets -->
                                    <div class="p-6 rounded-lg mt-3">
                                        <div
                                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fa-solid fa-hourglass-end text-3xl"></i>
                                        </div>
                                        <h2 class="text-2xl text-center font-bold text-gray-900 mb-2">No hay estados
                                            cargados</h2>
                                    </div>
                                @endif
                                @foreach ($estados as $estado)
                                    <a href="{{ route('ticket.dashboard', ['typeSort' => 'estado', 'id' => $estado->id]) }}"
                                        class="estado relative block overflow-hidden bg-white border border-black rounded-xl p-3 hover:text-black">
                                        <div class="flex flex-row items-center justify-between pb-2">
                                            <h2 class="text-sm font-medium">{{ $estado->nombre }}</h2>
                                            <i class="fa-regular {{ $estado->icon }} h-4 w-4 text-gray-500"></i>
                                        </div>
                                        <div>
                                            <div class="text-2xl font-bold">
                                                {{ TicketModel::join('ticketera_ticket', 'ticket.id', '=', 'ticketera_ticket.ticket_id')->where('ticket.estado_id', $estado->id)->where('ticketera_ticket.ticketera_id', Auth::user()->ticketera_id)->count() }}
                                            </div>
                                            <p class="text-xs text-gray-500">{{ $estado->description }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <div
                                class="estado relative block overflow-hidden bg-white border border-black rounded-xl p-3 hover:text-black">
                                <div>
                                    <h2 class="text-lg font-medium">Sub-áreas</h2>
                                    <p class="text-gray-500">Áreas específicas para la gestión de tickets</p>
                                </div>
                                @if ($areas->isEmpty())
                                    <!-- Verifica si no hay tickets -->
                                    <div class="p-6 rounded-lg mt-3">
                                        <div
                                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                            <i class="fa-solid fa-briefcase text-3xl"></i>
                                        </div>
                                        <h2 class="text-2xl text-center font-bold text-gray-900 mb-2">No hay sub áreas
                                            cargadas</h2>
                                        <p class="text-center text-gray-500">Agregue sub áreas para organizar sus
                                            tickets</p>
                                    </div>
                                @endif
                                <div class="space-y-1 mt-2">
                                    @foreach ($areas as $area)
                                        <a href="{{ route('ticket.dashboard', ['typeSort' => 'area', 'id' => $area->id]) }}"
                                            class="area flex items-center justify-between rounded-lg p-1">
                                            <div class="flex items-center space-x-4">
                                                <i class="fas {{ $area->icon }} h-6 w-6"></i>
                                                <div>
                                                    <h3 class="text-sm font-medium">{{ $area->nombre }}</h3>
                                                    <p class="text-sm text-gray-500">
                                                        {{ TicketModel::join('ticketera_ticket', 'ticket.id', '=', 'ticketera_ticket.ticket_id')->where('ticket.area_id', $area->id)->where('ticketera_ticket.ticketera_id', Auth::User()->ticketera_id)->where('ticket.estado_id', '!=', 4)->count() }}
                                                        tickets pendientes</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    // Recargar cada 1 minuto (60000 milisegundos)
    setInterval(function() {
        location.reload();
    }, 60000);
</script>
