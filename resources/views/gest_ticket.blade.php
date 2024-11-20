@php
    use App\Models\DashboardTicketModel;
    use App\Models\EstadoModel;
    use App\Models\TipoProblemaModel;
    use App\Models\DepartamentoModel;
    use App\Models\PrioridadModel;
    use App\Models\ClienteModel;
    use App\Models\AdjuntoModel;
    use App\Models\User;
@endphp

<script src="https://cdn.tailwindcss.com"></script>
<style>
    a {
        text-decoration: none !important;
    }

    .container {
        padding: 1%;
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        flex-wrap: wrap;
        /* Para que los elementos se ajusten en pantallas pequeñas */
    }

    .form-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 10px;
        flex: 1;
        /* Para que ambos divs ocupen el mismo espacio */
        max-width: 48%;
        /* Ajusta el ancho de cada sección */
        box-sizing: border-box;
    }

    /* Media query para pantallas pequeñas */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            /* Cambia la dirección a columna en pantallas pequeñas */
        }

        .form-section {
            max-width: 100%;
            /* Haz que los divs ocupen el 100% del ancho en móviles */
        }
    }

    /* Redondear bordes del editor */
    #editor {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 1px solid #ccc;
        /* Asegúrate de que el borde sea consistente */
        overflow: hidden;
        /* Para evitar que el contenido sobresalga */
        position: relative;
        /* Para posicionar el controlador de tamaño */
    }

    /* Redondear bordes de la barra de herramientas */
    .ql-toolbar {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border: 1px solid #ccc;
        /* Asegúrate de que el borde sea consistente */
    }

    img {
        border-radius: 10px;
    }

    .rendered-content {
        word-wrap: break-word;
        /* Ajusta palabras largas */
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ 'Ticket #' . $ticket->id . ' - ' . $ticket->asunto }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                <x-status-alert :status="'success'"></x-status-alert>
                @if ($errors->any())
                    <x-error-alert :error="$errors"></x-error-alert>
                @endif

                <form action="{{ route('ticket.response') }}" class="p-8" method="post" enctype="multipart/form-data"
                    id="form-ticket-response">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <div class="bg-white w-full">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold mb-2">Información del Ticket</h2>
                            <div class="flex flex-col">
                                <div class="flex  ml-3 w-full">
                                    <strong class="w-1/3 mr-2">Email del Cliente:</strong>
                                    <span class="w-2/3"
                                        style="margin-left: -15%">{{ ' ' . ClienteModel::find($ticket->cliente_id)->email }}</span>
                                </div>
                                <div class="flex  ml-3 w-full">
                                    <strong class="w-1/3 mr-2">Estado del Ticket:</strong>
                                    <span class="w-2/3"
                                        style="margin-left: -15%">{{ EstadoModel::find($ticket->estado_id)->nombre }}</span>
                                </div>
                                <div class="flex  ml-3 w-full">
                                    <strong class="w-1/3 mr-2">Creado en:</strong>
                                    <span class="w-2/3"
                                        style="margin-left: -15%">{{ ' ' . $ticket->created_at->format('d/m/y h:i') }}</span>
                                </div>
                                <div class="flex  ml-3 w-full">
                                    <strong class="w-1/3 mr-2">Departamento Asignado:</strong>
                                    <span class="w-2/3"
                                        style="margin-left: -15%">{{ ' ' . DepartamentoModel::find($ticket->departamento_id)->nombre }}</span>
                                </div>
                                <div class="flex  ml-3 w-full">
                                    <strong class="w-1/3 mr-2">Problema asociado a:</strong>
                                    <span class="w-2/3"
                                        style="margin-left: -15%">{{ ' ' . TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}</span>
                                </div>
                            </div>
                        </div>
                        @if ($adjuntos->count() > 0)
                            <div class="mt-1 border-gray-300 rounded-md">
                                <h2 class="text-2xl font-bold mb-2">Archivos adjuntos</h2>
                                <div class="flex flex-col">
                                    @foreach ($adjuntos as $adjunto)
                                        <a href="{{ asset(AdjuntoModel::find($adjunto->adjunto_id)->path) }}"
                                            class="ml-3">{{ '• ' . AdjuntoModel::find($adjunto->adjunto_id)->nombre }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- Cuerpo del ticket -->
                        <div class="mt-4 p-4 bg-gray-100 border border-gray-300 rounded-md">
                            <span class="py-1 px-2 text-xs bg-black text-white rounded-xl"
                                style="max-width: auto !important;">
                                {{ ClienteModel::find($ticket->cliente_id)->email . ' ' . $ticket->created_at->format('d/m/y h:i') }}
                            </span>
                            <div class="text-sm text-gray-900 h-auto rendered-content mt-4">{!! $ticket->cuerpo !!}
                            </div>
                        </div>
                        <div>
                            @foreach ($ticket_response->get()->sortBy('created_at') as $response)
                                <!-- Cada contenedor de mensaje recibe la clase 'message' -->
                                <div class="message mt-2 p-4 bg-gray-100 border border-gray-300 rounded-md"
                                    data-time="{{ $response->created_at->toIso8601String() }}">

                                    <!-- Aquí van los detalles del mensaje -->
                                    <span class="py-1 px-2 text-xs text-white rounded-xl"
                                        style="max-width: auto !important; background-color: {{ is_numeric($response->personal_id) ? 'green' : 'black' }};">
                                        @if (is_numeric($response->personal_id))
                                            {{ User::find($response->personal_id)->email . ' ' . $response->created_at->format('d/m/y h:i') }}
                                        @else
                                            {{ $response->personal_id . ' ' . $response->created_at->format('d/m/y h:i') }}
                                        @endif
                                    </span>

                                    <div class="text-gray-900 h-auto mt-2 rendered-content">{!! $response->cuerpo !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>



                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <h2 class="text-2xl font-bold mb-2 mt-4">Responder</h2>
                                <!-- Cambiar textarea por un div para Quill -->
                                <x-texteditor></x-texteditor> <!-- id="editor" id-input="detalle" -->

                            </div>
                        </div>
                        @auth
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold mb-2">Estado</h2>
                                <select class="w-full p-2 border rounded-md">
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                    @endforeach
                                </select>
                        </div>@endauth

                        <div class="flex justify-end space-x-4">
                            <button class="px-4 py-2 bg-black text-white rounded-md">Enviar</button>
                        </div>

                    </div>
                </form>


            </div>
        </div>
</x-app-layout>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Incluye el CSS de Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluye el JavaScript de Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    function custom_alert(message) {
        const error_alert = document.getElementById('error_alert');
        error_alert.classList.remove('hidden');
        const error_message = document.getElementById('error_message');
        error_message.textContent = message;
    }

    document.getElementById('form-ticket-response').onsubmit = function(e) {
        var content = quill.root.innerHTML.trim(); // Remueve espacios en blanco al inicio y final
        document.getElementById('detalle').value = content;

        if (!content || content === "<p><br></p>") { // Verifica si está vacío
            document.getElementById('detalle').value = null;
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        let ticketId = {{ $ticket->id }};
        let messages = document.querySelectorAll('.message');
        let lastMessage = messages.length > 0 ? messages[messages.length - 1] : null;

        let lastChecked = lastMessage ?
            new Date(lastMessage.getAttribute('data-time')).toISOString() :
            null; // Si no hay mensajes, lastChecked será null

        function checkNewMessages() {
            let url = `{{ route('ticket.checkNewMessages', $ticket->id) }}`;
            if (lastChecked) {
                url += `?lastChecked=${lastChecked}`;
            }

            console.log("Verificando si hay nuevos mensajes con la fecha:", lastChecked);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log("Datos recibidos del backend:", data);

                    if (data.newMessages) {
                        console.log('Nuevos mensajes detectados, recargando...');
                        location.reload();
                    } else {
                        console.log('No hay nuevos mensajes.');
                    }
                })
                .catch(error => {
                    console.error("Error al verificar nuevos mensajes:", error);
                });
        }

        // Configura el polling cada 5 segundos
        setInterval(checkNewMessages, 5000);
    });
</script>
