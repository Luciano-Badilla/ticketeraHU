@props(['dashboard_ticket'])

<a href="{{ route('ticket.create', ['titulo' => $dashboard_ticket->titulo, 'detalle' => $dashboard_ticket->detalle, 'id' => $dashboard_ticket->id, 'pretext' => $dashboard_ticket->pretext]) }}"
    class="btn-dark rounded-xl shadow-lg flex items-stretch transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl w-full md:w-[calc(50%-1rem)]">
    <div
        class="bg-pastel-blue flex-shrink-0 flex flex-col items-center justify-center p-4 rounded-xl m-2 w-16 md:w-24 lg:w-40">
        <i
            class="fa-solid {{ $dashboard_ticket->icono }} text-3xl md:text-5xl text-white"></i>
    </div>
    <div class="flex-grow flex items-center py-2">
        <div class="p-4 bg-white rounded-xl m-2 w-full h-full">
            <h3 class="font-semibold text-md md:text-lg text-gray-800 mb-2">
                {{ $dashboard_ticket->titulo }}</h3>
            <p class="text-xs md:text-sm text-gray-600">
                {{ $dashboard_ticket->descripcion }}</p>
        </div>
    </div>
</a>