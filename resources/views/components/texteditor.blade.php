@props(['pretext'])

<style>
    .ql-toolbar {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border: 1px solid #ccc;
    }

    #editor {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 1px solid #ccc;
        overflow: hidden;
        position: relative;
        height: 200px;
    }

    .ql-toolbar button:hover,
    .ql-toolbar button:focus {
        background-color: transparent !important;
        box-shadow: none !important;
    }
</style>

<div id="editor"
    class="appearance-none block w-full border border-gray-300 text-gray-700 py-2 px-3 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
    style="height: 200px;"></div>
<input type="hidden" name="detalle" id="detalle" value="{{ old('detalle') }}">

<!-- Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                    [{'direction': 'rtl'}],
                    [{'header': '1'}, {'header': '2'}, {'font': []}],
                    [{'size': ['small', 'normal', 'large', 'huge']}],
                    [{'color': []}, {'background': []}],
                    [{'align': []}],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        // Prellenar el contenido en el editor si existe
        const initialContent = {!! json_encode($pretext ?? '') !!};
        if (initialContent) {
            quill.clipboard.dangerouslyPasteHTML(initialContent);
        }

        // Actualizar el campo oculto 'detalle' con el contenido del editor
        quill.on('text-change', function () {
            const htmlContent = quill.root.innerHTML;
            document.querySelector('#detalle').value = htmlContent;
        });
    });
</script>
