@extends('layouts.dash2')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Todas las Publicaciones</h1>

        <div class="flex justify-end mb-4">
            <button id="openModal" class="px-4 py-2 bg-emerald-300 text-black rounded-lg hover:bg-blue-300-500">
                Crear Publicación
            </button>
        </div>

        @if(session()->has('message'))
            <div class="bg-red-700 text-white p-4 rounded-lg mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-y-scroll h-[70vh]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <div class="border rounded-lg shadow-lg bg-white p-4 hover:shadow-xl transition-shadow duration-200">
                        <h2 class="text-xl font-semibold mb-2 text-center text-blue-600">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-500 mb-4">Tipo: {{ $post->category === 'blog' ? 'Blog' : 'Proyecto' }}</p>
                        <div class="space-y-4">
                            @foreach ($post->content as $element)
                                @if ($element['type'] === 'title')
                                    <h3 class="text-lg font-bold text-gray-800">{{ $element['value'] }}</h3>
                                @elseif ($element['type'] === 'text')
                                    <p class="text-gray-700">{{ $element['value'] }}</p>
                                @elseif ($element['type'] === 'image' && isset($element['value']))
                                    <img src="{{ $element['value'] }}" alt="Imagen" class="w-full h-40 object-cover rounded-lg">
                                @elseif ($element['type'] === 'video' && isset($element['value']))
                                    @php
                                        $videoID = null;
                                        if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $element['value'], $matches)) {
                                            $videoID = $matches[1];
                                        }
                                    @endphp
                                    @if ($videoID)
                                        <iframe class="w-full h-40 rounded-lg"
                                                src="https://www.youtube.com/embed/{{ $videoID }}"
                                                frameborder="0"
                                                allowfullscreen></iframe>
                                    @else
                                        <p class="text-red-500">URL de video no válida</p>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('admin.publicaciones.edit', $post->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                                Editar
                            </a>
                            <form action="{{ route('admin.publicaciones.eliminar', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-3">No hay publicaciones disponibles.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Container -->
    <div class="container mx-auto p-4 sm:p-6">
        <div id="modalsContainer" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-between z-50 p-4">
            <!-- Editor Modal -->
            <div id="editorModal" class="bg-white rounded-lg shadow-lg w-1/2 mr-2 overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center p-4 border-b bg-gray-100">
                    <h5 class="text-lg font-semibold text-gray-800">Editor de Publicación</h5>
                    <button id="closeModals" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                </div>

                <div class="p-4">
                    <form id="dynamicForm" class="space-y-4">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="text" id="postTitle" placeholder="Título de la publicación" class="border rounded p-2 w-full">

                        <select id="postCategory" class="border rounded p-2 w-full">
                            <option value="blog">Blog</option>
                            <option value="project">Proyecto</option>
                        </select>

                        <div class="mt-2 flex items-center space-x-2">
                            <input type="text" id="postImg" placeholder="Contenido o URL Imagen" class="border rounded p-2 flex-grow">
                        </div>

                        <div id="dynamicFields" class="space-y-4"></div>
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

            <!-- Preview Modal -->
            <div id="previewModal" class="bg-white rounded-lg shadow-lg w-1/2 ml-2 overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center p-4 border-b bg-gray-100">
                    <h5 class="text-lg font-semibold text-gray-800">Previsualización en Tiempo Real</h5>
                    <button id="closeModals" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
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

        // Open modal
        document.getElementById('openModal').addEventListener('click', () => {
            document.getElementById('modalsContainer').classList.remove('hidden');
        });

        // Close modals
        document.querySelectorAll('#closeModals').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modalsContainer').classList.add('hidden');
            });
        });

        // Add field
        function addField() {
            const container = document.getElementById('dynamicFields');
            const newField = document.createElement('div');
            newField.setAttribute('data-index', fieldIndex);
            newField.classList.add('flex', 'items-center', 'space-x-2', 'mb-2');

            newField.innerHTML = `
                <select name="fields[${fieldIndex}][type]" class="border rounded p-2 bg-white" onchange="updatePreview()">
                    <option value="title">Título</option>
                    <option value="subtitle">Subtítulo</option>
                    <option value="text">Texto</option>
                    <option value="image">Imagen</option>
                    <option value="video">Video (YouTube)</option>
                </select>
                <input type="text" name="fields[${fieldIndex}][value]" placeholder="Contenido o URL" class="border rounded p-2 w-full" oninput="updatePreview()">
                <button type="button" onclick="removeField(${fieldIndex})" class="text-red-500 hover:text-red-700">X</button>
            `;

            container.appendChild(newField);
            fieldIndex++;
            updatePreview();
        }

        // Remove field
        function removeField(index) {
            document.querySelector(`[data-index="${index}"]`).remove();
            updatePreview();
        }

        // Update preview
        function updatePreview() {
            const fields = Array.from(document.querySelectorAll('#dynamicFields div'));
            const previewArea = document.getElementById('previewArea');
            previewArea.innerHTML = '';

            fields.forEach(field => {
                const type = field.querySelector('select').value;
                const value = field.querySelector('input').value;

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
           // Patrones para diferentes formatos de URLs de YouTube
           const patterns = [
               /(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^&]+)/,
               /(?:https?:\/\/)?(?:www\.)?youtu\.be\/([^&]+)/,
               /(?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([^&]+)/,
               /(?:https?:\/\/)?(?:www\.)?youtube\.com\/v\/([^&]+)/,
               /(?:https?:\/\/)?(?:www\.)?youtube\.com\/user\/\w+#\w\/\w+\/\w+\/([^&]+)/
           ];

           for (const pattern of patterns) {
               const match = url.match(pattern);
               if (match && match[1]) {
                   return match[1];
               }
           }


           return url.length === 11 ? url : null;
       }

        // Publish post
       document.getElementById('publishButton').addEventListener('click', async () => {
           const title = document.getElementById('postTitle').value;
           const category = document.getElementById('postCategory').value;

           // Obtener la imagen principal si existe
           const postImage = document.getElementById('postImage')?.value || document.getElementById('postImg')?.value;

           // Crear array de contenido
           let content = [];

           // Agregar imagen principal si existe
           if (postImage) {
               content.push({
                   type: 'image',
                   value: postImage
               });
           }

           // Agregar campos dinámicos
           const dynamicFields = Array.from(document.querySelectorAll('#dynamicFields div')).map(field => {
               return {
                   type: field.querySelector('select').value,
                   value: field.querySelector('input').value,
               };
           });

           content = content.concat(dynamicFields);

           try {
               const response = await fetch('{{ route("admin.publicaciones.store") }}', {
                   method: 'POST',
                   headers: {
                       'Content-Type': 'application/json',
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                       'Accept': 'application/json'
                   },
                   body: JSON.stringify({
                       title: title,
                       category: category,
                       content: content,
                   }),
               });

               const result = await response.json();

               if (response.ok) {
                   alert(result.message || 'Publicación creada con éxito');
                   window.location.reload();
               } else {
                   // Mostrar errores de validación si existen
                   if (result.errors) {
                       const errorMessages = Object.values(result.errors).join('\n');
                       alert(`Errores:\n${errorMessages}`);
                   } else {
                       alert(result.message || 'Error al crear la publicación');
                   }
               }
           } catch (error) {
               console.error('Error:', error);
               alert('Ocurrió un error al comunicarse con el servidor.');
           }
       });
    </script>
@endsection
