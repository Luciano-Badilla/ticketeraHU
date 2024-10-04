<style>
    .hu_icon {
        width: 30%;
    }

    /* Personaliza los enlaces en la barra de navegación */
    .nav-link {
        text-decoration: none; /* Elimina el subrayado */
        color: inherit; /* Mantiene el color del texto del elemento contenedor */
        transition: color 0.3s; /* Añade una transición suave para el cambio de color */
    }

    .nav-link:hover {
        color: #007bff; /* Cambia el color al pasar el cursor */
        text-decoration: none; /* Asegura que no haya subrayado al pasar el cursor */
    }

    .nav-link.active {
        font-weight: bold; /* Opcional: resalta el enlace activo con negrita */
    }

    /* Media query para pantallas de tablets */
    @media (min-width: 768px) and (max-width: 1024px) {
        .hu_icon {
            width: 40%; /* Ajusta este valor según tus necesidades */
        }
    }

    /* Media query para pantallas pequeñas, como teléfonos móviles */
    @media (max-width: 768px) {
        .hu_icon {
            width: 50%;
        }
    }
</style>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center hu_icon" style="margin-top: -1%">
                    <a href="{{ route('tickets') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8 sm:-my-px sm:ms-10 no-underline">
                    <x-nav-link :href="route('ticket.create')" :active="request()->routeIs('ticket.create')">
                        {{ __('Nuevo ticket') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Siempre visible) -->
    <div class="block sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('ticket.create')" :active="request()->routeIs('ticket.create')"
                class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                {{ __('Nuevo ticket') }}
            </x-nav-link>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
