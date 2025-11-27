@extends('layouts.dash2')

@section('content')

<div class="container mx-auto py-6" x-data="{ openModal: true }">

    <!-- Fondo del modal -->
    <div x-show="openModal"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         x-transition>

        <!-- Modal -->
        <div class="bg-white w-11/12 lg:w-3/4 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto p-6"
             x-transition.scale>

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">
                    Editar Blog: {{ $blog->nombre }}
                </h2>

                <a href="{{ route('blogs.list') }}"
                   class="text-gray-600 hover:text-black text-3xl leading-none">
                    &times;
                </a>
            </div>

            <!-- CONTENIDO -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                <!-- COLUMNA IZQUIERDA -->
                <div>

                    <label class="block mb-2 font-semibold">Nombre del blog</label>
                    <input id="blogName" type="text"
                           value="{{ $blog->nombre }}"
                           class="w-full border rounded p-2 mb-4">

                    <!-- Botones agregar -->
                    <div class="mb-2 flex items-center gap-2 flex-wrap">
                        <button id="addTitle" class="px-3 py-1 bg-blue-600 text-white rounded">Título</button>
                        <button id="addSubtitle" class="px-3 py-1 bg-blue-600 text-white rounded">Subtítulo</button>
                        <button id="addText" class="px-3 py-1 bg-blue-600 text-white rounded">Texto</button>
                        <button id="addImage" class="px-3 py-1 bg-blue-600 text-white rounded">Imagen</button>
                        <button id="addVideo" class="px-3 py-1 bg-blue-600 text-white rounded">Video</button>
                    </div>

                    <!-- Campos dinámicos -->
                    <div id="fieldsContainer" class="space-y-3"></div>

                    <!-- Botones -->
                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" id="publishBtn"
                                class="px-4 py-2 bg-green-600 text-white rounded">
                            Publicar
                        </button>

                        <button type="button" id="draftBtn"
                                class="px-4 py-2 bg-gray-400 text-white rounded">
                            Guardar Borrador
                        </button>

                        <a href="{{ route('blogs.list') }}"
                           class="px-4 py-2 bg-gray-300 rounded">
                            Cancelar
                        </a>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: PREVIEW -->
                <div>
                    <h2 class="text-xl font-semibold mb-3">Previsualización</h2>

                    <div id="previewArea"
                         class="border rounded p-4 max-h-[70vh] overflow-y-auto bg-gray-50">
                    </div>

                </div>

            </div> <!-- grid -->

        </div><!-- modal -->

    </div>

</div>

<script>
const blogContenido = @json($blog->contenido ?? []);
let fieldIndex = 0;

const imageFiles = {};
const videoFiles = {};

// Crear campo dinámico
function createFieldElement(type, value = '') {
    const idx = fieldIndex++;
    const wrapper = document.createElement('div');
    wrapper.className = 'flex items-center space-x-2';
    wrapper.dataset.index = idx;
    wrapper.dataset.type = type;

    let inputHtml = `<input type="text" class="fieldValue border rounded p-2 flex-1"
               value="${escapeHtml(value)}"
               placeholder="Contenido"
               oninput="updatePreview()">`;

    if (type === 'image') {
        inputHtml = `<input type="text" class="fieldValue border rounded p-2 flex-1 image-url"
               value="${escapeHtml(value)}"
               placeholder="URL o imagen"
               oninput="updatePreview()">
        <button type="button" class="px-3 py-1 bg-gray-200 rounded"
                onclick="triggerUpload(${idx})">📁</button>`;
    }

    if (type === 'video') {
        inputHtml = `<input type="text" class="fieldValue border rounded p-2 flex-1 video-url"
               value="${escapeHtml(value)}"
               placeholder="URL (YouTube) o video local"
               oninput="updatePreview()">
        <button type="button" class="px-3 py-1 bg-gray-200 rounded"
                onclick="triggerVideoUpload(${idx})">🎥</button>`;
    }

    wrapper.innerHTML = `<select class="fieldType border p-2 rounded" onchange="onTypeChange(${idx})">
            <option value="title" ${type==='title'?'selected':''}>Título</option>
            <option value="subtitle" ${type==='subtitle'?'selected':''}>Subtítulo</option>
            <option value="text" ${type==='text'?'selected':''}>Texto</option>
            <option value="image" ${type==='image'?'selected':''}>Imagen</option>
            <option value="video" ${type==='video'?'selected':''}>Video</option>
        </select>
        <div class="flex-1">${inputHtml}</div>
        <button class="text-red-500 font-bold" onclick="removeField(${idx})">X</button>`;

    return wrapper;
}

function escapeHtml(str){
    return String(str||'').replace(/[&<>"]/g, m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[m]));
}

function removeField(idx){
    document.querySelector(`[data-index="${idx}"]`)?.remove();
    delete imageFiles[idx];
    delete videoFiles[idx];
    updatePreview();
}

function onTypeChange(idx){
    const el = document.querySelector(`[data-index="${idx}"]`);
    const newType = el.querySelector('.fieldType').value;
    el.dataset.type = newType;

    const container = el.querySelector('.flex-1');
    const current = container.querySelector('.fieldValue')?.value || '';

    if (newType === 'image') {
        container.innerHTML = `<input type="text" class="fieldValue border rounded p-2 flex-1 image-url"
               value="${escapeHtml(current)}"
               placeholder="URL o imagen"
               oninput="updatePreview()">
        <button class="px-3 py-1 bg-gray-200 rounded" onclick="triggerUpload(${idx})">📁</button>`;
    } else if (newType === 'video') {
        container.innerHTML = `<input type="text" class="fieldValue border rounded p-2 flex-1 video-url"
               value="${escapeHtml(current)}"
               placeholder="URL o video local"
               oninput="updatePreview()">
        <button class="px-3 py-1 bg-gray-200 rounded" onclick="triggerVideoUpload(${idx})">🎥</button>`;
    } else {
        container.innerHTML = `<input type="text" class="fieldValue border rounded p-2 flex-1"
               value="${escapeHtml(current)}"
               oninput="updatePreview()">`;
    }
    updatePreview();
}

function triggerUpload(idx){
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = e => handleLocalImage(e, idx);
    input.click();
}

function triggerVideoUpload(idx){
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'video/*';
    input.onchange = e => {
        const file = e.target.files[0];
        if (!file) return;
        videoFiles[idx] = file;
        const field = document.querySelector(`[data-index="${idx}"] .fieldValue`);
        field.value = "";
        updatePreview();
    };
    input.click();
}

function handleLocalImage(e, idx){
    const file = e.target.files[0];
    if (!file) return;
    imageFiles[idx] = file;
    const reader = new FileReader();
    reader.onload = ev => {
        const node = document.querySelector(`[data-index="${idx}"] .fieldValue`);
        node.value = ev.target.result;
        updatePreview();
    };
    reader.readAsDataURL(file);
}

function loadInitial(){
    const area = document.getElementById("fieldsContainer");
    area.innerHTML = "";
    blogContenido.forEach(item => {
        if (item.type === 'image' && item.value) {
            if (!item.value.startsWith("http") && !item.value.startsWith("data:image")) {
                item.value = "/" + item.value.replace(/^\//, "");
            }
        }
        if (item.type === 'video' && item.value) {
            if (item.value.includes("uploads/videos")) {
                item.value = "/" + item.value.replace(/^\//, "");
            }
        }
        area.appendChild(createFieldElement(item.type, item.value));
    });
    if (blogContenido.length === 0) {
        area.appendChild(createFieldElement("text", ""));
    }
    updatePreview();
}

function extractYouTubeID(url){
    const m = url.match(/(?:youtu\.be\/|watch\?v=)([^&]+)/);
    return m ? m[1] : null;
}

function updatePreview(){
    const preview = document.getElementById("previewArea");
    preview.innerHTML = "";
    const nodes = [...document.querySelectorAll("#fieldsContainer > div")];
    nodes.forEach(n => {
        const type = n.dataset.type;
        const value = n.querySelector(".fieldValue")?.value || "";
        let block = document.createElement("div");
        block.className = "mb-4";

        if(type==="title") block.innerHTML = `<h2 class="text-2xl font-bold">${value}</h2>`;
        if(type==="subtitle") block.innerHTML = `<h3 class="text-xl font-semibold">${value}</h3>`;
        if(type==="text") block.innerHTML = `<p class="whitespace-pre-wrap">${value}</p>`;
        if(type==="image") block.innerHTML = `<img src="${value}" class="w-full rounded shadow">`;
        if(type==="video"){
            const youtube = extractYouTubeID(value);
            if (youtube) {
                block.innerHTML = `<iframe class="w-full h-64 rounded shadow" src="https://www.youtube.com/embed/${youtube}" allowfullscreen></iframe>`;
            } else if (value.startsWith("/uploads/videos")) {
                block.innerHTML = `<video controls class="w-full rounded shadow"><source src="${value}"></video>`;
            } else if (videoFiles[n.dataset.index]) {
                const blobURL = URL.createObjectURL(videoFiles[n.dataset.index]);
                block.innerHTML = `<video controls class="w-full rounded shadow"><source src="${blobURL}"></video>`;
            } else {
                block.innerHTML = `<p class="text-gray-500 text-sm">${value}</p>`;
            }
        }
        preview.appendChild(block);
    });
}

// Botones crear elementos
document.getElementById("addTitle").onclick = () => fieldsContainer.appendChild(createFieldElement("title",""));
document.getElementById("addSubtitle").onclick = () => fieldsContainer.appendChild(createFieldElement("subtitle",""));
document.getElementById("addText").onclick = () => fieldsContainer.appendChild(createFieldElement("text",""));
document.getElementById("addImage").onclick = () => fieldsContainer.appendChild(createFieldElement("image",""));
document.getElementById("addVideo").onclick = () => fieldsContainer.appendChild(createFieldElement("video",""));

// Función genérica para guardar o publicar
async function submitBlog(estado){
    const nombre = blogName.value.trim();
    if (!nombre) return alert("El nombre es obligatorio");

    const nodes = [...document.querySelectorAll("#fieldsContainer > div")];
    const contenido = nodes.map(n => ({
        type: n.dataset.type,
        value: n.querySelector('.fieldValue')?.value || ''
    }));

    const fd = new FormData();
    fd.append("nombre", nombre);
    fd.append("contenido", JSON.stringify(contenido));
    fd.append("_method", "PUT");
    fd.append("estado", estado); // Publicar o Borrador

    Object.entries(imageFiles).forEach(([i, file]) => fd.append(`image_files[${i}]`, file));
    Object.entries(videoFiles).forEach(([i, file]) => fd.append(`video_files[${i}]`, file));

    const res = await fetch("{{ route('blogs.update', $blog->id) }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: fd
    });

    if (!res.ok) return alert("Error al actualizar");
    location.href = "{{ route('blogs.list') }}";
}

// Asignar eventos a botones
document.getElementById("publishBtn").onclick = () => submitBlog('publicado');
document.getElementById("draftBtn").onclick = () => submitBlog('borrador');

loadInitial();
</script>

@endsection
