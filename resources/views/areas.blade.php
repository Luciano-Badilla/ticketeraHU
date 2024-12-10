<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addDepartamentoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('area.store') }}" method="POST">
                @csrf
                <div class="modal-content" style="border-radius: 8px !important">
                    <div class="modal-header border-transparent">
                        <div class="flex flex-col">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva area</h5>
                            <p class="text-muted">Esta acción agregara una area a la lista.</p>
                        </div>
                        <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-transparent">
                        <div class="flex items-stretch overflow-hidden rounded-md">
                            <span class="flex items-center px-3 bg-gray-300 text-gray-700">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input type="text"
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-r-md"
                                id="addNombre" name="nombre" required placeholder="Nombre de la area">
                        </div>
                        <div class="w-full flex flex-row mt-2">
                            <input type="text"
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-md w-full"
                                id="addIcon" name="icon"
                                placeholder="Icono: (Ej: clock, code, user, etc)">
                            <button class="ml-2 rounded-none rounded-r-md" type="button" data-bs-toggle="modal"
                                data-bs-target="#infoModal">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editAreaModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('area.edit') }}" method="POST">
                @csrf
                <div class="modal-content" style="border-radius: 8px !important">
                    <div class="modal-header border-transparent">
                        <div class="flex flex-col">
                            <h5 class="modal-title" id="exampleModalLabel">Editar area</h5>
                            <p class="text-muted">Esta acción editara una area de la lista.</p>
                        </div>
                        <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-transparent">
                        <div class="flex items-stretch overflow-hidden rounded-md">
                            <span class="flex items-center px-3 bg-gray-300 text-gray-700">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input type="text"
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-r-md"
                                id="editNombre" name="nombre" required placeholder="Nombre de la area">
                            <input type="hidden" id="editId" name="id" value="">
                        </div>
                        <div class="w-full flex">
                            <input type="text"
                                class="flex-1 px-3 py-2 focus:outline-none focus:ring-0 border-gray-300 rounded-md w-full mt-2"
                                id="EditIcon" name="icon"
                                placeholder="Icono: (Ej: clock, code, user, etc)">
                            <button class="ml-2 rounded-none rounded-r-md" type="button" data-bs-toggle="modal"
                                data-bs-target="#infoModal">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                        </div>

                    </div>
                    <div class="modal-footer border-transparent">
                        <button type="button" class="btn"
                            style="border: solid gray; border-radius: 8px; border-width: 1px;"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"
                            style="border-radius: 8px !important">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px !important">
                <div class="modal-header border-transparent">
                    <div class="flex flex-col">
                        <h5 class="modal-title" id="exampleModalLabel">Como agregar un icono?</h5>
                    </div>
                    <button type="button" class="btn-close text-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body border-transparent">
                    <div>
                        <p>Para agregar un icono, debes seguir los siguientes pasos:</p>
                        <ol>
                            <li> • Busca el icono en <a href="https://fontawesome.com/v6/search?o=r&m=free"
                                    target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center px-2 py-1 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition-colors duration-200">
                                    <i class="fas fa-font mr-2"></i>
                                    Ir a Font Awesome
                                </a></li>
                            <li> • Copia el nombre del icono que quieras agregar (Ej: house, user, facebook, etc)</li>
                            <li> • Pega el nombre en el campo de texto "Icono" en el formulario</li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer border-transparent">
                    <button type="button" class="btn btn-success" style="border-radius: 8px; border-width: 1px;"
                        data-bs-dismiss="modal">Entendido</button>
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
                        <input type="text" class="form-control border-gray-300 rounded-l-md w-full"
                            id="searchInput" placeholder="Buscar por nombre" onkeyup="filterTable()" />
                        <button class="btn btn-dark rounded-none rounded-r-md" type="button" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Icono</th>
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left"></th>
                            </tr>
                        </thead>
                        <tbody id="departmentList" class="text-gray-600 text-sm font-light">
                            @foreach ($areas as $area)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left text-md"><i
                                            class="fa-solid {{ $area->icon }} text-gray-600"></i></td>
                                    <td class="py-3 px-6 text-left text-md">{{ $area->nombre }}</td>
                                    <td class="py-3 px-6 text-left text-md">
                                        <span class="rounded-lg flex justify-end">
                                            <button class="bg-transparent border-none" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $area->id }}"
                                                data-nombre="{{ $area->nombre }}" data-icon="{{ $area->icon }}">
                                                <i class="fa-solid fa-pen text-gray-600"></i>
                                            </button>
                                        </span>
                                    </td>
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
    const editModal = document.getElementById('editModal');
    const addModal = document.getElementById('addModal');
    const infoModal = document.getElementById('infoModal');

    // Variables para controlar el modal padre
    let parentModal = null;

    // Manejar la apertura del modal de edición
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        let icono = button.getAttribute('data-icon');

        document.getElementById('editId').value = id;
        document.getElementById('editNombre').value = nombre;
        icono = icono.replace("fa-", ""); // Reemplaza "fa-" por una cadena vacía
        document.getElementById('EditIcon').value = icono; // Asigna el nuevo valor

        parentModal = null; // Reiniciar referencia al modal padre
    });

    // Manejar la apertura del modal de adición
    addModal.addEventListener('show.bs.modal', function() {
        parentModal = null; // Reiniciar referencia al modal padre
    });

    // Manejar la apertura del modal de información desde otro modal
    infoModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        parentModal = button.closest('.modal'); // Guardar referencia al modal padre
        if (parentModal) {
            bootstrap.Modal.getInstance(parentModal).hide(); // Ocultar el modal padre
        }
    });

    // Manejar el cierre del modal de información y reabrir el modal padre
    infoModal.addEventListener('hidden.bs.modal', function() {
        if (parentModal) {
            bootstrap.Modal.getInstance(parentModal).show(); // Reabrir el modal padre
            parentModal = null; // Limpiar la referencia después de reabrir
        }
    });

    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const tableBody = document.getElementById('departmentList');
        const rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cell = rows[i].getElementsByTagName('td')[1]; // Segunda columna (Nombre)
            if (cell) {
                const textValue = cell.textContent || cell.innerText;
                rows[i].style.display = textValue.toLowerCase().includes(filter) ? '' : 'none';
            }
        }
    }
</script>
