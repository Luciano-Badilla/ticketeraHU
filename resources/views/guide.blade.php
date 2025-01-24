<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/hu_icon.png') }}" type="image/x-icon">
    <title>{{ $guide->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <!-- Font Awesome 6 (CSS) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        a {
            text-decoration: none !important;
        }

        img {
            border-radius: 10px;
        }

        .rendered-content {
            word-wrap: break-word;
            /* Ajusta palabras largas */
        }
    </style>
</head>

<body class="flex justify-center bg-gray-100">
    <div class="bg-white rounded-xl shadow-sm m-5 flex flex-col gap-5 w-full lg:w-1/2 h-fit">
        <div class="flex flex-row items-center justify-center mt-5 gap-1">
            <img src="{{ asset('images/hu_icon.png') }}" class="h-12 lg:h-16" alt="HU Logo">
            <h1 class="text-2xl lg:text-3xl text-gray-700 font-bold">{{ $guide->title }}</h1>
        </div>
        <!-- Cuerpo del ticket -->
        <div class="px-3 border border-gray-300 rounded-xl mx-1 lg:mx-4 mb-3">
            <div class="text-sm text-gray-900 h-auto rendered-content mt-4 editor" id="editor">
                {!! $guide->body !!}
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor', {
            readOnly: true
        });
    })
</script>

</html>
