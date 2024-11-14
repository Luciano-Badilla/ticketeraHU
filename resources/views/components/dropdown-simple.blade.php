@props(['placeholder', 'name', 'id', 'data', 'uniqueId'])

@php
    // Si no se pasó un uniqueId, generamos uno automáticamente
    $uniqueId = $uniqueId ?? uniqid();
@endphp

<div class="relative group">
    <button id="dropdown-button-{{ $uniqueId }}" type="button"
        class="inline-flex justify-between w-full px-4 py-2 text-gray-400 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
        <span id="selected-{{ $uniqueId }}" class="mr-2">{{ $placeholder }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"
            aria-hidden="true">
            <path fill-rule="evenodd"
                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>
    <input type="hidden" name="{{ $name }}" id="{{ $id }}">

    <div id="dropdown-menu-{{ $uniqueId }}"
        class="dropdown-menu absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 space-y-1 custom-scrollbar"
        style="min-width: 100%; max-height: 250px; overflow-y: auto; z-index: 50; display: none;">
        @foreach ($data as $tipo)
            <a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-gray-100 cursor-pointer"
                data-value="{{ $tipo->id }}"
                onclick="seleccionar('{{ $id }}', '{{ $tipo->id }}', '{{ $tipo->nombre }}', '{{ $uniqueId }}')">{{ $tipo->nombre }}</a>
        @endforeach
    </div>
</div>

<script>

    function openDropdown(uniqueId) {
        const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
        dropdownMenu.style.display = 'block';
    }

    function closeDropdown(uniqueId) {
        const dropdownMenu = document.getElementById(`dropdown-menu-${uniqueId}`);
        dropdownMenu.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButtons = document.querySelectorAll('[id^="dropdown-button-"]');

        dropdownButtons.forEach(button => {
            const uniqueId = button.id.split('-').pop();
            button.addEventListener('click', (event) => {
                event
                    .stopPropagation(); // Prevenir que el clic se propague y cierre el dropdown inmediatamente
                openDropdown(uniqueId);
            });
        });

        // Cerrar dropdowns si se hace clic fuera de ellos
        document.addEventListener('click', (event) => {
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');
            dropdownMenus.forEach(menu => {
                const button = document.getElementById(
                    `dropdown-button-${menu.id.split('-').pop()}`);
                // Verifica si el clic fue fuera de un dropdown y su botón
                if (!menu.contains(event.target) && !button.contains(event.target)) {
                    menu.style.display = 'none';
                }
            });
        });
    });

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
