@props(['pretext'])
<style>
    .ql-toolbar {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border: 1px solid #ccc;
        /* Asegúrate de que el borde sea consistente */
    }

    /* Redondear bordes del editor */
    #editor {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 1px solid #ccc;
        /* Asegúrate de que el borde sea consistente */
        overflow: hidden;
        /* Para evitar que el contenido sobresalga */
        position: relative;
        /* Para posicionar el controlador de tamaño */
    }

    .ql-toolbar .ql-video {
        background-color: transparent !important;
        box-shadow: none !important;
        border: none;
        padding: 0;
    }

    .ql-toolbar button:hover,
    .ql-toolbar button:focus {
        background-color: transparent !important;
        box-shadow: none !important;
    }
</style>

<div id="editor"
    class="appearance-none block w-full border border-gray-300 text-gray-700 py-2 px-3 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
    style="height: 200px;" required></div>
<input type="hidden" name="detalle" id="detalle">

<!--Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    ['bold', 'italic', 'underline', 'strike'], // Formatos de texto
                    ['blockquote', 'code-block'], // Citas y bloques de código
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }], // Listas numeradas y con viñetas
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }], // Disminuir/Incrementar sangría
                    [{
                        'direction': 'rtl'
                    }], // Dirección de texto (derecha a izquierda)
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, {
                        'font': []
                    }], // Encabezados y fuentes
                    [{
                        'size': ['small', 'normal', 'large', 'huge']
                    }], // Tamaños de texto
                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // Colores de texto y fondo
                    [{
                        'align': []
                    }], // Alineación de texto
                    ['link', 'image', 'video'], // Insertar enlaces, imágenes y videos
                    ['clean'], // Limpiar formato
                ],
                handlers: {
                    image: imageHandler,
                    video: videoHandler,
                },
            },
        },
    });

   var contenidoHtml = {!! json_encode($pretext ?? '') !!};

    // Inserta el contenido HTML en el editor justo después de inicializarlo
    quill.clipboard.dangerouslyPasteHTML(contenidoHtml);

    // Función personalizada para cargar imágenes
    function imageHandler() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = async () => {
            const file = input.files[0];
            const formData = new FormData();
            formData.append('image', file);

            try {
                const response = await fetch("{{ route('imgUpload') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData,
                });
                const data = await response.json();

                if (data.success) {
                    const range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', data.url);
                } else {
                    console.error('Error al cargar la imagen');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        };
    }

    // Función personalizada para cargar videos
    function videoHandler() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'video/*');
        input.click();

        input.onchange = async () => {
            const file = input.files[0];
            const formData = new FormData();
            formData.append('video', file);

            try {
                const response = await fetch(
                    "{{ route('videoUpload') }}", { // Cambia `{{ route('videoUpload') }}` a tu ruta real para cargar videos
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: formData,
                    });
                const data = await response.json();

                if (data.success) {
                    const range = quill.getSelection();
                    const videoUrl = data.url;
                    quill.insertEmbed(range.index, 'video', videoUrl);
                } else {
                    console.error('Error al cargar el video');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        };
    }

    // Ajustar la altura del editor dinámicamente según el contenido
    quill.on('text-change', function(delta, oldDelta, source) {
        const editor = document.querySelector('#editor');
        editor.style.height = 'auto';
        editor.style.height = `${editor.scrollHeight}px`;
    });
</script>
