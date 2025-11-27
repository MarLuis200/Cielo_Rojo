@extends('layouts.dash2')

@section('content')
<div class="container mx-auto p-4 sm:p-6">

    <button id="openModal" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition duration-300 shadow-lg">
        🎨 Crear Reconocimiento
    </button>

    <!-- Modal -->
    <div id="modalContainer" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-start z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-5/6 max-h-screen overflow-y-auto">

            <!-- Header -->
            <div class="flex justify-between items-center p-6 border-b bg-gradient-to-r from-purple-500 to-indigo-500 text-white">
                <h5 class="text-xl font-bold">Diseñador de Reconocimientos - Canvas</h5>
                <button id="closeModal" class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
            </div>

            <!-- Body con 2 columnas -->
            <div class="p-6 grid grid-cols-3 gap-6">

                <!-- Columna izquierda: Controles -->
                <div class="space-y-4">
                    <!-- Título -->
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Título del reconocimiento</label>
                        <input type="text" id="reconocimientoTitulo" placeholder="Ingresa el título principal"
                               class="border-2 border-gray-300 rounded-lg p-3 w-full focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                    </div>

                    <!-- Panel de herramientas -->
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <h3 class="font-semibold text-gray-700 mb-3">🛠️ Herramientas</h3>

                        <!-- Fondos -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">🎨 Fondos</label>
                            <div class="space-y-2">
                                <div class="flex gap-2">
                                    <button onclick="mostrarSelectorColor()"
                                            class="flex-1 p-2 bg-blue-500 text-white rounded text-sm">Color</button>
                                    <button onclick="subirFondoImagen()"
                                            class="flex-1 p-2 bg-purple-500 text-white rounded text-sm">Imagen</button>
                                </div>
                                <input type="color" id="colorPicker" onchange="cambiarFondoColor(this.value)"
                                       class="w-full h-8 rounded border hidden" value="#667eea">
                            </div>
                        </div>

                        <!-- Agregar elementos -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">➕ Agregar Elementos</label>
                            <div class="grid grid-cols-2 gap-2">
                                <button onclick="agregarElemento('titulo')" class="p-2 bg-blue-500 text-white rounded text-sm">Título</button>
                                <button onclick="agregarElemento('subtitulo')" class="p-2 bg-green-500 text-white rounded text-sm">Subtítulo</button>
                                <button onclick="agregarElemento('texto')" class="p-2 bg-gray-500 text-white rounded text-sm">Texto</button>
                                <button onclick="agregarElemento('icono')" class="p-2 bg-yellow-500 text-white rounded text-sm">Icono</button>
                                <button onclick="agregarElemento('imagen')" class="p-2 bg-purple-500 text-white rounded text-sm">Imagen</button>
                            </div>
                        </div>

                        <!-- Elementos agregados -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">📝 Elementos en Canvas</label>
                            <div id="elementsList" class="space-y-2 max-h-40 overflow-y-auto">
                                <!-- Los elementos se agregarán aquí dinámicamente -->
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col gap-3 pt-4">
                        <button id="saveDraftBtn"
                                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                            💾 Guardar Borrador
                        </button>
                        <button id="publishBtn"
                                class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 transition duration-300">
                            🚀 Publicar
                        </button>
                        <button id="closeModalFooter"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">
                            ❌ Cancelar
                        </button>
                    </div>
                </div>

                <!-- Columna central: Canvas -->
                <div class="col-span-2 space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800 text-center">Canvas del Reconocimiento</h2>

                    <div class="relative">
                        <!-- Canvas principal -->
                        <div id="canvas"
                             class="border-4 border-purple-200 rounded-2xl bg-white shadow-2xl min-h-[600px] relative overflow-hidden bg-cover bg-center">
                            <!-- Los elementos se posicionarán aquí -->
                        </div>

                        <!-- Controles del canvas -->
                        <div class="absolute top-4 right-4 flex gap-2">
                            <button onclick="zoomIn()" class="w-8 h-8 bg-white rounded-full shadow flex items-center justify-center">+</button>
                            <button onclick="zoomOut()" class="w-8 h-8 bg-white rounded-full shadow flex items-center justify-center">-</button>
                            <button onclick="resetCanvas()" class="w-8 h-8 bg-white rounded-full shadow flex items-center justify-center">↺</button>
                        </div>
                    </div>

                    <!-- Instrucciones -->
                    <div class="text-sm text-gray-600 bg-yellow-50 p-3 rounded-lg">
                        <p>💡 <strong>Instrucciones:</strong> Haz clic en los elementos para editarlos directamente. Arrástralos para moverlos.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal para edición de iconos -->
<div id="modalIcono" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-bold mb-4">Seleccionar Icono</h3>
        <div class="space-y-3">
            <div>
                <label class="block text-sm font-medium mb-2">Código Font Awesome (opcional):</label>
                <input type="text" id="inputIconoFA" placeholder="fas fa-trophy"
                       class="w-full border rounded p-2" value="">
                <p class="text-xs text-gray-500 mt-1">Ej: fas fa-trophy, fas fa-award, fas fa-star</p>
            </div>
            <div class="border-t pt-3">
                <label class="block text-sm font-medium mb-2">📤 Subir icono personalizado (SVG, PNG, JPG):</label>
                <input type="file" id="inputIconoArchivo" accept=".svg,.png,.jpg,.jpeg,.webp" class="w-full border rounded p-2">
                <p class="text-xs text-gray-500 mt-1">Formatos aceptados: SVG, PNG, JPG, WebP</p>
            </div>
            <div class="flex gap-2 justify-end mt-4">
                <button onclick="cerrarModalIcono()" class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</button>
                <button onclick="guardarIcono()" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar Icono</button>
            </div>
        </div>
    </div>
</div>

<script>
let elementos = [];
let elementoSeleccionado = null;
let fondoActual = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
let zoomLevel = 1;
let imageFiles = {};
let iconFiles = {};
let iconoEditando = null;

document.getElementById('openModal').addEventListener('click', () => {
    document.getElementById('modalContainer').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', closeModal);
document.getElementById('closeModalFooter').addEventListener('click', closeModal);

function closeModal() {
    document.getElementById('modalContainer').classList.add('hidden');
}

// Mostrar selector de color para fondo
function mostrarSelectorColor() {
    document.getElementById('colorPicker').classList.toggle('hidden');
}

// Cambiar fondo a color
function cambiarFondoColor(color) {
    fondoActual = color;
    const canvas = document.getElementById('canvas');
    canvas.style.background = color;
    canvas.style.backgroundImage = 'none';
}

// Subir imagen de fondo
function subirFondoImagen() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = e => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = ev => {
            fondoActual = `url('${ev.target.result}')`;
            const canvas = document.getElementById('canvas');
            canvas.style.backgroundImage = fondoActual;
            canvas.style.backgroundSize = 'cover';
            canvas.style.backgroundPosition = 'center';
        };
        reader.readAsDataURL(file);
    };
    input.click();
}

// Agregar nuevo elemento al canvas
function agregarElemento(tipo) {
    const id = 'elemento_' + Date.now();
    const elemento = {
        id: id,
        type: tipo,
        value: '',
        position: { x: 50, y: 50 },
        style: {},
        editable: true
    };

    // Valores por defecto según el tipo
    switch(tipo) {
        case 'titulo':
            elemento.value = 'Haz clic para editar';
            elemento.style = {
                fontSize: '32px',
                fontWeight: 'bold',
                color: '#ffffff',
                backgroundColor: 'rgba(147, 51, 234, 0.9)',
                padding: '15px 25px',
                borderRadius: '12px',
                textAlign: 'center',
                cursor: 'text'
            };
            break;
        case 'subtitulo':
            elemento.value = 'Haz clic para editar';
            elemento.style = {
                fontSize: '20px',
                fontWeight: '600',
                color: '#1f2937',
                backgroundColor: 'rgba(253, 230, 138, 0.95)',
                padding: '10px 20px',
                borderRadius: '8px',
                textAlign: 'center',
                cursor: 'text'
            };
            break;
        case 'texto':
            elemento.value = 'Haz clic para editar el texto descriptivo...';
            elemento.style = {
                fontSize: '16px',
                color: '#374151',
                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                padding: '15px',
                borderRadius: '8px',
                maxWidth: '400px',
                cursor: 'text',
                lineHeight: '1.5'
            };
            break;
        case 'icono':
            elemento.value = ''; // Iniciar vacío para que el usuario elija
            elemento.style = {
                fontSize: '64px',
                color: '#f59e0b',
                cursor: 'pointer',
                width: '80px',
                height: '80px',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center'
            };
            // Abrir modal de icono inmediatamente
            setTimeout(() => editarIcono(id), 100);
            break;
        case 'imagen':
            elemento.value = '';
            elemento.style = {
                width: '200px',
                height: '200px',
                objectFit: 'contain',
                cursor: 'pointer'
            };
            // Abrir selector de imagen inmediatamente
            setTimeout(() => subirImagen(id), 100);
            break;
    }

    elementos.push(elemento);
    if (tipo !== 'icono' && tipo !== 'imagen') {
        renderizarElemento(elemento);
    }
    actualizarListaElementos();
}

// Renderizar elemento en el canvas
function renderizarElemento(elemento) {
    const canvas = document.getElementById('canvas');

    // Eliminar elemento existente si ya está renderizado
    const elementoExistente = document.getElementById(elemento.id);
    if (elementoExistente) {
        elementoExistente.remove();
    }

    const elementoDiv = document.createElement('div');
    elementoDiv.id = elemento.id;
    elementoDiv.className = 'absolute cursor-move transform transition-all duration-200 hover:shadow-2xl hover:z-50';
    elementoDiv.style.left = elemento.position.x + 'px';
    elementoDiv.style.top = elemento.position.y + 'px';
    elementoDiv.style.transform = `scale(${zoomLevel})`;

    // Aplicar estilos específicos del elemento
    Object.keys(elemento.style).forEach(key => {
        elementoDiv.style[key] = elemento.style[key];
    });

    // Contenido según el tipo
    switch(elemento.type) {
        case 'titulo':
        case 'subtitulo':
        case 'texto':
            elementoDiv.innerHTML = `
                <div class="relative h-full">
                    <div class="element-content editable-content"
                         contenteditable="true"
                         onblur="actualizarTexto('${elemento.id}', this.innerText)"
                         onclick="event.stopPropagation()"
                         style="outline: none; min-height: 100%; display: flex; align-items: center; justify-content: center;">
                        ${elemento.value}
                    </div>
                    <div class="absolute -top-3 -right-3 flex gap-1 opacity-0 hover:opacity-100 transition-opacity">
                        <button onclick="eliminarElemento('${elemento.id}')" class="w-6 h-6 bg-red-500 text-white rounded-full text-xs flex items-center justify-center">×</button>
                    </div>
                </div>
            `;
            break;
        case 'icono':
            if (elemento.value.startsWith('data:') || elemento.value.includes('/')) {
                // Icono subido (imagen)
                elementoDiv.innerHTML = `
                    <div class="relative group">
                        <img src="${elemento.value}" class="w-full h-full object-contain">
                        <div class="absolute -top-3 -right-3 flex gap-1 opacity-0 hover:opacity-100 transition-opacity">
                            <button onclick="editarIcono('${elemento.id}')" class="w-6 h-6 bg-blue-500 text-white rounded-full text-xs">✏️</button>
                            <button onclick="eliminarElemento('${elemento.id}')" class="w-6 h-6 bg-red-500 text-white rounded-full text-xs">×</button>
                        </div>
                    </div>
                `;
            } else if (elemento.value) {
                // Icono Font Awesome
                elementoDiv.innerHTML = `
                    <div class="relative group">
                        <i class="${elemento.value}"></i>
                        <div class="absolute -top-3 -right-3 flex gap-1 opacity-0 hover:opacity-100 transition-opacity">
                            <button onclick="editarIcono('${elemento.id}')" class="w-6 h-6 bg-blue-500 text-white rounded-full text-xs">✏️</button>
                            <button onclick="eliminarElemento('${elemento.id}')" class="w-6 h-6 bg-red-500 text-white rounded-full text-xs">×</button>
                        </div>
                    </div>
                `;
            } else {
                // Icono vacío
                elementoDiv.innerHTML = `
                    <div class="relative group border-2 border-dashed border-yellow-400 rounded-lg p-6 text-center bg-yellow-50">
                        <div class="text-yellow-600 text-sm">Haz clic para elegir icono</div>
                        <div class="absolute -top-3 -right-3 flex gap-1 opacity-0 hover:opacity-100 transition-opacity">
                            <button onclick="editarIcono('${elemento.id}')" class="w-6 h-6 bg-blue-500 text-white rounded-full text-xs">✏️</button>
                            <button onclick="eliminarElemento('${elemento.id}')" class="w-6 h-6 bg-red-500 text-white rounded-full text-xs">×</button>
                        </div>
                    </div>
                `;
            }
            break;
        case 'imagen':
            if (elemento.value) {
                elementoDiv.innerHTML = `
                    <div class="relative group">
                        <img src="${elemento.value}" class="w-full h-full object-contain rounded-lg shadow-lg">
                        <div class="absolute -top-3 -right-3 flex gap-1 opacity-0 hover:opacity-100 transition-opacity">
                            <button onclick="subirImagen('${elemento.id}')" class="w-6 h-6 bg-blue-500 text-white rounded-full text-xs">✏️</button>
                            <button onclick="eliminarElemento('${elemento.id}')" class="w-6 h-6 bg-red-500 text-white rounded-full text-xs">×</button>
                        </div>
                    </div>
                `;
            } else {
                elementoDiv.innerHTML = `
                    <div class="relative group border-2 border-dashed border-gray-400 rounded-lg p-8 text-center bg-gray-50">
                        <div class="text-gray-500 text-sm">Haz clic para subir imagen</div>
                        <div class="absolute -top-3 -right-3 flex gap-1 opacity-0 hover:opacity-100 transition-opacity">
                            <button onclick="subirImagen('${elemento.id}')" class="w-6 h-6 bg-blue-500 text-white rounded-full text-xs">📷</button>
                            <button onclick="eliminarElemento('${elemento.id}')" class="w-6 h-6 bg-red-500 text-white rounded-full text-xs">×</button>
                        </div>
                    </div>
                `;
            }
            break;
    }

    // Hacer elemento arrastrable
    hacerArrastrable(elementoDiv, elemento);
    canvas.appendChild(elementoDiv);
}

// Actualizar texto editado
function actualizarTexto(id, nuevoTexto) {
    const elemento = elementos.find(e => e.id === id);
    if (elemento) {
        elemento.value = nuevoTexto;
        actualizarListaElementos();
    }
}

// Hacer elementos arrastrables
function hacerArrastrable(elementoDiv, elemento) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

    elementoDiv.onmousedown = dragMouseDown;

    function dragMouseDown(e) {
        // No iniciar arrastre si se hace clic en contenido editable
        if (e.target.classList.contains('editable-content')) {
            return;
        }

        e.preventDefault();
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        document.onmousemove = elementDrag;
        elementoSeleccionado = elemento;
        elementoDiv.classList.add('ring-2', 'ring-blue-500', 'z-50');
    }

    function elementDrag(e) {
        e.preventDefault();
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;

        elemento.position.x = elemento.position.x - pos1;
        elemento.position.y = elemento.position.y - pos2;

        elementoDiv.style.top = elemento.position.y + "px";
        elementoDiv.style.left = elemento.position.x + "px";
    }

    function closeDragElement() {
        document.onmouseup = null;
        document.onmousemove = null;
        elementoDiv.classList.remove('ring-2', 'ring-blue-500', 'z-50');
        actualizarListaElementos();
    }
}

// Editar icono
function editarIcono(id) {
    iconoEditando = id;
    const elemento = elementos.find(e => e.id === id);
    if (elemento) {
        // Limpiar inputs
        document.getElementById('inputIconoFA').value = elemento.value.startsWith('fas ') ? elemento.value : '';
        document.getElementById('inputIconoArchivo').value = '';

        document.getElementById('modalIcono').classList.remove('hidden');
    }
}

// Cerrar modal de icono
function cerrarModalIcono() {
    document.getElementById('modalIcono').classList.add('hidden');
    iconoEditando = null;
}

// Guardar icono
function guardarIcono() {
    if (!iconoEditando) return;

    const elemento = elementos.find(e => e.id === iconoEditando);
    const inputFA = document.getElementById('inputIconoFA').value.trim();
    const inputArchivo = document.getElementById('inputIconoArchivo').files[0];

    if (inputArchivo) {
        // Subir archivo de icono
        iconFiles[iconoEditando] = inputArchivo;
        const reader = new FileReader();
        reader.onload = ev => {
            elemento.value = ev.target.result;
            renderizarElemento(elemento);
            actualizarListaElementos();
            cerrarModalIcono();
        };
        reader.readAsDataURL(inputArchivo);
    } else if (inputFA) {
        // Usar Font Awesome
        elemento.value = inputFA;
        renderizarElemento(elemento);
        actualizarListaElementos();
        cerrarModalIcono();
    } else {
        alert('Por favor, sube un archivo de icono o ingresa un código Font Awesome');
    }
}

// Subir imagen para elemento
function subirImagen(id) {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = e => {
        const file = e.target.files[0];
        if (!file) return;

        const elemento = elementos.find(e => e.id === id);
        if (!elemento) return;

        imageFiles[id] = file;
        const reader = new FileReader();
        reader.onload = ev => {
            elemento.value = ev.target.result;
            renderizarElemento(elemento);
            actualizarListaElementos();
        };
        reader.readAsDataURL(file);
    };
    input.click();
}

// Eliminar elemento
function eliminarElemento(id) {
    if (confirm('¿Estás seguro de eliminar este elemento?')) {
        elementos = elementos.filter(e => e.id !== id);
        delete imageFiles[id];
        delete iconFiles[id];
        const elementoDiv = document.getElementById(id);
        if (elementoDiv) elementoDiv.remove();
        actualizarListaElementos();
    }
}

// Actualizar lista de elementos
function actualizarListaElementos() {
    const lista = document.getElementById('elementsList');
    lista.innerHTML = '';

    elementos.forEach(elemento => {
        const item = document.createElement('div');
        item.className = 'flex justify-between items-center p-2 bg-white border rounded text-sm';

        let texto = '';
        if (elemento.type === 'icono') {
            if (elemento.value.startsWith('data:')) {
                texto = 'Icono personalizado';
            } else if (elemento.value.startsWith('fas ')) {
                texto = elemento.value;
            } else {
                texto = 'Icono (sin definir)';
            }
        } else if (elemento.type === 'imagen' && elemento.value) {
            texto = 'Imagen subida';
        } else {
            texto = elemento.value.substring(0, 25) + (elemento.value.length > 25 ? '...' : '');
        }

        item.innerHTML = `
            <span class="truncate flex-1">${elemento.type}: ${texto}</span>
            <div class="flex gap-1">
                <button onclick="eliminarElemento('${elemento.id}')" class="text-red-500 text-xs">🗑️</button>
            </div>
        `;
        lista.appendChild(item);
    });
}

// Actualizar todo el canvas
function actualizarCanvas() {
    const canvas = document.getElementById('canvas');
    canvas.innerHTML = '';
    elementos.forEach(elemento => renderizarElemento(elemento));
}

// Controles de zoom
function zoomIn() {
    zoomLevel += 0.1;
    actualizarCanvas();
}

function zoomOut() {
    zoomLevel = Math.max(0.5, zoomLevel - 0.1);
    actualizarCanvas();
}

function resetCanvas() {
    zoomLevel = 1;
    actualizarCanvas();
}


// Guardar reconocimiento - VERSIÓN SIMPLIFICADA
async function guardarReconocimiento(estado) {
    const titulo = document.getElementById('reconocimientoTitulo').value;
    if (!titulo) return alert('El título es obligatorio');
    if (elementos.length === 0) return alert('Agrega al menos un elemento al canvas');

    // Preparar contenido SIMPLIFICADO
    const contenido = [
        {
            type: 'fondo',
            value: fondoActual
        }
    ];

    // Agregar elementos SIMPLIFICADOS
    elementos.forEach(elemento => {
        const elementoData = {
            type: elemento.type,
            value: elemento.value
        };

        // Solo incluir posición si es diferente de la predeterminada
        if (elemento.position &&
            (elemento.position.x !== 50 || elemento.position.y !== 50)) {
            elementoData.position = elemento.position;
        }

        // Solo incluir estilos CRÍTICOS, no todos
        const estilosCriticos = {};
        if (elemento.style && Object.keys(elemento.style).length > 0) {
            // Solo guardar estilos esenciales que no son los predeterminados
            const estilosPorDefecto = obtenerEstilosPorDefecto(elemento.type);
            Object.keys(elemento.style).forEach(key => {
                if (elemento.style[key] &&
                    elemento.style[key] !== estilosPorDefecto[key] &&
                    !ignorarEstilo(key)) {
                    estilosCriticos[key] = elemento.style[key];
                }
            });

            if (Object.keys(estilosCriticos).length > 0) {
                elementoData.style = estilosCriticos;
            }
        }

        // Para imágenes e iconos, incluir el ID para el manejo de archivos
        if ((elemento.type === 'imagen' || elemento.type === 'icono') &&
            (imageFiles[elemento.id] || iconFiles[elemento.id])) {
            elementoData.id = elemento.id;
        }

        contenido.push(elementoData);
    });

    const formData = new FormData();
    formData.append('titulo', titulo);
    formData.append('contenido', JSON.stringify(contenido));
    formData.append('estado', estado);

    // Agregar archivos de imagen e icono
    Object.entries(imageFiles).forEach(([id, file]) => {
        formData.append(`image_files[${id}]`, file);
    });

    Object.entries(iconFiles).forEach(([id, file]) => {
        formData.append(`image_files[${id}]`, file);
    });

    try {
        const res = await fetch("{{ route('reconocimientos.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await res.json();
        if (res.ok) {
            alert(data.message);
            location.href = "{{ route('reconocimientos.list') }}";
        } else {
            console.error('Error del servidor:', data);
            alert(data.message || 'Error al guardar');
        }
    } catch (err) {
        console.error('Error de conexión:', err);
        alert('Error de conexión: ' + err.message);
    }
}

// Función auxiliar para obtener estilos por defecto
function obtenerEstilosPorDefecto(tipo) {
    const estilos = {
        'titulo': {
            fontSize: '32px',
            fontWeight: 'bold',
            color: '#ffffff',
            backgroundColor: 'rgba(147, 51, 234, 0.9)',
            padding: '15px 25px',
            borderRadius: '12px',
            textAlign: 'center'
        },
        'subtitulo': {
            fontSize: '20px',
            fontWeight: '600',
            color: '#1f2937',
            backgroundColor: 'rgba(253, 230, 138, 0.95)',
            padding: '10px 20px',
            borderRadius: '8px',
            textAlign: 'center'
        },
        'texto': {
            fontSize: '16px',
            color: '#374151',
            backgroundColor: 'rgba(255, 255, 255, 0.95)',
            padding: '15px',
            borderRadius: '8px',
            maxWidth: '400px',
            lineHeight: '1.5'
        },
        'icono': {
            fontSize: '64px',
            color: '#f59e0b',
            width: '80px',
            height: '80px'
        },
        'imagen': {
            width: '200px',
            height: '200px',
            objectFit: 'contain'
        }
    };
    return estilos[tipo] || {};
}

function ignorarEstilo(propiedad) {
    const estilosIgnorar = [
        'cursor', 'display', 'alignItems', 'justifyContent',
        'transform', 'zIndex', 'transition', 'outline'
    ];
    return estilosIgnorar.includes(propiedad);
}

// Event listeners
document.getElementById('publishBtn').addEventListener('click', () => guardarReconocimiento('publicado'));
document.getElementById('saveDraftBtn').addEventListener('click', () => guardarReconocimiento('borrador'));

// Inicializar canvas
document.addEventListener('DOMContentLoaded', function() {
    cambiarFondoColor('#667eea');
});
</script>

<style>
#canvas {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: all 0.3s ease;
}

.element-content {
    word-wrap: break-word;
    max-width: 100%;
}

/* Scroll personalizado */
#elementsList::-webkit-scrollbar {
    width: 4px;
}

#elementsList::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#elementsList::-webkit-scrollbar-thumb {
    background: #c4b5fd;
    border-radius: 10px;
}

/* Mejorar la experiencia de edición */
[contenteditable="true"]:focus {
    outline: 2px solid #3b82f6;
    background-color: rgba(255, 255, 255, 0.95) !important;
}
</style>

<!-- Incluir Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
