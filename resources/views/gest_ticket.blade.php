@php
    use App\Models\DashboardTicketModel;
    use App\Models\EstadoModel;
    use App\Models\TipoProblemaModel;
    use App\Models\DepartamentoModel;
    use App\Models\PrioridadModel;
    use App\Models\ClienteModel;
    use App\Models\AdjuntoModel;
    use App\Models\User;
    use Carbon\Carbon;

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



    img {
        border-radius: 10px;
    }

    .rendered-content {
        word-wrap: break-word;
        /* Ajusta palabras largas */
    }

    /* Asegúrate de que el iframe ocupe el 100% del contenedor */
    .ql-video {
        width: 100%;
        /* Hace que ocupe todo el ancho disponible */
        height: 250px;
        /* Ajusta la altura a un valor específico */
        border-radius: 10px;
        /* Opcional: agrega bordes redondeados */
        overflow: hidden;
        /* Asegura que no se desborde el contenido */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        /* Agrega sombra opcional */
    }


    @media (min-width: 1024px) {
        .dato-personal {
            margin-left: -15%
        }

        .ql-video {
            width: 100%;
            height: 50%;
            /* Ajusta la altura en pantallas pequeñas */
        }
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
                @if ($ticket->estado_id == 4)
                    <div class="alert-danger rounded-t-lg">
                        <p style="padding: 0.3%; text-align: center">El ticket ha sido cerrado por {{ User::find($ticket->cerrado_por)->name_and_surname . ' el ' . $ticket->updated_at->format('d/m/y H:i')}} y no está disponible para
                            más acciones.</p>
                    </div>
                @endif
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
                                <div class="flex flex-col lg:flex-row ml-3 w-full">
                                    <strong class="w-1/3 mr-2 whitespace-nowrap">Email del Cliente:</strong>
                                    <span
                                        class="w-2/3 dato-personal">{{ ' ' . ClienteModel::find($ticket->cliente_id)->email }}</span>
                                </div>
                                <div class="flex flex-col lg:flex-row ml-3 w-full">
                                    <strong class="w-1/3 mr-2 whitespace-nowrap">Estado del Ticket:</strong>
                                    <span
                                        class="w-2/3 dato-personal">{{ EstadoModel::find($ticket->estado_id)->nombre }}</span>
                                </div>
                                <div class="flex flex-col lg:flex-row ml-3 w-full">
                                    <strong class="w-1/3 mr-2 whitespace-nowrap">Creado en:</strong>
                                    <span
                                        class="w-2/3 dato-personal">{{ ' ' . $ticket->created_at->format('d/m/y H:i') }}</span>
                                </div>
                                <div class="flex flex-col lg:flex-row ml-3 w-full">
                                    <strong class="w-1/3 mr-2 whitespace-nowrap">Departamento Asignado:</strong>
                                    <span
                                        class="w-2/3 dato-personal">{{ ' ' . DepartamentoModel::find($ticket->departamento_id)->nombre }}</span>
                                </div>
                                <div class="flex flex-col lg:flex-row ml-3 w-full">
                                    <strong class="w-1/3 mr-2 whitespace-nowrap">Problema asociado a:</strong>
                                    <span
                                        class="w-2/3 dato-personal">{{ ' ' . TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}</span>
                                </div>
                            </div>
                        </div>
                        @if ($adjuntos->count() > 0)
                            <div class="mt-1 border-gray-300 rounded-md">
                                <h2 class="text-2xl font-bold mb-2">Archivos adjuntos</h2>
                                <div class="flex flex-col">
                                    @foreach ($adjuntos as $adjunto)
                                        @if ($adjunto->ticket_id == $ticket->id)
                                            <a href="{{ asset(AdjuntoModel::find($adjunto->adjunto_id)->path) }}"
                                                target="_blank"
                                                class="bg-gray-200 hover:bg-gray-300 rounded-md p-2 inline-block text-black"
                                                style="max-width: auto; margin-right: auto;">
                                                <span class="whitespace-nowrap">
                                                    {{ '• ' . AdjuntoModel::find($adjunto->adjunto_id)->nombre }}
                                                </span>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- Cuerpo del ticket -->
                        <div class="mt-4 p-3 lg:p-4 bg-gray-100 border border-gray-300 rounded-md">
                            <span class="py-1 px-2 text-xs bg-black text-white rounded-xl whitespace-nowrap"
                                style="max-width: auto !important;">
                                {{ ClienteModel::find($ticket->cliente_id)->email . ' ' . $ticket->created_at->format('d/m/y H:i') }}
                            </span>
                            <div class="text-sm text-gray-900 h-auto rendered-content mt-4">{!! $ticket->cuerpo !!}
                            </div>
                        </div>
                        <div>
                            @foreach ($ticket_response->get()->sortBy('created_at') as $response)
                                <!-- Cada contenedor de mensaje recibe la clase 'message' -->
                                <div class="message mt-2 p-3 lg:p-4 bg-gray-100 border border-gray-300 rounded-md"
                                    data-time="{{ $response->created_at->toIso8601String() }}">

                                    <!-- Aquí van los detalles del mensaje -->
                                    <span class="py-1 px-2 text-xs text-white rounded-xl whitespace-nowrap"
                                        style="max-width: auto !important; background-color: {{ is_numeric($response->personal_id) ? 'green' : 'black' }};">
                                        @if (is_numeric($response->personal_id))
                                            {{ User::find($response->personal_id)->email . ' ' . $response->created_at->format('d/m/y H:i') }}
                                        @else
                                            {{ $response->personal_id . ' ' . $response->created_at->format('d/m/y H:i') }}
                                        @endif
                                    </span>

                                    <div class="text-gray-900 h-auto mt-2 rendered-content">{!! $response->cuerpo !!}
                                        @foreach ($adjuntosResponse as $adjunto)
                                            @if ($adjunto->ticket_id == $response->id)
                                                <a href="{{ asset(AdjuntoModel::find($adjunto->adjunto_id)->path) }}"
                                                    target="_blank"
                                                    class="bg-gray-200 hover:bg-gray-300 rounded-md p-2 inline-block text-black"
                                                    style="max-width: auto; margin-right: auto;">
                                                    <span class="whitespace-nowrap">
                                                        {{ '• ' . AdjuntoModel::find($adjunto->adjunto_id)->nombre }}
                                                    </span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($ticket->estado_id != 4)
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <h2 class="text-2xl font-bold mb-2 mt-4">Responder</h2>
                                    <!-- Cambiar textarea por un div para Quill -->
                                    <x-texteditor></x-texteditor> <!-- id="editor" id-input="detalle" -->

                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="archivos">
                                        <i class="fas fa-paperclip mr-2"></i>Adjuntar archivos
                                    </label>
                                    <div class="flex items-center w-full">
                                        <label class="block w-full">
                                            <span class="sr-only">Choose files</span>
                                            <input type="file" name="files[]"
                                                class="block w-full border rounded-xl text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700"
                                                multiple>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row justify-between">
                                <div class="flex flex-col md:flex-row gap-2 justify-end w-full md:w-auto">
                                    <div class="flex justify-end space-x-4 w-full md:w-auto mb-2 md:mb-0">
                                        <button type="submit"
                                            class="btn btn-dark rounded-xl text-nowrap w-full md:w-auto py-2">
                                            <i class="fa-solid fa-paper-plane mr-2"></i>Enviar
                                        </button>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-2 justify-end w-full md:w-auto">
                                    @auth
                                        <div class="flex justify-end space-x-4 w-full md:w-auto mb-2 md:mb-0">
                                            <button type="button"
                                                class="btn btn-primary rounded-xl text-nowrap w-full md:w-auto"
                                                data-bs-toggle="modal" data-bs-target="#reassignModal">
                                                <i class="fa-solid fa-right-left mr-2"></i>Reasignar ticketera
                                            </button>
                                        </div>
                                        <div class="flex justify-end space-x-4 w-full md:w-auto mb-2 md:mb-0">
                                            <button type="button"
                                                class="btn btn-primary rounded-xl text-nowrap w-full md:w-auto"
                                                data-bs-toggle="modal" data-bs-target="#assignModal">
                                                <i class="fa-solid fa-arrow-right mr-2"></i>Asignar sub-area
                                            </button>
                                        </div>
                                        <div class="flex justify-end space-x-4 w-full md:w-auto mb-2 md:mb-0">
                                            <button type="button"
                                                class="btn btn-danger rounded-xl text-nowrap w-full md:w-auto"
                                                data-bs-toggle="modal" data-bs-target="#closeModal">
                                                <i class="fa-solid fa-clipboard-check mr-2"></i>Cerrar
                                            </button>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">¿Cerrar Ticket?</h5>
                        <p class="text-muted">Esta acción cerrara el ticket.</p>
                    </div>
                    <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body border-transparent">
                    <div class="py-2 px-3 text-red-600 d-flex align-items-center" role="alert"
                        style="border: solid #EF4444; border-radius: 8px; border-width: 1px; margin-top:-5%">
                        <i class="fa-solid fa-triangle-exclamation mr-2" style="color:#EF4444"></i>
                        <div>¿Estas seguro?</div>
                    </div>
                </div>
                <div class="modal-footer border-transparent">
                    <button type="button" class="btn"
                        style="border: solid gray; border-radius: 8px; border-width: 1px;"
                        data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('ticket.close') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ticket->id }}">
                        <button type="submit" id="submit_form" class="btn btn-danger"
                            style="border-radius: 8px !important">Cerrar ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reassignModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">Reasignar ticketera</h5>
                        <p class="text-muted">Esta acción reasignara el ticket a otra ticketera.</p>
                    </div>
                    <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body border-transparent">
                    <form action="{{ route('ticket.reassign') }}" method="POST">
                        @csrf
                        <select id="ticketera" name="ticketera_id" required
                            class="bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black-500 focus:border-black-500 block w-full p-2.5"
                            onchange="toggleProfessionalFields()">
                            <option selected disabled>Seleccione una ticketera</option>
                            @foreach ($ticketeras as $ticketera)
                                <option value="{{ $ticketera->id }}">{{ $ticketera->titulo }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer border-transparent">
                    <button type="button" class="btn"
                        style="border: solid gray; border-radius: 8px; border-width: 1px;"
                        data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                    <button type="submit" id="submit_form" class="btn btn-primary"
                        style="border-radius: 8px !important">Reasignar ticketera</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">Asignar sub-area</h5>
                        <p class="text-muted">Esta acción asignara el ticket a una sub-area.</p>
                    </div>
                    <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('ticket.reassign') }}" method="POST">
                    @csrf
                    <div class="modal-body border-transparent">
                        <select id="area" name="area_id" required
                            class="bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black-500 focus:border-black-500 block w-full p-2.5"
                            onchange="toggleProfessionalFields()">
                            <option selected disabled>Seleccione una area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer border-transparent">
                        <button type="button" class="btn"
                            style="border: solid gray; border-radius: 8px; border-width: 1px;"
                            data-bs-dismiss="modal">Cancelar</button>


                        <input type="hidden" name="id" value="{{ $ticket->id }}">
                        <button type="submit" id="submit_form" class="btn btn-primary"
                            style="border-radius: 8px !important">Asignar sub-area</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
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


            fetch(url)
                .then(response => response.json())
                .then(data => {

                    if (data.newMessages) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error("Error al verificar nuevos mensajes:", error);
                });
        }

        // Configura el polling cada 5 segundos
        setInterval(checkNewMessages, 5000);
    });

    document.querySelector('#form-ticket-response').addEventListener('submit', (event) => {
        localStorage.removeItem("editorContent");
    });


    // Recupera el contenido guardado en localStorage cuando la página se carga
    document.addEventListener("DOMContentLoaded", () => {
        const savedContent = localStorage.getItem("editorContent");
        if (savedContent) {
            quill.root.innerHTML = savedContent;
            document.querySelector('#detalle').value = savedContent;
        }
    });

    // Escucha los cambios en el editor y los guarda en localStorage
    quill.on('text-change', function() {
        const content = quill.root.innerHTML;
        document.querySelector('#detalle').value = content;
        localStorage.setItem("editorContent", content);
    });
</script>
