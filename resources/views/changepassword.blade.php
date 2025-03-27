<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/hu_icon.png') }}" type="image/x-icon">
    <title>{{ 'Restablecer contraseña' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <!-- Font Awesome 6 (CSS) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="flex justify-center items-center bg-gray-100">

    <div class="flex flex-col bg-white rounded-xl px-3 w-1/4">
        <div class="flex justify-center my-5">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </div>
        <form method="POST" action="{{ route('usuario.password') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 bg-gray-100 w-full p-2 border border-gray-300" type="email"
                    name="email" :value="old('email', $email)" readonly required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Nueva contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full p-2 border border-gray-300" type="password"
                    name="password" required autofocus autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Restablecer contraseña') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</body>

</html>
