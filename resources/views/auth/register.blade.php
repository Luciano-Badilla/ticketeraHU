
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro Deshabilitado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <main class="max-w-md w-full text-center">
        <div class="text-4xl text-yellow-500 mb-4">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1 class="font-semibold text-xl text-gray-900 mb-2">Registro Deshabilitado</h1>
        <p class="text-gray-600 mb-6 text-sm leading-relaxed">
            Lo sentimos, el registro de nuevos usuarios se encuentra <br /> temporalmente deshabilitado.
        </p>
        <div class="border border-yellow-300 rounded-md bg-yellow-50 p-4 mb-6 text-left text-xs text-yellow-800">
            <div class="flex items-start mb-1">
                <i class="fas fa-exclamation-triangle mr-2 mt-[2px] text-xs"></i>
                <span class="font-semibold">Aviso Importante</span>
            </div>
            <p>
                El sistema de registro no está disponible en este momento.
                Por favor, contacte con el
                administrador.
            </p>
        </div>
        <a href="http://172.22.118.101:81/rrhh-relojbiometricoHU/public/login"
            class="w-full bg-gray-900 text-white px-3 text-xs font-semibold py-2 rounded-xl mb-2 hover:bg-gray-800 transition">
            Ir a Iniciar Sesión
        </a>
    </main>
</body>

</html>




    <?php
    /*

    use App\Models\DashboardTicketModel;
    
    $ticketeras = DashboardTicketModel::all();
    
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <x-guest-layout>
    
        <form method="POST" action="{{ route('register') }}">
            @csrf
    
            <div>
                <x-input-label for="name" :value="__('Nombre y Apellido')" />
                <x-text-input id="name" class="block mt-1 w-full h-10 p-2 border" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="rol" :value="__('Ticketera')" />
                <select id="ticketera" name="ticketera" required
                    class="mt-1 bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black-500 focus:border-black-500 block w-full p-2.5"
                    onchange="toggleProfessionalFields()">
                    <option selected disabled>Seleccione una ticketera</option>
                    @foreach ($ticketeras as $ticketera)
                        <option value="{{ $ticketera->id }}">{{ $ticketera->titulo }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('ticketera')" class="mt-2" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full h-10 p-2 border" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full h-10 p-2 border" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full h-10 p-2 border" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Ya esta registrado?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>
        </form>
    
        <div class="modal fade" id="matriculaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 8px !important">
                    <div class="modal-header border-transparent">
                    </div>
                    <div class="modal-body border-transparent">
                        <div class="py-2 px-3 text-yellow-600 d-flex align-items-center" role="alert"
                            style="border: solid #efc144; border-radius: 8px; border-width: 1px; margin-top:-5%">
                            <i class="fa-solid fa-triangle-exclamation mr-2" style="color:#efc144"></i>
                            <div>La matrícula es necesaria para la generación de pedidos médicos firmados electrónicamente.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-transparent">
                        <button type="button" class="btn close text-base p-1" data-dismiss="modal" aria-label="Close"
                            style="border: solid gray; border-radius: 8px; border-width: 1px;"
                            data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    
    </x-guest-layout>
    
    <script>
        function toggleProfessionalFields() {
            const rol = document.getElementById('rol').value;
            const matriculaContainer = document.getElementById('matricula-container');
            const especialidadContainer = document.getElementById('especialidad-container');
    
            if (rol === '3') {
                matriculaContainer.classList.remove('hidden');
                especialidadContainer.classList.remove('hidden');
                document.getElementById('matricula').setAttribute('required', true);
                document.getElementById('especialidad').setAttribute('required', true);
            } else {
                matriculaContainer.classList.add('hidden');
                especialidadContainer.classList.add('hidden');
                document.getElementById('matricula').removeAttribute('required');
                document.getElementById('especialidad').removeAttribute('required');
            }
        }
    </script>
    
*/
    ?>


    