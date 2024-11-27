@php
    use App\Models\DashboardTicketModel;
    use App\Models\ClienteModel;
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
                    <div class="flex flex-col" style="width: 95%">
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
