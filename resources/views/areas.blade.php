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
                            </tr>
                        </thead>
                        <tbody id="departmentList" class="text-gray-600 text-sm font-light">
                            @foreach ($areas as $area)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left text-md">{{ $area->nombre }}</td>
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
    const addExamenModal = document.getElementById('addExamenModal');
    addExamenModal.addEventListener('show.bs.modal', function(event) {
        // Botón que activó el modal
        const button = event.relatedTarget;
        // Extrae el data-id del botón
        const especialidadId = button.getAttribute('data-id');
        // Asigna el valor al campo oculto en el modal
        const inputEspecialidadId = document.getElementById('especialidadId');
        inputEspecialidadId.value = especialidadId;
    });

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
</script>