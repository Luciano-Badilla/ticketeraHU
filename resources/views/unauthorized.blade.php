<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso No Autorizado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-gray-100 p-8 rounded-lg text-center w-1/4">
        <div class="mb-4">
            <i class="fas fa-exclamation-circle text-red-500 text-6xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Acceso No Autorizado</h1>
        @php
            $buttons = $buttons ?? null;
        @endphp
        @if ($buttons)
            <div class="flex flex-col gap-4 items-center justify-center">
                @foreach ($buttons as $button)
                    <p class="text-gray-900">{{ $button['label'] }}</p>
                    <a href="{{ $button['url'] }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full">{{ $button['text'] }}</a>
                @endforeach
            @else
                <p class="text-gray-600 mb-6">Lo sentimos, no tienes permiso para acceder a esta página. Por favor,
                    verifica
                    tus
                    credenciales o contacta al administrador.</p>
        @endif
        <a href="{{ url()->previous() }}" class="bg-black text-white px-4 py-2 rounded-lg w-full">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>
    </div>
    <footer class="absolute bottom-4 w-full text-center text-gray-500">
    </footer>
</body>

</html>
