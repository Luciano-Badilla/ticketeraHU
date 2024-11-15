<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="detalle">
            <i class="fas fa-align-left mr-2"></i>Detalle
        </label>
        <!-- Cambiar textarea por un div para Quill -->
        <div id="editor"
            class="appearance-none block w-full border border-gray-300 text-gray-700 py-2 px-3 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
            style="height: 200px;" placeholder="Describe el problema en detalle" required></div>
        <input type="hidden" name="detalle" id="detalle">
    </div>
</div>

<!--Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    ['bold', 'italic', 'underline'],
                    [{
                        'header': [1, 2, false]
                    }],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['image'], // Button to upload images
                ],
                handlers: {
                    image: imageHandler, // Assign the imageHandler function to the image button
                },
            },
        },
    });

    // Custom handler for image upload
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
                    quill.insertEmbed(range.index, 'image', data.url); // Insert the image in the editor
                } else {
                    console.error('Error uploading the image');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        };
    }

    // Handle pasting images with Ctrl+V
    quill.root.addEventListener('paste', async (event) => {
        const clipboardData = event.clipboardData || window.clipboardData;
        if (clipboardData && clipboardData.items) {
            for (let i = 0; i < clipboardData.items.length; i++) {
                const item = clipboardData.items[i];
                if (item.type.indexOf('image') !== -1) {
                    event.preventDefault(); // Prevent Quill's default paste behavior for images

                    const file = item.getAsFile();
                    if (file) {
                        const formData = new FormData();
                        formData.append('image', file);

                        try {
                            const response = await fetch("{{ route('imgUpload') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: formData,
                            });
                            const data = await response.json();

                            if (data.success) {
                                const range = quill.getSelection();
                                quill.insertEmbed(range.index, 'image', data
                                    .url); // Insert the image in the editor
                            } else {
                                console.error('Error uploading the image');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    }
                }
            }
        }
    });
</script>
