@extends('layouts.dash2')

@section('content')
    <div class="container mx-auto p-4 sm:p-6">
        <button id="openModal" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Crear Publicación
        </button>

        <div id="modalsContainer" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-between z-50 p-4">
            <div id="editorModal" class="bg-white rounded-lg shadow-lg w-1/2 mr-2 overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center p-4 border-b bg-gray-100">
                    <h5 class="text-lg font-semibold text-gray-800">Editor de Publicación</h5>
                    <button class="closeModals text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                </div>

                <div class="p-4">
                    <form id="dynamicForm" class="space-y-4" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <input type="text" id="postTitle" placeholder="Título de la publicación" class="border rounded p-2 w-full" required>

                        <select id="postCategory" class="border rounded p-2 w-full" required>
                            <option value="blog">Blog</option>
                            <option value="project">Proyecto</option>
                        </select>

                        <div id="dynamicFields" class="space-y-4"></div>

                        <input type="file" id="imageFiles" name="image_files[]" multiple class="hidden" accept="image/*">

                        <div class="flex justify-between">
                            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" onclick="addField()">
                                Agregar Elemento
                            </button>
                            <button type="button" id="publishButton" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Publicar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="previewModal" class="bg-white rounded-lg shadow-lg w-1/2 ml-2 overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center p-4 border-b bg-gray-100">
                    <h5 class="text-lg font-semibold text-gray-800">Previsualización en Tiempo Real</h5>
                    <button class="closeModals text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                </div>
                <div class="p-4">
                    <div id="previewArea" class="border rounded-lg p-4 bg-gray-50 max-h-[600px] overflow-y-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let fieldIndex = 0;
        let imageFiles = {};

        // Abrir el modal
        document.getElementById('openModal').addEventListener('click', () => {
            document.getElementById('modalsContainer').classList.remove('hidden');
            // Agregar campo de imagen por defecto
            addField('image');
        });

        // Cerrar el modal
        document.querySelectorAll('.closeModals').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modalsContainer').classList.add('hidden');
            });
        });

        // Agregar campos dinámicos
        function addField(type = null) {
            const container = document.getElementById('dynamicFields');
            const newField = document.createElement('div');
            newField.setAttribute('data-index', fieldIndex);
            newField.classList.add('flex', 'items-center', 'space-x-2', 'mb-2');

            const fieldType = type || 'text';

            newField.innerHTML = `
                <select name="fields[${fieldIndex}][type]" class="field-type border rounded p-2 bg-white" onchange="updateFieldType(${fieldIndex})">
                    <option value="title" ${fieldType === 'title' ? 'selected' : ''}>Título</option>
                    <option value="subtitle" ${fieldType === 'subtitle' ? 'selected' : ''}>Subtítulo</option>
                    <option value="text" ${fieldType === 'text' ? 'selected' : ''}>Texto</option>
                    <option value="image" ${fieldType === 'image' ? 'selected' : ''}>Imagen</option>
                    <option value="video" ${fieldType === 'video' ? 'selected' : ''}>Video (YouTube)</option>
                </select>
                <div class="field-input-container flex-1">
                    ${fieldType === 'image' ? `
                        <div class="flex space-x-2">
                            <input type="text" name="fields[${fieldIndex}][value]" placeholder="URL de la imagen"
                                   class="image-url border rounded p-2 w-full" oninput="updatePreview()">
                            <button type="button" onclick="openFilePicker(${fieldIndex})" class="px-3 bg-gray-200 rounded hover:bg-gray-300 text-sm">
                                📁 Subir
                            </button>
                        </div>
                    ` : `
                        <input type="text" name="fields[${fieldIndex}][value]" placeholder="Contenido o URL"
                               class="border rounded p-2 w-full" oninput="updatePreview()">
                    `}
                </div>
                <button type="button" onclick="removeField(${fieldIndex})" class="text-red-500 hover:text-red-700">X</button>
            `;

            container.appendChild(newField);
            fieldIndex++;
            updatePreview();
        }

        // Actualizar tipo de campo
        function updateFieldType(index) {
            const field = document.querySelector(`[data-index="${index}"]`);
            const type = field.querySelector('.field-type').value;
            const valueInput = field.querySelector('input');
            const value = valueInput ? valueInput.value : '';

            const container = field.querySelector('.field-input-container');
            if (type === 'image') {
                container.innerHTML = `
                    <div class="flex space-x-2">
                        <input type="text" name="fields[${index}][value]" placeholder="URL de la imagen"
                               value="${value}" class="image-url border rounded p-2 w-full" oninput="updatePreview()">
                        <button type="button" onclick="openFilePicker(${index})" class="px-3 bg-gray-200 rounded hover:bg-gray-300 text-sm">
                            📁 Subir
                        </button>
                    </div>
                `;
            } else {
                container.innerHTML = `
                    <input type="text" name="fields[${index}][value]" placeholder="Contenido o URL"
                           value="${value}" class="border rounded p-2 w-full" oninput="updatePreview()">
                `;
            }
            updatePreview();
        }

        // Abrir selector de archivos
        function openFilePicker(index) {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.onchange = (e) => handleImageUpload(e, index);
            fileInput.click();
        }

        // Manejar subida de imagen
        function handleImageUpload(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            // Guardar archivo para enviar al servidor
            imageFiles[index] = file;

            // Mostrar previsualización
            const reader = new FileReader();
            reader.onload = (e) => {
                const field = document.querySelector(`[data-index="${index}"]`);
                const urlInput = field.querySelector('.image-url');
                urlInput.value = e.target.result;
                updatePreview();
            };
            reader.readAsDataURL(file);
        }

        // Eliminar un campo
        function removeField(index) {
            document.querySelector(`[data-index="${index}"]`).remove();
            delete imageFiles[index];
            updatePreview();
        }

        // Actualizar la previsualización
        function updatePreview() {
            const fields = Array.from(document.querySelectorAll('#dynamicFields div'));
            const previewArea = document.getElementById('previewArea');
            previewArea.innerHTML = '';

            fields.forEach(field => {
                const type = field.querySelector('select').value;
                const value = field.querySelector('input')?.value;

                let previewElement = document.createElement('div');

                if (type === 'title') {
                    previewElement.innerHTML = `<h1 class="text-xl font-bold">${value}</h1>`;
                } else if (type === 'subtitle') {
                    previewElement.innerHTML = `<h2 class="text-lg font-semibold">${value}</h2>`;
                } else if (type === 'text') {
                    previewElement.innerHTML = `<p class="text-gray-700">${value}</p>`;
                } else if (type === 'image' && value) {
                    previewElement.innerHTML = `<img src="${value}" alt="Imagen" class="w-full max-h-48 object-cover rounded mb-2">`;
                } else if (type === 'video' && value) {
                    const videoID = extractYouTubeID(value);
                    if (videoID) {
                        previewElement.innerHTML = `<iframe class="w-full max-h-48 rounded mb-2" src="https://www.youtube.com/embed/${videoID}" frameborder="0" allowfullscreen></iframe>`;
                    } else {
                        previewElement.innerHTML = `<p class="text-red-500">URL de YouTube no válida</p>`;
                    }
                }

                previewArea.appendChild(previewElement);
            });
        }

        function extractYouTubeID(url) {
            const patterns = [
                /(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^&]+)/,
                /(?:https?:\/\/)?(?:www\.)?youtu\.be\/([^&]+)/,
                /(?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([^&]+)/,
            ];

            for (const pattern of patterns) {
                const match = url.match(pattern);
                if (match && match[1]) {
                    return match[1];
                }
            }
            return url.length === 11 ? url : null;
        }

        // Publicar la publicación - VERSIÓN CORREGIDA
        document.getElementById('publishButton').addEventListener('click', async function() {
            console.log('🔵 Botón de publicar clickeado');

            const title = document.getElementById('postTitle').value;
            const category = document.getElementById('postCategory').value;

            const fields = Array.from(document.querySelectorAll('#dynamicFields div')).map(field => {
                return {
                    type: field.querySelector('select').value,
                    value: field.querySelector('input')?.value || '',
                };
            });

            // Validaciones
            if (!title) {
                alert('El título es obligatorio');
                return;
            }

            const hasImage = fields.some(field => field.type === 'image' && field.value);
            if (!hasImage) {
                alert('La publicación debe contener al menos una imagen (URL o archivo)');
                return;
            }

            // Preparar FormData
            const formData = new FormData();
            formData.append('title', title);
            formData.append('category', category);
            formData.append('content', JSON.stringify(fields));

            // Agregar archivos
            Object.entries(imageFiles).forEach(([index, file]) => {
                formData.append(`image_files[${index}]`, file);
            });

            try {
                console.log('🔄 Enviando solicitud...');

                const response = await fetch('/admin/publicaciones', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData,
                });

                console.log('📥 Respuesta recibida. Status:', response.status);

                const result = await response.json();
                console.log('Resultado:', result);

                if (response.ok) {
                    alert('✅ ' + (result.message || 'Publicación creada con éxito'));
                    window.location.reload();
                } else {
                    alert('❌ ' + (result.message || 'Error al crear la publicación'));
                }
            } catch (error) {
                console.error('💥 Error completo:', error);
                alert('❌ Error de conexión: ' + error.message);
            }
        });
    </script>
@endsection
