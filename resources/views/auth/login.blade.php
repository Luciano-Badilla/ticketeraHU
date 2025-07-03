<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketera</title>
    <link rel="icon" href="{{ asset('images/hu_icon.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        crossorigin="anonymous">
</head>

<body>
    <x-guest-layout>
        <!-- Session Status -->
        @if (session('error'))
            <div class="alert-danger bg-transparent">
                <p style="padding: 0.3%; text-align: center">{{ session('error') }}</p>
            </div>
        @endif

        <div class="alert-danger bg-transparent hidden" id="emailError">
            <p style="padding: 0.3%; text-align: center">{{ session('error') }}</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" id="loginForm" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <br>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full h-10 p-2 shadow-sm border" type="email"
                    name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full h-10 p-2 shadow-sm border" type="password"
                    name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember" checked>
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <!-- Campo oculto para el ticketId -->
            <input type="hidden" id="ticket_id" name="ticket_id" value="">

            <!-- Botón para solicitar cambio de contraseña -->
                <div class="mt-1 text-left">
                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        data-bs-toggle="modal" data-bs-target="#addEmailModal">
                        Solicitar cambio de contraseña
                    </button>
                </div>
            
            <div class="flex justify-end">
                <div class="flex items-center justify-end">
                    <x-nav-link :href="route('guide.user_guide')" target="_blank"
                        class="btn btn-primary text-white h-8 mt-4 px-2 rounded flex items-center">
                        <i class="fa-solid fa-book mr-2"></i>
                        <p class="mt-1">MANUAL DE USUARIO</p>
                    </x-nav-link>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>
            </div>


        </form>



        <!-- Modal -->
        <div class="modal fade" id="addEmailModal" tabindex="-1" aria-labelledby="addEmailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="addEmailModalLabel">Solicitar cambio de contraseña</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('usuarios.requestPassword') }}" method="POST" id="addModal">
                            @csrf
                            <div class="mb-4">
                                <label for="addEmail" class="form-label text-dark fw-bold">Email:</label>

                                <input type="email" class="form-control border-gray-300 rounded shadow-sm"
                                    id="addEmail" name="addEmail" required>

                            </div>
                            @error('addEmail')
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <div>{{ $message }}</div>
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </button>
                        <button type="submit" form="addModal" class="btn btn-dark">
                            <i class="fa-solid fa-rotate me-1"></i>Solicitar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="selectTicketeraModal" tabindex="-1"
            aria-labelledby="selecctTicketeraModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="selecctTicketeraModalLabel">Seleccionar Ticketera</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body selectTicketeraModalBody">

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <template id="ticket-template">
            <a href="#"
                class="ticketera_id mb-2 btn-dark rounded-xl shadow-lg flex items-stretch transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl w-full md:w-[calc(50%-1rem)]">
                <div
                    class="bg-pastel-blue flex-shrink-0 flex flex-col items-center justify-center p-4 rounded-xl m-2 w-16 md:w-24 lg:w-40">
                    <i class="fa-solid ticket-icon text-3xl md:text-5xl text-white"></i>
                </div>
                <div class="flex-grow flex items-center py-2">
                    <div class="p-4 bg-white rounded-xl m-2 w-full h-full">
                        <h3 class="ticket-title font-semibold text-md md:text-lg text-gray-800 mb-2"></h3>
                        <p class="ticket-description text-xs md:text-sm text-gray-600"></p>
                    </div>
                </div>
            </a>
        </template>


        <div class="hidden">
            @foreach ($ticketeras as $ticketera)
                <div id="ticketera-{{ $ticketera->id }}" data-titulo="{{ $ticketera->titulo }}"
                    data-descripcion="{{ $ticketera->descripcion }}" data-icono="{{ $ticketera->icono }}">
                </div>
            @endforeach
        </div>
    </x-guest-layout>


</body>
<footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('#loginForm').on('submit', function(e) {
                    if ($('#ticket_id').val() == '') {
                        e.preventDefault(); // Evita el envío automático del formulario
                        var ticketId = $('#ticket_id')
                            .val(); // Obtenemos el ticketId del campo oculto
                        $.ajax({
                            url: '{{ route('login.check') }}', // Verifica la existencia de usuarios duplicados
                            method: 'POST',
                            data: $(this).serialize(), // Serializa los datos del formulario
                            success: function(response) {
                                if (response.duplicated) {
                                    var modalBody = $('.selectTicketeraModalBody');
                                    modalBody.empty(); // Limpiar el contenido del modal

                                    // Iteramos sobre los 'ticketeras' que vienen de la respuesta
                                    response.ticketeras.forEach(function(ticketId) {
                                        // Buscar el div con el id de la ticketera correspondiente
                                        var ticketeraElement = $('#ticketera-' +
                                            ticketId);

                                        // Obtener los datos de la ticketera
                                        var titulo = ticketeraElement.data(
                                            'titulo');
                                        var descripcion = ticketeraElement.data(
                                            'descripcion');
                                        var icono = ticketeraElement.data(
                                            'icono');

                                        // Crear un objeto para el ticket
                                        var ticket = {
                                            id: ticketId,
                                            titulo: titulo,
                                            descripcion: descripcion,
                                            icono: icono,
                                            pretext: 'Pretexto del ticket ' +
                                                ticketId // Este pretexto puede ser dinámico también
                                        };

                                        // Obtener el template de ticket
                                        var ticketTemplate = document
                                            .getElementById('ticket-template')
                                            .content.cloneNode(true);

                                        // Agregar el data-id al <a> que contiene el ticket
                                        var ticketLink = ticketTemplate
                                            .querySelector('a');
                                        ticketLink.setAttribute('data-id',
                                            ticket
                                            .id); // Añadimos el data-id

                                        // Modificar el contenido del template con los datos del ticket
                                        ticketTemplate.querySelector(
                                                '.ticket-icon')
                                            .classList.add(ticket
                                                .icono); // Agregar el ícono
                                        ticketTemplate.querySelector(
                                                '.ticket-title').textContent =
                                            ticket.titulo; // Título del ticket
                                        ticketTemplate.querySelector(
                                                '.ticket-description')
                                            .textContent =
                                            ticket
                                            .descripcion; // Descripción del ticket

                                        // Agregar el ticket generado al cuerpo del modal
                                        modalBody.append(ticketTemplate);
                                    });

                                    // Mostrar el modal
                                    var selectTicketeraModal = new bootstrap.Modal(
                                        document
                                        .getElementById('selectTicketeraModal'));
                                    selectTicketeraModal.show();
                                } else if (response.logged) {
                                    location.reload();
                                }
                            },
                            error: function(xhr) {
                                // Muestra el mensaje de error devuelto por el servidor
                                if (xhr.status === 401) {
                                    $('#emailError').text(xhr.responseJSON.error)
                                        .show();
                                    $('#changePassword').show();

                                }
                            }
                        });
                    }

                });

                // Delegar el evento de clic a los elementos dinámicamente creados
                $('.selectTicketeraModalBody').on('click', '.ticketera_id', function() {
                    var ticketId = $(this).data('id'); // Obtén el ID de la ticketera seleccionada

                    // Asigna el ticketId al campo oculto antes de enviar el formulario
                    $('#ticket_id').val(ticketId);

                    // Cierra el modal
                    $('#selectTicketeraModal').modal('hide');

                    // Envía el formulario
                    $('#loginForm').submit();
                });

            });

        });
    </script>
</footer>


</html>
