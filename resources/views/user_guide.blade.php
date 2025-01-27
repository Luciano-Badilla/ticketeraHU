<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/hu_icon.png') }}" type="image/x-icon">
    <title>Manual de usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 (CSS) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            /* Ancho de la barra de desplazamiento */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            /* Color del pulgar de la barra de desplazamiento */
            border-radius: 10px;
            /* Radio de esquina del pulgar */
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            /* Color de la pista de la barra de desplazamiento */
        }
    </style>
</head>

<body class="flex justify-center bg-gray-100">
    <div class="bg-white rounded-xl shadow-sm m-5 flex flex-col gap-10 w-full lg:w-1/2 overflow-hidden">
        <div class="flex flex-col lg:flex-row items-center justify-center mt-10 gap-5 lg:gap-20 text-center">
            <img src="{{ asset('images/hu_logo.png') }}" alt="HU Logo">
            @auth
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl lg:text-3xl text-gray-700 font-bold">MANUAL DE USUARIO</h1>
                    <h1 class="text-2xl lg:text-2xl text-gray-700 font-bold">PARA ADMINISTRADORES</h1>
                </div>

            @endauth
            @guest
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl lg:text-3xl text-gray-700 font-bold">MANUAL DE USUARIO</h1>
                    <h1 class="text-2xl lg:text-2xl text-gray-700 font-bold">PARA CLIENTES</h1>
                </div>
            @endguest
        </div>
        <div class="flex items-center justify-center">
            <div class="relative lg:w-3/4 -mt-4 lg:mt-0">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input name="search"
                    class="w-full ps-9 border border-gray-300 rounded-xl py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                    id="search" type="text" placeholder="Buscar en el manual de usuario"
                    value="{{ old('search') }}">
            </div>
        </div>

        @guest
            <div
                class="tutorials-container mx-auto px-4 flex gap-5 flex-wrap justify-center overflow-y-auto mb-4 custom-scrollbar">
                @if ($completeGuides)
                    @foreach ($completeGuides as $guide)
                        <x-tutorial-card :id="$guide->id" :title="$guide->title" :description="$guide->description" :icon="$guide->icon"
                            :type="$guide->type" />
                    @endforeach
                @endif
                @if ($quickGuides)
                    @foreach ($quickGuides as $guide)
                        <x-tutorial-card :id="$guide->id" :title="$guide->title" :description="$guide->description" :icon="$guide->icon"
                            :type="$guide->type" />
                    @endforeach
            </div>
            @endif
        @endguest
        @auth
            <div class="flex flex-col">
                <h1 class="text-2xl lg:text-2xl text-gray-700 font-bold mb-5 mx-10">Para administradores:</h1>
                <div
                    class="tutorials-container mx-auto px-4 flex gap-5 flex-wrap justify-center overflow-y-auto mb-4 custom-scrollbar">
                    @if ($completeGuidesAdmin)
                        @foreach ($completeGuidesAdmin as $guide)
                            <x-tutorial-card :id="$guide->id" :title="$guide->title" :description="$guide->description" :icon="$guide->icon"
                                :type="$guide->type" />
                        @endforeach
                    @endif
                    @if ($quickGuidesAdmin)
                        @foreach ($quickGuidesAdmin as $guide)
                            <x-tutorial-card :id="$guide->id" :title="$guide->title" :description="$guide->description" :icon="$guide->icon"
                                :type="$guide->type" />
                        @endforeach
                    @endif
                </div>
                <h1 class="text-2xl lg:text-2xl text-gray-700 font-bold mb-5 mx-10">Para usuarios:</h1>
                <div
                    class="tutorials-container mx-auto px-4 flex gap-5 flex-wrap justify-center overflow-y-auto mb-4 custom-scrollbar">
                    @if ($completeGuides)
                        @foreach ($completeGuides as $guide)
                            <x-tutorial-card :id="$guide->id" :title="$guide->title" :description="$guide->description" :icon="$guide->icon"
                                :type="$guide->type" />
                        @endforeach
                    @endif
                    @if ($quickGuides)
                        @foreach ($quickGuides as $guide)
                            <x-tutorial-card :id="$guide->id" :title="$guide->title" :description="$guide->description" :icon="$guide->icon"
                                :type="$guide->type" />
                        @endforeach
                </div>
                @endif
            </div>
        @endauth
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            const searchValue = $(this).val().toLowerCase(); // Obtener el valor del campo de búsqueda
            $('.tutorial-card').each(function() {
                const guideText = $(this).find('.tutorial-card-title').text().toLowerCase();

                if (guideText.includes(searchValue)) {
                    $(this).show(); // Mostrar la tarjeta si coincide
                } else {
                    $(this).hide(); // Ocultar la tarjeta si no coincide
                }
            });
        });
    });
</script>

</html>
