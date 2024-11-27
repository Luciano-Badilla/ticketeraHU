@php
    use App\Models\DashboardTicketModel;
    use App\Models\ClienteModel;
    use App\Models\TicketModel;
    use Carbon\Carbon;
@endphp
<script src="https://cdn.tailwindcss.com"></script>
<style>
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
                    <div class="flex flex-col w-50">
                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold mb-4">Sub-areas</h2>
                            <div class="bg-white shadow-md rounded-lg p-2">
                                @if ($areas->isEmpty())
                                    <!-- Verifica si no hay tickets -->
                                    <div class="p-6 rounded-lg mt-3">
                                        <div
                                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fa-solid fa-briefcase text-3xl"></i>
                                        </div>
                                        <h2 class="text-2xl text-center font-bold text-gray-900 mb-2">No hay areas
                                            cargadas</h2>
                                    </div>
                                @endif
                                @foreach ($areas as $area)
                                    <div class="flex justify-between items-center rounded p-2 mb-2 hover:bg-gray-100">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $area->nombre }}</h3>
                                            <p class="text-gray-600">Cant. tickets:
                                                {{ TicketModel::where('area_id', $area->id)->count() }}</p>
                                        </div>
                                        <a href="{{route('ticket.dashboard',['typeSort' => 'area', 'id' => $area->id])}}" class="btn btn-dark rounded-xl">
                                            Ver tickets
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold mb-4">Estado</h2>
                            <div class="bg-white shadow-md rounded-lg p-2">
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
                                    <div class="flex justify-between items-center rounded p-2 mb-2 hover:bg-gray-100">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $estado->nombre }}</h3>
                                            <p class="text-gray-600">Cant. tickets:
                                                {{ TicketModel::where('estado_id', $estado->id)->count() }}</p>
                                        </div>
                                        <a href="{{route('ticket.dashboard',['typeSort' => 'estado','id' => $estado->id])}}" class="btn btn-dark rounded-xl">
                                            Ver tickets
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script></script>
