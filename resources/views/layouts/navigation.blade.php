@php
    use App\Models\RolModel;
    use App\Models\DashboardTicketModel;
@endphp

<style>
    /* Ajuste para el contenedor del navbar */
    nav {
        height: auto;
        /* Permite que la altura se ajuste automáticamente */
    }

    /* Estilo para el ícono */
    .hu_icon {
        max-width: 125px;
        /* Límite máximo de ancho */
        max-height: 125px;
        /* Límite máximo de alto */
        display: flex;
        justify-content: center;
        /* Centrado horizontal */
        align-items: center;
        /* Centrado vertical */
    }

    /* Ajuste para que el ícono no desborde */
    .hu_icon img {
        max-width: 100%;
        max-height: 100%;
        height: auto;
        width: auto;
    }

    /* Personaliza los enlaces en la barra de navegación */
    .nav-link {
        text-decoration: none;
        /* Elimina el subrayado */
        color: inherit;
        /* Mantiene el color del texto del elemento contenedor */
        transition: color 0.3s;
        /* Añade una transición suave para el cambio de color */
    }

    .nav-link:hover {
        color: #007bff;
        /* Cambia el color al pasar el cursor */
        text-decoration: none;
        /* Asegura que no haya subrayado al pasar el cursor */
    }

    .nav-link.active {
        font-weight: bold;
        /* Resalta el enlace activo con negrita */
    }

    /* Media query para pantallas pequeñas */
    @media (max-width: 768px) {
        .hu_icon {
            max-width: 125px;
            /* Tamaño reducido para móviles */
            max-height: 125px;
        }
    }
</style>

<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <!-- Aumenté la altura -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 hu_icon">
                    <a href="{{ route('ticketera.dashboard') }}">
                        <x-application-logo class="block w-full h-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @guest
                    <div class="hidden sm:flex sm:space-x-8 sm:-my-px sm:ms-10">
                        <x-nav-link :href="route('ticketera.dashboard')" :active="request()->routeIs('ticketera.dashboard') || request()->routeIs('ticket.create')">
                            {{ __('Nuevo ticket') }}
                        </x-nav-link>
                        <x-nav-link :href="route('ticket.show')" :active="request()->routeIs('ticket.show')">
                            {{ __('Mis tickets') }}
                        </x-nav-link>
                    </div>
                @endguest

                @auth
                    <div class="hidden sm:flex sm:space-x-8 sm:-my-px sm:ms-10">
                        <x-nav-link :href="route('ticket_sorting.dashboard')" :active="request()->routeIs('ticket_sorting.dashboard')">
                            {{ __('Inicio') }}
                        </x-nav-link>
                        <x-nav-link :href="route('ticket.dashboard')" :active="request()->routeIs('ticket.dashboard')">
                            {{ __('Tickets') }}
                        </x-nav-link>
                        @if (Auth::user()->rol_id == 2)
                            <x-nav-link :href="route('departamento.dashboard')" :active="request()->routeIs('departamento.dashboard')">
                                {{ __('Departamentos') }}
                            </x-nav-link>
                            <x-nav-link :href="route('area.dashboard')" :active="request()->routeIs('area.dashboard')">
                                {{ __('Sub áreas') }}
                            </x-nav-link>
                            <x-nav-link :href="route('cliente.dashboard')" :active="request()->routeIs('cliente.dashboard')">
                                {{ __('Correos inst.') }}
                            </x-nav-link>
                            <x-nav-link :href="route('usuario.dashboard')" :active="request()->routeIs('usuario.dashboard')">
                                {{ __('Staff') }}
                            </x-nav-link>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Guest Link -->
            @guest
                <div class="flex flex-row">
                    <div class="hidden sm:flex sm:space-x-8 sm:-my-px sm:ms-10">
                        <x-nav-link :href="route('guide.user_guide')" target="_blank"
                            class="btn btn-primary text-white h-8 mt-4 px-2 rounded-xl">
                            <i class="fa-solid fa-book mr-2"></i>
                            {{ __('Manual de usuario') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden sm:flex sm:space-x-8 sm:-my-px sm:ms-10">
                        <x-nav-link :href="route('login')">
                            {{ __('Iniciar sesión') }}
                        </x-nav-link>
                    </div>
                </div>
            @endguest
            @auth
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-nav-link :href="route('guide.user_guide')" target="_blank" class="btn btn-primary text-white h-8 px-2 rounded-xl">
                        <i class="fa-solid fa-book"></i>
                    </x-nav-link>
                    <div class="dropdown" style="position: relative;">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div>
                                {{ (DashboardTicketModel::find(Auth::user()->ticketera_id)->titulo ?? '') .
                                    ' - ' .
                                    (Auth::user()->name_and_surname ?? '') }}
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="no-underline block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100">
                                {{ Auth::user()->name_and_surname }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="no-underline block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
                        </ul>
                    </div>
                </div>

            @endauth
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="block sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @guest
                <x-nav-link :href="route('ticketera.dashboard')" :active="request()->routeIs('ticketera.dashboard') || request()->routeIs('ticket.create')"
                    class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                    {{ __('Nuevo ticket') }}
                </x-nav-link>
                <x-nav-link :href="route('ticket.show')" :active="request()->routeIs('ticket.show')"
                    class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                    {{ __('Mis tickets') }}
                </x-nav-link>
                <x-nav-link :href="route('guide.user_guide')" class="btn btn-primary text-white h-8 px-2 rounded-xl">
                    <i class="fa-solid fa-book mr-2" target="_blank"></i>
                    {{ __('Manual de usuario') }}
                </x-nav-link>
                <x-nav-link :href="route('login')" class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                    {{ __('Iniciar sesión') }}
                </x-nav-link>
            @endguest

            @auth
                <x-nav-link :href="route('ticket_sorting.dashboard')" :active="request()->routeIs('ticket_sorting.dashboard')"
                    class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                    {{ __('Inicio') }}
                </x-nav-link>
                <x-nav-link :href="route('ticket.dashboard')" :active="request()->routeIs('ticket.dashboard')"
                    class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                    {{ __('Tickets') }}
                </x-nav-link>
                @if (Auth::user()->rol_id == 2)
                    <x-nav-link :href="route('departamento.dashboard')" :active="request()->routeIs('departamento.dashboard')"
                        class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                        {{ __('Departamentos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('area.dashboard')" :active="request()->routeIs('area.dashboard')"
                        class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                        {{ __('Sub áreas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cliente.dashboard')" :active="request()->routeIs('cliente.dashboard')"
                        class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                        {{ __('Correos inst.') }}
                    </x-nav-link>
                    <x-nav-link :href="route('usuario.dashboard')" :active="request()->routeIs('usuario.dashboard')"
                        class="block px-3 py-2 text-base text-gray-700 hover:bg-gray-100">
                        {{ __('Staff') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guide.user_guide')" class="btn btn-primary text-white h-8 px-2 rounded-xl">
                        <i class="fa-solid fa-book" target="_blank"></i>
                    </x-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
