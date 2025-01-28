<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="alert-success hidden alerta" id="success">
                    <p style="padding: 0.3%; text-align: center">Datos actualizados correctamente</p>
                </div>
                <div class="alert-danger hidden alerta" id="error">
                    <p style="padding: 0.3%; text-align: center">Error al actualizar los datos</p>
                </div>
                @if ($errors->any())
                    <div class="alert-danger alerta" style="text-align: center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert-success alerta">
                        <p style="padding: 0.3%; text-align: center">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert-warning alerta">
                        <p style="padding: 0.3%; text-align: center">{{ session('warning') }}</p>
                    </div>
                @endif
                <div class="rounded">
                    <div class="container mx-auto p-3">

                        <div class="listaEspecialidades grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($usuarios as $usuario)
                                @if ($usuario->validated == 1)
                                    <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col h-full"
                                        data-id="{{ $usuario->id }}">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-800">{{ $usuario->name_and_surname }}
                                                </h3>
                                                <p class="text-sm text-gray-600">{{ $usuario->email }}</p>
                                            </div>
                                            <div class="flex flex-col">

                                                <form action="{{ route('usuario.validate', $usuario->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-gray-800 text-white py-1 px-3 rounded-full text-xs hover:bg-gray-800">Invalidar</button>
                                                </form>
                                                <form action="{{ route('usuario.recibe_emails', $usuario->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-600 text-white py-1 px-3 rounded-full text-xs hover:bg-green-700 whitespace-nowrap">{{ $usuario->recibe_emails ? 'Desactivar mails' : 'Activar mails' }}</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="flex-grow -mt-10">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Rol</label>
                                                <select id="rol" name="rol" required
                                                    class="mt-1 bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black-500 focus:border-black-500 block w-full p-2.5">
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->id }}"
                                                            {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>
                                                            {{ $rol->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button {{ $usuario->requestsPassword == 0 ? 'disabled' : '' }}
                                                class="w-full py-2 px-4 rounded-md 
           {{ $usuario->requestsPassword == 0 ? 'bg-gray-400 text-gray-600 cursor-not-allowed' : 'bg-gray-800 text-white hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50' }}"
                                                data-bs-toggle="modal" data-bs-target="#addPasswordModal"
                                                data-id="{{ $usuario->id }}">
                                                Cambiar Contraseña
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>


                        <div class="listaEspecialidades grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">

                            @foreach ($usuarios as $usuario)
                                @if ($usuario->validated == 0)
                                    @php $invalidados = true; @endphp
                                    <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col h-full"
                                        data-id="{{ $usuario->id }}">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-800">
                                                    {{ $usuario->name_and_surname }}</h3>
                                                <p class="text-sm text-gray-600">{{ $usuario->email }}</p>
                                            </div>
                                            <div class="flex flex-col gap-1">
                                                <form action="{{ route('usuario.validate', $usuario->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-600 text-white py-1 px-3 rounded-full text-xs hover:bg-green-700 ml-3">Validar</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="space-y-3 flex-grow">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Rol</label>
                                                <select id="rol" name="rol" required readonly
                                                    class="mt-1 bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black-500 focus:border-black-500 block w-full p-2.5">
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->id }}"
                                                            {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>
                                                            {{ $rol->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="addPasswordModal" tabindex="-1" aria-labelledby="addPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addPasswordModalLabel">
                        Cambiar contraseña
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.password', $usuario->id) }}" method="POST" id="addModal">
                        @csrf
                        <input type="hidden" id="usuarioId" name="id" value="">
                        <div class="mb-4">
                            <label for="addPassword" class="form-label text-dark fw-bold">Nueva contraseña:</label>

                            <div class="flex items-stretch overflow-hidden rounded-md">
                                <span class="flex items-center px-3 bg-gray-300 text-gray-700">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                                <input type="password"
                                    class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-r-md"
                                    id="addPassword" name="addPassword" required>
                            </div>
                        </div>
                        @error('addPassword')
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
                        <i class="fa-solid fa-rotate me-1"></i>Cambiar
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Detectar cambios en especialidad, matricula y rol
        $('.listaEspecialidades').on('change', 'select, input', function() {
            let usuarioId = $(this).closest('.shadow-md').data('id'); // Obtener el ID del usuario
            let especialidadId = $(this).closest('.shadow-md').find('select[name="especialidad"]')
                .val();
            let matricula = $(this).closest('.shadow-md').find('input[name="matricula"]').val();
            let rolId = $(this).closest('.shadow-md').find('select[name="rol"]').val();

            // Construir la URL utilizando la ruta de Laravel
            let url = '{{ route('usuario.update', ':id') }}'; // Define la ruta
            url = url.replace(':id', usuarioId); // Reemplaza :id con el id del usuario

            // Enviar datos al servidor mediante AJAX
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    especialidad_id: especialidadId,
                    matricula: matricula,
                    rol_id: rolId
                },
                success: function(response) {
                    if (response.success) {
                        alerts("success");
                    } else {
                        alerts("error");
                    }
                },
                error: function() {
                    alerts("error");
                }
            });
        });

        $('#addPasswordModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var userId = button.data(
                'id'); // Extraer el ID del usuario del atributo data-* del botón

            // Actualizar el campo oculto con el ID del usuario
            var modal = $(this);
            modal.find('#usuarioId').val(userId);
        });
    });

    function alerts(alertName) {
        $('.alerta').hide();

        $("#" + alertName).css('display', 'block');
    }
</script>
