<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addDepartamentoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('cliente.store') }}" method="POST">
                @csrf
                <div class="modal-content" style="border-radius: 8px !important">
                    <div class="modal-header border-transparent">
                        <div class="flex flex-col">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo correo institucional</h5>
                            <p class="text-muted">Esta acción agregara un correo institucional a la lista.</p>
                        </div>
                        <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-transparent flex flex-col gap-3">
                        <div class="flex items-stretch overflow-hidden gap-1">
                            <input type="text"
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-md"
                                id="addNombre" name="nombre" required placeholder="Nombre">
                            <input type="text"
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-md"
                                id="addApellido" name="apellido" required placeholder="Apellido">
                        </div>
                        <div class="w-full">
                            <input
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-md w-full"
                                id="email" type="text" name="email" placeholder="Email institucional" required>
                            <p class="text-gray-500 text-sm mt-1">Luego del apellido se agregará automáticamente
                                <strong>@hospital.uncu.edu.ar</strong>
                            </p>
                            <span id="error-message" class="text-red-500 text-xs mt-1 hidden">
                                El email debe tener el formato nombre.apellido.
                            </span>

                        </div>

                    </div>
                    <div class="modal-footer border-transparent">
                        <button type="button" class="btn"
                            style="border: solid gray; border-radius: 8px; border-width: 1px;"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"
                            style="border-radius: 8px !important">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert-danger" style="text-align: center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert-success">
                        <p style="padding: 0.3%; text-align: center">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert-warning">
                        <p style="padding: 0.3%; text-align: center">{{ session('warning') }}</p>
                    </div>
                @endif
                <div class="p-3 rounded items-center justify-center">
                    <div class="flex items-stretch overflow-hidden mb-3 w-full rounded-md lg:w-1/4">
                        <input type="text" class="form-control border-gray-300 rounded-l-md w-full" id="searchInput"
                            placeholder="Buscar por nombre" onkeyup="filterTable()" />
                        <button class="btn btn-dark rounded-none rounded-r-md" type="button" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Email</th>
                            </tr>
                        </thead>
                        <tbody id="departmentList" class="text-gray-600 text-sm font-light">
                            @foreach ($clientes as $cliente)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left text-md">
                                        {{ $cliente->name . ' ' . $cliente->surname }}</td>
                                    <td class="py-3 px-6 text-left text-md">{{ $cliente->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>

<script>
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const tableBody = document.getElementById('departmentList');
        const rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cell = rows[i].getElementsByTagName('td')[0]; // Primera columna (Nombre)
            if (cell) {
                const textValue = cell.textContent || cell.innerText;
                rows[i].style.display = textValue.toLowerCase().includes(filter) ? '' : 'none';
            }
        }
    }

    const emailInput = document.getElementById("email");
    const errorMessage = document.getElementById("error-message");
    const domain = "@hospital.uncu.edu.ar";

    emailInput.addEventListener("input", function() {
        validateEmail();
    });

    emailInput.addEventListener("blur", function() {
        const value = emailInput.value.trim();

        // Si el dominio falta, lo agrega al perder el foco
        if (!value.endsWith(domain)) {
            const parts = value.split("@")[0];
            emailInput.value = parts + domain;
        }
    });

    document.getElementById('ticket_form').onsubmit = function(e) {
        if (!validateEmail()) {
            e.preventDefault();
            custom_alert("El email debe tener el formato nombre.apellido@hospital.uncu.edu.ar");
            scrollToError();
            return;
        }
        var content = quill.root.innerHTML.trim(); // Remueve espacios en blanco al inicio y final
        document.getElementById('detalle').value = content;

        if (!content || content === "<p><br></p>") { // Verifica si está vacío
            document.getElementById('detalle').value = null;
        }
    };

    function validateEmail() {
        const emailInput = document.getElementById("email");
        const errorMessage = document.getElementById("error-message");
        const domain = "@hospital.uncu.edu.ar";
        let value = emailInput.value;

        // Verificar si el campo ya contiene el dominio
        const hasDomain = value.includes(domain);
        const localPart = hasDomain ? value.split(domain)[0] : value;
        // Validar si el formato antes del dominio es válido
        const regex =
            /^[a-zñáéíóúü]+(\.[a-zñáéíóúü]+)?$/i; // Permite "nombre" o "nombre.apellido"
        if (regex.test(localPart) && localPart.includes('.')) {
            errorMessage.classList.add("hidden");

            // Agregar el dominio si no está presente
            if (!hasDomain) {
                emailInput.value = localPart + domain;
                // Restaurar la posición del cursor
                const cursorPosition = localPart.length;
                emailInput.setSelectionRange(cursorPosition, cursorPosition);
            }
            return true;
        } else {
            // Mostrar el error si el formato no es válido
            errorMessage.classList.remove("hidden");

            // Eliminar el dominio si el formato es incorrecto
            if (hasDomain) {
                emailInput.value = localPart;
            }
            return false;
        }
    }
</script>
