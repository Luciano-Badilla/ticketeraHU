@props(['placeholder', 'name', 'id', 'data', 'uniqueId'])

@php
    // Generar un identificador único si no se proporcionó
    $uniqueId = $uniqueId ?? uniqid();
@endphp

<div class="relative">
    <!-- Botón que despliega el menú -->
    <button id="dropdown-button-{{ $uniqueId }}" type="button"
        class="inline-flex justify-between w-full px-4 py-2 text-gray-400 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <span id="selected-{{ $uniqueId }}" class="mr-2">{{ $placeholder }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"
            aria-hidden="true">
            <path fill-rule="evenodd"
                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <!-- Campo oculto que almacena el valor seleccionado -->
    <input type="hidden" name="{{ $name }}" id="{{ $id }}">

    <!-- Menú desplegable -->
    <div id="dropdown-menu-{{ $uniqueId }}"
        class="absolute right-0 z-50 mt-2 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto hidden">
        @foreach ($data as $item)
            <div class="cursor-pointer px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="{{ $item->id }}"
                onclick="selectDropdownItem('{{ $id }}', '{{ $item->id }}', '{{ $item->nombre }}', '{{ $uniqueId }}')">
                {{ $item->nombre }}
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdownButtons = document.querySelectorAll('[id^="dropdown-button-"]');

        dropdownButtons.forEach(button => {
            const uniqueId = button.id.split('-').pop();
            const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);

            // Mostrar/Ocultar el menú al hacer clic en el botón
            button.addEventListener('click', (event) => {
                event.stopPropagation(); // Evitar cierre inmediato
                toggleDropdown(uniqueId);
            });

            // Cerrar el menú al hacer clic fuera
            document.addEventListener('click', () => {
                closeDropdown(uniqueId);
            });

            dropdownMenu.addEventListener('click', (event) => {
                event.stopPropagation(); // Evitar cierre al hacer clic en un elemento del menú
            });
        });
    });

    function toggleDropdown(uniqueId) {
        const menu = document.getElementById(`dropdown-menu-${uniqueId}`);
        menu.classList.toggle('hidden');
    }

    function openDropdown(uniqueId) {
        if (uniqueId) {
            const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
            dropdownMenu.classList.remove('hidden');
            dropdownMenu.classList.add('show');
        }
    }

    function closeDropdown(uniqueId) {
        if (uniqueId) {
            const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
            dropdownMenu.classList.remove('show');
            dropdownMenu.classList.add('hidden');
        }
    }


    function selectDropdownItem(hiddenInputId, value, text, uniqueId) {
        const selectedSpan = document.getElementById(`selected-${uniqueId}`);
        const hiddenInput = document.getElementById(hiddenInputId);

        // Actualizar el texto del botón y el valor oculto
        selectedSpan.textContent = text;
        selectedSpan.classList.remove('text-gray-400');
        selectedSpan.classList.add('text-black');
        hiddenInput.value = value;

        // Cerrar el menú
        closeDropdown(uniqueId);
    }
</script>
