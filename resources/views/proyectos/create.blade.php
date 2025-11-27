@extends('layouts.dash2')

@section('content')
<div class="container mx-auto p-4 sm:p-6">

    <button id="openModal" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
        Crear Proyecto
    </button>

    <!-- Modal -->
    <div id="modalContainer" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-start z-50 p-4">
        <div class="bg-white rounded-lg shadow-lg w-5/6 max-h-screen overflow-y-auto">

            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b bg-gray-100">
                <h5 class="text-lg font-semibold text-gray-800">Crear Proyecto</h5>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
            </div>

            <!-- Body con 2 columnas -->
            <div class="p-4 grid grid-cols-2 gap-4">

                <!-- Columna izquierda: agregar contenido -->
                <div>
                    <input type="text" id="projectName" placeholder="Nombre del proyecto"
                           class="border rounded p-2 w-full mb-4">

                    <button id="addFieldBtn"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mb-4">
                        Agregar elemento
                    </button>

                    <div id="fieldsContainer" class="space-y-2 mb-4"></div>

                    <div class="flex justify-end gap-2">

                        <button id="publishBtn"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Publicar
                        </button>
                         <button id="saveDraftBtn"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Guardar Borrador
                         </button>
                        <button id="closeModalFooter"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-gray-500">
                            Cancelar
                        </button>
                    </div>
                </div>

                <!-- Columna derecha: previsualización -->
                <div>
                    <h2 class="text-xl font-bold mb-2">Previsualización</h2>
                    <div id="previewArea"
                         class="border rounded-lg p-4 bg-gray-50 max-h-[500px] overflow-y-auto">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
let fieldIndex = 0;
let imageFiles = {};
let videoFiles = {};

document.getElementById('openModal').addEventListener('click', () => {
    document.getElementById('modalContainer').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', closeModal);
document.getElementById('closeModalFooter').addEventListener('click', closeModal);
function closeModal() {
    document.getElementById('modalContainer').classList.add('hidden');
}

// Agregar campo dinámico
document.getElementById('addFieldBtn').addEventListener('click', e => {
    e.preventDefault();
    const container = document.getElementById('fieldsContainer');
    const div = document.createElement('div');
    div.classList.add('flex', 'items-center', 'space-x-2');
    div.dataset.index = fieldIndex;

    div.innerHTML = `
        <select class="fieldType border rounded p-2" onchange="switchUploadButtons(${fieldIndex}); updatePreview();">
            <option value="title">Título</option>
            <option value="subtitle">Subtítulo</option>
            <option value="text">Texto</option>
            <option value="image">Imagen</option>
            <option value="video">Video (YouTube o Local)</option>
        </select>

        <input type="text" class="fieldValue border rounded p-2 flex-1"
               placeholder="Contenido, URL o quedará vacío si es local" oninput="updatePreview()">

        <button type="button" onclick="removeField(${fieldIndex})"
                class="text-red-500 hover:text-red-700">X</button>

        <button type="button" id="btnUploadImg${fieldIndex}"
                onclick="uploadImage(${fieldIndex})"
                class="text-gray-600 hover:text-gray-800 hidden">
            📁 Img
        </button>

        <button type="button" id="btnUploadVid${fieldIndex}"
                onclick="uploadVideo(${fieldIndex})"
                class="text-gray-600 hover:text-gray-800 hidden">
            🎥 Video
        </button>
    `;

    container.appendChild(div);
    updatePreview();
    fieldIndex++;
});

function switchUploadButtons(index) {
    const field = document.querySelector(`[data-index="${index}"]`);
    const type = field.querySelector('.fieldType').value;
    const btnImg = document.getElementById(`btnUploadImg${index}`);
    const btnVid = document.getElementById(`btnUploadVid${index}`);
    btnImg.classList.add("hidden");
    btnVid.classList.add("hidden");
    if (type === "image") btnImg.classList.remove("hidden");
    if (type === "video") btnVid.classList.remove("hidden");
}

function removeField(index) {
    document.querySelector(`[data-index="${index}"]`).remove();
    delete imageFiles[index];
    delete videoFiles[index];
    updatePreview();
}

function uploadImage(index) {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = e => {
        const file = e.target.files[0];
        if (!file) return;
        imageFiles[index] = file;
        const reader = new FileReader();
        reader.onload = ev => {
            const field = document.querySelector(`[data-index="${index}"] .fieldValue`);
            field.value = ev.target.result;
            updatePreview();
        };
        reader.readAsDataURL(file);
    };
    input.click();
}

function uploadVideo(index) {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'video/*';
    input.onchange = e => {
        const file = e.target.files[0];
        if (!file) return;
        videoFiles[index] = file;
        const field = document.querySelector(`[data-index="${index}"] .fieldValue`);
        field.value = URL.createObjectURL(file);
        updatePreview();
    };
    input.click();
}

function updatePreview() {
    const preview = document.getElementById('previewArea');
    preview.innerHTML = '';
    document.querySelectorAll('#fieldsContainer div').forEach(field => {
        const type = field.querySelector('.fieldType').value;
        const value = field.querySelector('.fieldValue').value;
        let el = document.createElement('div');
        if (type === 'title') el.innerHTML = `<h1 class="text-xl font-bold">${value}</h1>`;
        else if (type === 'subtitle') el.innerHTML = `<h2 class="text-lg font-semibold">${value}</h2>`;
        else if (type === 'text') el.innerHTML = `<p>${value}</p>`;
        else if (type === 'image' && value) el.innerHTML = `<img src="${value}" class="w-full max-h-48 object-cover rounded mb-2">`;
        else if (type === 'video' && value) {
            const id = extractYouTubeID(value);
            if (id) el.innerHTML = `<iframe class="w-full max-h-48 rounded mb-2" src="https://www.youtube.com/embed/${id}" frameborder="0" allowfullscreen></iframe>`;
            else el.innerHTML = `<video class="w-full max-h-48 rounded mb-2" controls><source src="${value}"></video>`;
        }
        preview.appendChild(el);
    });
}

function extractYouTubeID(url) {
    const patterns = [/youtube\.com\/watch\?v=([^&]+)/,/youtu\.be\/([^&]+)/,/youtube\.com\/embed\/([^&]+)/];
    for (const p of patterns) {
        const m = url.match(p);
        if (m && m[1]) return m[1];
    }
    return null;
}

// Función común para enviar proyecto
async function enviarProyecto(estado) {
    const nombre = document.getElementById('projectName').value;
    if (!nombre) return alert('El proyecto necesita un nombre');

    const fields = Array.from(document.querySelectorAll('#fieldsContainer div')).map(field => ({
        type: field.querySelector('.fieldType').value,
        value: field.querySelector('.fieldValue').value
    }));

    if (fields.length === 0) return alert('Agrega al menos un elemento');

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('contenido', JSON.stringify(fields));
    formData.append('estado', estado);

    Object.entries(imageFiles).forEach(([i, file]) => formData.append(`image_files[${i}]`, file));
    Object.entries(videoFiles).forEach(([i, file]) => formData.append(`video_files[${i}]`, file));

    try {
        const res = await fetch("{{ route('proyectos.store') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: formData
        });

        const data = await res.json();
        if (res.ok) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'Error al guardar');
        }
    } catch (err) {
        console.error(err);
        alert('Error de conexión');
    }
}

document.getElementById('publishBtn').addEventListener('click', () => enviarProyecto('publicado'));
document.getElementById('saveDraftBtn').addEventListener('click', () => enviarProyecto('borrador'));
</script>
@endsection
