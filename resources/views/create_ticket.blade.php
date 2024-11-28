<script src="https://cdn.tailwindcss.com"></script>
<style>
    a {
        text-decoration: none !important;
    }

    .custom-scrollbar {
        max-height: 300px;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        /* Ancho de la barra de desplazamiento */
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        /* Color del pulgar de la barra de desplazamiento */
        border-radius: 10px;
        /* Radio de esquina del pulgar */
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
        /* Color de la pista de la barra de desplazamiento */
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

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .input-wrapper {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .input-wrapper button {
        width: auto;
        padding: 10px;
    }

    .error-message {
        display: none;
        color: red;
        margin: 2px;
    }

    /* Ajusta la altura y el tamaño del contenedor de Select2 */
    .select2-container .select2-selection--single {
        height: 38px !important;
        /* Ajusta según tus necesidades */
        line-height: 36px !important;
    }

    .select2-container .select2-selection--multiple {
        min-height: 38px !important;
        /* Para selects múltiples */
    }

    .select2-container {
        font-size: 16px !important;
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

        .radio-container {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            /* Espacio entre los elementos */
        }

        .radio-item {
            width: 100%;
        }

        personalizadoMeses {
            max-width: 100%;
        }
    }

    @media (min-width: 768px) {
        .radio-container {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            /* Espacio entre los elementos */
        }

        .radio-item {
            flex: 1;
        }

        personalizadoMeses {
            max-width: 50%;
        }
    }

    personalizadoMeses {
        display: none;
    }

    /* Controlador de tamaño en la esquina inferior derecha */
    .resize-handle {
        width: 10px;
        height: 10px;
        background: #ccc;
        position: absolute;
        right: 0;
        bottom: 0;
        cursor: se-resize;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ 'Ticketera ' . $data['titulo'] }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden" style="background-color: white">
                @if ($errors->any())
                    <x-error-alert :error="$errors"></x-error-alert>
                @endif

                <form action="{{ route('ticket.store') }}" class="p-8" method="post" id="ticket_form"
                    enctype="multipart/form-data">
                    <x-ticket-message :message="$data['detalle']"></x-ticket-message>
                    @csrf
                    <input type="hidden" name="ticketera_id" value="{{ $data['id'] }}">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="departamento">
                                <i class="fas fa-building mr-2"></i>Departamento
                            </label>

                            <x-dropdown-search placeholder="Seleccione un departamento" name="departamento_id"
                                id="departamento-id" :data="$departamentos" :uniqueId="uniqid()" />

                        </div>


                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="email">
                                <i class="fas fa-envelope mr-2"></i>Email
                            </label>
                            <input
                                class="appearance-none block w-full border border-gray-300 text-gray-700 rounded py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                id="email" type="email" name="email"
                                placeholder="nombre.apellido@hospital.uncu.edu.ar" required>
                        </div>
                    </div>
                    <!-- Asunto del ticket -->
                    <div class="flex flex-col lg:flex-row -mx-3 mb-6">
                        <div class="w-full lg:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="asunto">
                                <i class="fas fa-heading mr-2"></i>Asunto
                            </label>
                            <input name="asunto" maxlength="25"
                                class="appearance-none block border border-gray-300 text-gray-700 rounded py-2 px-3 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm w-full"
                                id="asunto" type="text" placeholder="Asunto del ticket (max. 25 caracteres)"
                                required>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="problema">
                                <i class="fas fa-exclamation-circle mr-2"></i>Tipo de Problema
                            </label>
                            <x-dropdown-simple :placeholder="'Seleccione un tipo de problema'" :name="'tipo_de_problema'" :id="'tipo_problema-id'" class="w-full"
                                :data="$tiposProblema" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="detalle">
                                <i class="fas fa-align-left mr-2"></i>Detalle
                            </label>
                            <!-- Cambiar textarea por un div para Quill -->
                            <x-texteditor :pretext="$data['pretext'] ?? ''"></x-texteditor>


                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="archivos">
                                <i class="fas fa-paperclip mr-2"></i>Archivos adjuntos
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

                    <div class="flex justify-end">
                        <button
                            class="btn-dark text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline transition duration-300 ease-in-out"
                            type="submit">
                            Crear Ticket
                        </button>
                    </div>

                </form>


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

    document.getElementById('ticket_form').onsubmit = function(e) {
        var content = quill.root.innerHTML.trim(); // Remueve espacios en blanco al inicio y final
        document.getElementById('detalle').value = content;

        if (!content || content === "<p><br></p>") { // Verifica si está vacío
            document.getElementById('detalle').value = null;
        }
    };
</script>
