@php
    use App\Models\DashboardTicketModel;
    use App\Models\EstadoModel;
    use App\Models\TipoProblemaModel;
    use App\Models\DepartamentoModel;
    use App\Models\AreaModel;
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
                        <p style="padding: 0.3%; text-align: center">El ticket ha sido cerrado por
                            {{ User::find($ticket->cerrado_por)->name_and_surname . ' el ' . $ticket->updated_at->format('d/m/y H:i') }}
                        </p>
                    </div>
                @endif
                @if ($ticket->reopenMotivo != null)
                    <div class="alert-success rounded-t-lg">
                        <p style="padding: 0.3%; text-align: center">Ticket reabierto. Motivo:
                            {{ $ticket->reopenMotivo }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <x-error-alert :error="$errors"></x-error-alert>
                @endif

                <div class="alert-danger hidden rounded-t-xl" id="error_alert">
                    <p style="padding: 0.3%; text-align: center" id="error_message"></p>
                </div>
                <form action="{{ route('ticket.response') }}" class="p-8" method="post"
                    enctype="multipart/form-data" id="form-ticket-response">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <input type="hidden" name="reopenMotivo" id="reopenMotivo" required>
                    <div class="bg-white w-full">
                        <div class="mb-6 w-full">
                            <h2 class="text-2xl text-gray-700 font-bold mb-2">Información del Ticket</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold">Email del Cliente</label>
                                    <p class=" bg-gray-100 p-2 rounded-md whitespace-nowrap">
                                        {{ ClienteModel::find($ticket->cliente_id)->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Estado</label>
                                    <p class=" bg-gray-100 p-2 rounded-md whitespace-nowrap">
                                        {{ EstadoModel::find($ticket->estado_id)->nombre }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Fecha</label>
                                    <p class=" bg-gray-100 p-2 rounded-md whitespace-nowrap">
                                        {{ $ticket->created_at->format('d/m/y H:i') }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Departamento</label>
                                    <p class=" bg-gray-100 p-2 rounded-md whitespace-nowrap">
                                        {{ DepartamentoModel::find($ticket->departamento_id)->nombre }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Sub área</label>
                                    <p class=" bg-gray-100 p-2 rounded-md whitespace-nowrap">
                                        {{ AreaModel::find($ticket->area_id)->nombre ?? 'Sub área no asignada' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Problema asociado a</label>
                                    <p class=" bg-gray-100 p-2 rounded-md whitespace-nowrap">
                                        {{ TipoProblemaModel::find($ticket->tipo_problema_id)->nombre }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($adjuntos->count() > 0)
                            <div class="mt-1 border-gray-300 rounded-md">
                                <h2 class="text-2xl text-gray-700 font-bold mb-2">Archivos adjuntos</h2>
                                <div class="flex flex-col">
                                    @foreach ($adjuntos as $adjunto)
                                        @if ($adjunto->ticket_id == $ticket->id)
                                            @php
                                                $adjunto = AdjuntoModel::find($adjunto->adjunto_id);
                                                $extension = pathinfo($adjunto->path, PATHINFO_EXTENSION);
                                                $iconMap = [
                                                    'txt' => ['icon' => 'fa-file-alt', 'color' => 'text-blue-500'],
                                                    'pdf' => ['icon' => 'fa-file-pdf', 'color' => 'text-red-500'],
                                                    'jpg' => ['icon' => 'fa-file-image', 'color' => 'text-yellow-500'],
                                                    'png' => ['icon' => 'fa-file-image', 'color' => 'text-green-500'],
                                                    'doc' => ['icon' => 'fa-file-word', 'color' => 'text-blue-700'],
                                                    'docx' => ['icon' => 'fa-file-word', 'color' => 'text-blue-700'],
                                                    'xlsx' => ['icon' => 'fa-file-excel', 'color' => 'text-green-700'],
                                                    'default' => ['icon' => 'fa-file', 'color' => 'text-gray-500'],
                                                ];
                                                $icon = $iconMap[$extension]['icon'] ?? $iconMap['default']['icon'];
                                                $color = $iconMap[$extension]['color'] ?? $iconMap['default']['color'];
                                            @endphp

                                            <a href="{{ asset($adjunto->path) }}"
                                                @if ($extension === 'txt') download @else target="_blank" @endif
                                                class="bg-gray-100 hover:bg-gray-200 rounded-md p-2 mt-1 inline-flex items-center text-black"
                                                style="max-width: auto; margin-right: auto;">
                                                <i class="fas {{ $icon }} {{ $color }} mr-2 h-6"></i>
                                                <span class="whitespace-nowrap">
                                                    {{ $adjunto->nombre }}
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
                            <div class="text-sm text-gray-900 h-auto mt-4">
                                <div class="text-sm text-gray-900 h-auto mt-4 response-container">
                                    {!! $ticket->cuerpo !!}
                                </div>
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

                                    <div class="text-gray-900 h-auto mt-2 rendered-content">
                                        <div
                                            class="text-sm text-gray-900 h-auto rendered-content mt-4 response-container">
                                            {!! $response->cuerpo !!}
                                        </div>
                                        @foreach ($adjuntosResponse as $adjunto)
                                            @if ($adjunto->ticket_id == $response->id)
                                                @php
                                                    $adjunto = AdjuntoModel::find($adjunto->adjunto_id);
                                                    $extension = pathinfo($adjunto->path, PATHINFO_EXTENSION);
                                                    $iconMap = [
                                                        'txt' => ['icon' => 'fa-file-alt', 'color' => 'text-blue-500'],
                                                        'pdf' => ['icon' => 'fa-file-pdf', 'color' => 'text-red-500'],
                                                        'jpg' => [
                                                            'icon' => 'fa-file-image',
                                                            'color' => 'text-yellow-500',
                                                        ],
                                                        'png' => [
                                                            'icon' => 'fa-file-image',
                                                            'color' => 'text-green-500',
                                                        ],
                                                        'doc' => ['icon' => 'fa-file-word', 'color' => 'text-blue-700'],
                                                        'docx' => [
                                                            'icon' => 'fa-file-word',
                                                            'color' => 'text-blue-700',
                                                        ],
                                                        'xlsx' => [
                                                            'icon' => 'fa-file-excel',
                                                            'color' => 'text-green-700',
                                                        ],
                                                        'default' => ['icon' => 'fa-file', 'color' => 'text-gray-500'],
                                                    ];
                                                    $icon = $iconMap[$extension]['icon'] ?? $iconMap['default']['icon'];
                                                    $color =
                                                        $iconMap[$extension]['color'] ?? $iconMap['default']['color'];
                                                @endphp

                                                <a href="{{ asset($adjunto->path) }}"
                                                    @if ($extension === 'txt') download @else target="_blank" @endif
                                                    class="bg-gray-200 hover:bg-gray-300 rounded-md p-2 inline-flex items-center text-black mt-1"
                                                    style="max-width: auto; margin-right: auto;">
                                                    <i
                                                        class="fas {{ $icon }} {{ $color }} mr-2 h-6"></i>
                                                    <span class="whitespace-nowrap">
                                                        {{ $adjunto->nombre }}
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
                                    <h2 class="text-2xl text-gray-700 font-bold mb-2 mt-4">Responder</h2>
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
                                            <input type="file" id="fileInput" name="files[]"
                                                class="block w-full border rounded-xl text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700"
                                                multiple>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Lista de archivos seleccionados -->
                            <ul id="fileList" class="px-3 -mt-5 w-1/2">
                                <!-- Los archivos seleccionados aparecerán aquí -->
                            </ul>
                            <div class="flex flex-col md:flex-row justify-between">
                                <div class="flex flex-col md:flex-row gap-2 justify-end w-full md:w-auto">
                                    @auth
                                    @if ($ticket->ticketera()->first()->id == Auth::user()->ticketera_id)
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
                                        <div class="flex justify-end space-x-3 w-full md:w-auto mb-2 md:mb-0">
                                           
                                            @if ($ticket->estado_id == 5)
                                                
                                                <button type="button"
                                                    class="btn btn-danger rounded-xl text-nowrap w-full md:w-auto flex flex-row"
                                                    id="send_answer_close" data-bs-toggle="modal"
                                                    data-bs-target="#unstopModal">
                                                    <i class="fa-solid fa-circle-stop mr-2 mt-1"></i>Reanudar ticket
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-danger rounded-xl text-nowrap w-full md:w-auto flex flex-row"
                                                    id="send_answer_close" data-bs-toggle="modal"
                                                    data-bs-target="#stopModal">
                                                    <i class="fa-solid fa-circle-stop mr-2 mt-1"></i>Detener ticket
                                                </button>
                                            @endif
                                            
                                            <button type="button"
                                                class="btn btn-danger rounded-xl text-nowrap w-full md:w-auto flex flex-row"
                                                id="send_answer_close" data-bs-toggle="modal"
                                                data-bs-target="#closeModal">
                                                <i class="fa-solid fa-clipboard-check mr-2 mt-1"></i><p id="close-btn-text">Cerrar</p>
                                            </button>
                                            
                                        </div>@endif
                                    @endauth
                                </div>
                                <div class="flex flex-col md:flex-row gap-2 justify-end w-full md:w-auto">
                                    <div class="flex justify-end space-x-4 w-full md:w-auto mb-2 md:mb-0">
                                        <button type="submit" id="send_answer"
                                            class="btn btn-dark rounded-xl text-nowrap w-full md:w-auto py-2">
                                            <i class="fa-solid fa-paper-plane mr-2"></i>Enviar respuesta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($ticket->estado_id == 4)
                            <div class="flex justify-end space-x-4 w-full md:w-auto mt-4 md:mb-0">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#reopenModal"
                                    class="btn btn-success rounded-xl text-nowrap w-full md:w-auto py-2">
                                    <i class="fa-solid fa-unlock mr-1"></i>Reabrir ticket
                                </button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reopenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">¿Reabrir Ticket?</h5>
                        <p class="text-muted">Esta acción abrira nuevamente el ticket.</p>
                    </div>
                    <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body border-transparent">
                    <div class="py-2 d-flex align-items-center" role="alert" style="margin-top:-5%">
                        <div class="w-full">
                            <label for="reopenMotivo">Motivo:
                            </label>
                            <input maxlength="50"
                                class="appearance-none block border border-gray-300 text-gray-700 rounded py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm w-full"
                                id="reopenMotivo_placeholder" type="text"
                                placeholder="Motivo (max. 50 caracteres)" value="{{ old('reopenMotivo') }}" required>
                            <span id="error-message-reopen" class="text-red-500 text-xs mt-4 hidden">
                                Debe rellenar el motivo del ticket para reabrirlo.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-transparent">
                    <button type="button" class="btn"
                        style="border: solid gray; border-radius: 8px; border-width: 1px;"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="reopen_btn" class="btn btn-success"
                        data-action="{{ route('ticket.reopen') }}" style="border-radius: 8px !important">Reabrir
                        ticket</button>

                </div>
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
                    <button type="submit" id="close_btn" class="btn btn-danger"
                        data-action="{{ route('ticket.close') }}" style="border-radius: 8px !important">Cerrar
                        ticket</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stopModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">Detener Ticket?</h5>
                        <p class="text-muted">Esta acción detendra el ticket.</p>
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
                    <button type="submit" id="stop_btn" class="btn btn-danger"
                        data-action="{{ route('ticket.stop') }}" style="border-radius: 8px !important">Detener
                        ticket</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="unstopModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">Reanudar Ticket?</h5>
                        <p class="text-muted">Esta acción enviara el ticket a pendientes.</p>
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
                    <button type="submit" id="unstop_btn" class="btn btn-danger"
                        data-action="{{ route('ticket.unstop') }}" style="border-radius: 8px !important">Reanudar
                        ticket</button>
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
</x-app-layout>
<!-- Incluye el CSS de Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluye el JavaScript de Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    let selectedFiles = [];

    if (fileInput) {
        // Función para manejar los archivos seleccionados
        fileInput.addEventListener('change', (event) => {
            for (const file of event.target.files) {
                if (!selectedFiles.includes(file)) {
                    selectedFiles.push(file);
                }
            }
            updateFileList();
        });
    }

    // Función para actualizar el input con los archivos seleccionados
    function updateFileList() {
        fileList.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const li = document.createElement('li');
            li.classList.add('flex', 'justify-between', 'items-center', 'mb-2', 'space-x-2',
                'hover:bg-gray-100', 'py-1', 'px-2', 'rounded-xl');

            const fileName = document.createElement('span');
            fileName.textContent = file.name;
            li.appendChild(fileName);

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '<i class="fa-solid fa-trash text-red-500"></i>';
            removeButton.classList.add('text-red-500', 'hover:text-red-700', 'focus:outline-none');
            removeButton.onclick = () => removeFile(index);

            li.appendChild(removeButton);
            fileList.appendChild(li);
        });

        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        fileInput.files = dataTransfer.files;
    }

    // Función para eliminar un archivo de la lista
    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateFileList();
    }

    function custom_alert(message) {
        const error_alert = document.getElementById('error_alert');
        error_alert.classList.remove('hidden');
        const error_message = document.getElementById('error_message');
        error_message.textContent = message;
    }

    document.getElementById('form-ticket-response').onsubmit = function(e) {
        $('#send_answer_close').attr('disabled', 'disabled');
        $('#send_answer').attr('disabled', 'disabled');

        var content = document.getElementById('detalle').value.trim(); // Elimina espacios en blanco

        if (content === "") { // Verifica si está vacío
            e.preventDefault(); // Evita el envío del formulario

            custom_alert("La respuesta no puede estar vacía"); // Muestra el mensaje de alerta

            // Habilita nuevamente los botones
            $('#send_answer_close').removeAttr('disabled');
            $('#send_answer').removeAttr('disabled');

            // Hace scroll hacia arriba
            $("html, body").animate({
                scrollTop: 0
            }, "slow");

            return false; // Refuerza la prevención del envío
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

        document.querySelectorAll('.response-container').forEach(response => {
            let quill = new Quill(response, {
                readOnly: true
            });

            // Esperar a que Quill cargue completamente

            let editor = response.querySelector('.ql-editor');

            // Eliminar alturas predefinidas y ajustar automáticamente
            response.style.height = 'auto';
            response.style.minHeight = 'auto';
            editor.style.height = 'auto';
            editor.style.minHeight = 'auto';

            // Ajustar altura al contenido
            response.style.height = editor.scrollHeight + 'px';
            // Pequeño retraso para asegurar que se renderiza correctamente
        });
    });

    const closeButton = document.getElementById('close_btn');
    // Cambiar acción y enviar el formulario al hacer clic en "Cerrar ticket"
    closeButton.addEventListener('click', function() {
        const form = document.getElementById('form-ticket-response');

        const action = this.getAttribute('data-action'); // Obtener la ruta del botón
        form.setAttribute('action', action); // Cambiar la acción del formulario
        form.submit(); // Enviar el formulario
    });



    const reopenButton = document.getElementById('reopen_btn');
    // Cambiar acción y enviar el formulario al hacer clic en "Cerrar ticket"
    reopenButton.addEventListener('click', function() {
        const form = document.getElementById('form-ticket-response');
        const motivo_placeholder = document.getElementById('reopenMotivo_placeholder').value;
        const motivo_input = document.getElementById('reopenMotivo');

        const action = this.getAttribute('data-action'); // Obtener la ruta del botón
        if (motivo_placeholder) {
            motivo_input.value = motivo_placeholder;
            form.setAttribute('action', action); // Cambiar la acción del formulario
            form.submit(); // Enviar el formulario
        } else {
            $('#error-message-reopen').removeClass('hidden');
        }
    });

    const stopButton = document.getElementById('stop_btn');
    // Cambiar acción y enviar el formulario al hacer clic en "Cerrar ticket"
    stopButton.addEventListener('click', function() {
        const form = document.getElementById('form-ticket-response');

        const action = this.getAttribute('data-action'); // Obtener la ruta del botón
        form.setAttribute('action', action); // Cambiar la acción del formulario
        form.submit(); // Enviar el formulario
    });

    const unstopButton = document.getElementById('unstop_btn');
    // Cambiar acción y enviar el formulario al hacer clic en "Cerrar ticket"
    unstopButton.addEventListener('click', function() {
        const form = document.getElementById('form-ticket-response');

        const action = this.getAttribute('data-action'); // Obtener la ruta del botón
        form.setAttribute('action', action); // Cambiar la acción del formulario
        form.submit(); // Enviar el formulario
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Esperar un poco para asegurarse de que Quill ya esté inicializado
        setTimeout(() => {
            if (typeof quill !== 'undefined') {
                const closeBtnText = document.getElementById('close-btn-text');
                if (closeBtnText) {
                    function updateCloseButtonText() {
                        const plainText = quill.getText().trim();
                        closeBtnText.textContent = plainText.length > 0
                            ? 'Enviar respuesta y cerrar'
                            : 'Cerrar';
                    }

                    // Llamar inicialmente por si ya hay texto
                    updateCloseButtonText();

                    // Escuchar cambios en el texto
                    quill.on('text-change', updateCloseButtonText);
                }
            }
        }, 100); // Le da un momento al DOM para asegurar que todo esté montado
    });
</script>
