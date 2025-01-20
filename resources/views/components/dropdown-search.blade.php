@props(['placeholder', 'name', 'id', 'data', 'uniqueId', 'search' => false])

@php
    // Si no se pasó un uniqueId, generamos uno automáticamente
    $uniqueId = $uniqueId ?? uniqid();
    // Intentamos obtener el valor anterior con old($name)
    $selectedValue = old($name);
    $selectedText = $selectedValue ? $data->firstWhere('id', $selectedValue)?->nombre : $placeholder;
@endphp

<div class="relative group">
    <button id="dropdown-button-{{ $uniqueId }}" type="button"
        class="inline-flex justify-between w-full px-4 py-2 text-gray-400 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
        <span id="selected-{{ $uniqueId }}" class="mr-2">{{ $selectedText }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"
            aria-hidden="true">
            <path fill-rule="evenodd"
                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>
    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $selectedValue }}">

    <div id="dropdown-menu-{{ $uniqueId }}"
        class="dropdown-menu absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 space-y-1 custom-scrollbar hidden"
        style="min-width: 100%; max-height: 500px; overflow-y: auto; overflow-x: hidden; z-index: 50;">

        <!-- Search input -->
        @if ($search)
            <input id="search-input-{{ $uniqueId }}" type="text"
                class="block w-full text-gray-800 border-b mx-2 border-gray-300 focus:outline-none sticky top-0 bg-white rounded-lg"
                placeholder="Buscar..." autocomplete="off" style="overflow-x: hidden; max-width: 97%;">
        @endif

        @foreach ($data as $tipo)
            <a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-gray-100 cursor-pointer"
                data-value="{{ $tipo->id }}"
                onclick="seleccionar('{{ $id }}', '{{ $tipo->id }}', '{{ $tipo->nombre }}', '{{ $uniqueId }}')">{{ $tipo->nombre }}</a>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si los eventos ya han sido registrados para este componente
        const uniqueId = '{{ $uniqueId }}';
        if (window[`dropdownInitialized_${uniqueId}`]) return;

        window[`dropdownInitialized_${uniqueId}`] = true; // Marca que los eventos ya fueron registrados para este componente

        const dropdownButton = document.getElementById(`dropdown-button-${uniqueId}`);
        const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
        const selectedSpan = document.getElementById(`selected-${uniqueId}`);

        dropdownButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevenir que el clic se propague y cierre el dropdown inmediatamente
            openDropdown(uniqueId);
        });

        // Cerrar dropdowns si se hace clic fuera de ellos
        document.addEventListener('click', (event) => {
            if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
                closeDropdown(uniqueId);
            }
        });

        // Función de búsqueda dentro del dropdown
        const searchInput = document.getElementById(`search-input-${uniqueId}`);
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                const items = dropdownMenu.querySelectorAll('.dropdown-item');

                items.forEach((item) => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }

        // Establecer el valor seleccionado al cargar
        const selectedValue = document.getElementById("{{ $id }}").value;
        if (selectedValue) {
            const selectedItem = dropdownMenu.querySelector(`.dropdown-item[data-value='${selectedValue}']`);
            if (selectedItem) {
                selectedSpan.textContent = selectedItem.textContent;
                selectedSpan.classList.remove('text-gray-400');
                selectedSpan.classList.add('text-black');
            }
        }
    });

    function openDropdown(uniqueId) {
        const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
        if (dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.remove('hidden');
            dropdownMenu.classList.add('show');
        } else {
            dropdownMenu.classList.remove('show');
            dropdownMenu.classList.add('hidden');
        }
    }

    function closeDropdown(uniqueId) {
        const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
        dropdownMenu.classList.remove('show');
        dropdownMenu.classList.add('hidden');
    }

    function seleccionar(hiddenInputId, id, text, uniqueId) {
        const selectedSpan = document.getElementById(`selected-${uniqueId}`);
        const hiddenInput = document.getElementById(hiddenInputId);

        selectedSpan.textContent = text;
        selectedSpan.classList.remove('text-gray-400');
        selectedSpan.classList.add('text-black');

        hiddenInput.value = id;

        // Cerrar el dropdown después de seleccionar
        closeDropdown(uniqueId);
    }
</script>
