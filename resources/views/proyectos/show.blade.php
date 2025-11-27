@extends('layouts.dash2')

@section('content')

<div class="container mx-auto py-6" x-data="{ openModal: true }">

    <div x-show="openModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 bg-gray-900/50 flex items-center justify-center z-50 p-4">

        <div class="bg-white w-full max-w-6xl rounded-2xl shadow-2xl overflow-hidden"
             x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             @click.away="openModal = false">

            <!-- Header elegante -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-gray-200 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-sm">
                            <i class="fas fa-trophy text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $reconocimiento->titulo }}</h2>
                            <p class="text-sm text-gray-600 mt-1">Vista previa del reconocimiento</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium capitalize
                            {{ $reconocimiento->estado === 'publicado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $reconocimiento->estado }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="max-h-[80vh] overflow-y-auto custom-scrollbar">
                <!-- Poster del Reconocimiento -->
                <div class="p-8">
                    @php
                        // PROCESAMIENTO UNIFICADO - IGUAL QUE EN EDIT
                        $backgroundStyle = '';
                        $hasBackground = false;

                        // Buscar fondo en el contenido
                        foreach ($reconocimiento->contenido as $item) {
                            if ($item['type'] === 'fondo_color' && !empty($item['value'])) {
                                $backgroundStyle = "background: {$item['value']};";
                                $hasBackground = true;
                                break;
                            } elseif ($item['type'] === 'fondo_imagen' && !empty($item['value'])) {
                                $bgValue = $item['value'];
                                // Si es una URL con formato CSS, extraer la URL
                                if (Str::startsWith($bgValue, 'url')) {
                                    preg_match('/url\([\'"]([^\'"]+)[\'"]\)/', $bgValue, $matches);
                                    if ($matches && isset($matches[1])) {
                                        $bgValue = $matches[1];
                                    }
                                }
                                // Construir URL completa si es relativa
                                if (!Str::startsWith($bgValue, ['http://', 'https://', 'data:'])) {
                                    $bgValue = asset($bgValue);
                                }
                                // USAR EXACTAMENTE EL MISMO TAMAÑO QUE EN EDIT
                                $backgroundStyle = "background-image: url('{$bgValue}'); background-size: cover; background-position: center; background-repeat: no-repeat;";
                                $hasBackground = true;
                                break;
                            }
                        }

                        // Si no hay fondo definido, usar el mismo por defecto que en edit
                        if (!$hasBackground) {
                            $backgroundStyle = "background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);";
                        }
                    @endphp

                    <div class="reconocimiento-poster rounded-3xl overflow-hidden shadow-2xl border-8 border-white">
                        <!-- Canvas del reconocimiento - TAMAÑO FIJO EXACTO COMO EN EDIT -->
                        <div id="preview-canvas"
                             class="border-4 border-purple-200 rounded-2xl bg-white shadow-2xl w-full h-[600px] relative overflow-hidden"
                             style="{{ $backgroundStyle }}; width: 100%; height: 600px;">
                            <!-- Los elementos se renderizarán aquí con JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- El resto del código permanece igual -->
                <!-- Información detallada -->
                <div class="px-8 pb-8">
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                            Información del Reconocimiento
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-calendar-alt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Fecha de creación</p>
                                        <p class="font-medium text-gray-900">{{ $reconocimiento->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Estado</p>
                                        <p class="font-medium text-gray-900 capitalize">{{ $reconocimiento->estado }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-layer-group text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Elementos</p>
                                        <p class="font-medium text-gray-900">{{ count(array_filter($reconocimiento->contenido, function($item) { return !in_array($item['type'], ['fondo_color', 'fondo_imagen']); })) }} componentes</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Desglose de elementos -->
                        <div class="mt-6">
                            <h4 class="text-md font-semibold text-gray-900 mb-3">Elementos incluidos:</h4>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $elementosCount = [
                                        'titulo' => 0,
                                        'subtitulo' => 0,
                                        'texto' => 0,
                                        'icono' => 0,
                                        'imagen' => 0,
                                        'fondo_color' => 0,
                                        'fondo_imagen' => 0
                                    ];

                                    foreach ($reconocimiento->contenido as $item) {
                                        if (isset($elementosCount[$item['type']])) {
                                            $elementosCount[$item['type']]++;
                                        }
                                    }
                                @endphp

                                @foreach($elementosCount as $tipo => $cantidad)
                                    @if($cantidad > 0)
                                        @php
                                            $colors = [
                                                'titulo' => 'bg-blue-100 text-blue-800',
                                                'subtitulo' => 'bg-green-100 text-green-800',
                                                'texto' => 'bg-gray-100 text-gray-800',
                                                'icono' => 'bg-yellow-100 text-yellow-800',
                                                'imagen' => 'bg-purple-100 text-purple-800',
                                                'fondo_color' => 'bg-red-100 text-red-800',
                                                'fondo_imagen' => 'bg-indigo-100 text-indigo-800'
                                            ];
                                            $icons = [
                                                'titulo' => 'fas fa-heading',
                                                'subtitulo' => 'fas fa-text-width',
                                                'texto' => 'fas fa-paragraph',
                                                'icono' => 'fas fa-icons',
                                                'imagen' => 'fas fa-image',
                                                'fondo_color' => 'fas fa-palette',
                                                'fondo_imagen' => 'fas fa-landscape'
                                            ];
                                        @endphp
                                        <span class="px-3 py-2 rounded-lg text-sm font-medium {{ $colors[$tipo] }} flex items-center space-x-2">
                                            <i class="{{ $icons[$tipo] }} text-xs"></i>
                                            <span>{{ $cantidad }} {{ str_replace('_', ' ', $tipo) }}{{ $cantidad > 1 ? 's' : '' }}</span>
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Muestra las posiciones exactas de los elementos -->
                        <div class="mt-6">
                            <h4 class="text-md font-semibold text-gray-900 mb-3">Distribución de elementos:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($reconocimiento->contenido as $item)
                                    @if (!in_array($item['type'], ['fondo_color', 'fondo_imagen']))
                                        @php
                                            $position = $item['position'] ?? ['x' => 50, 'y' => 50];
                                        @endphp
                                        <div class="bg-white p-3 rounded-lg border border-gray-200 text-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="font-medium capitalize">{{ $item['type'] }}</span>
                                                <span class="text-gray-500 text-xs">Posición: {{ $position['x'] }}, {{ $position['y'] }}</span>
                                            </div>
                                            @if(!empty($item['value']))
                                                <p class="text-gray-600 mt-1 truncate">{{ Str::limit($item['value'], 50) }}</p>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer profesional -->
            <div class="bg-gray-50 border-t border-gray-200 px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-puzzle-piece"></i>
                            <span>{{ count(array_filter($reconocimiento->contenido, function($item) { return !in_array($item['type'], ['fondo_color', 'fondo_imagen']); })) }} elementos</span>
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-clock"></i>
                            <span>Actualizado: {{ $reconocimiento->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button
                            @click="window.location.href='{{ route('reconocimientos.list') }}'"
                            class="px-6 py-2 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors duration-200 font-medium">
                            Cerrar
                        </button>
                        <a href="{{ route('reconocimientos.edit', $reconocimiento->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2 shadow-sm">
                            <i class="fas fa-edit"></i>
                            <span>Editar</span>
                        </a>
                        <button
                            @click="window.location.href='{{ route('reconocimientos.list') }}'"
                            class="bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2 shadow-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Volver a reconocimientos</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
// USAR EL MISMO ENFOQUE EXACTO QUE EN EDIT
document.addEventListener('DOMContentLoaded', function() {
    const reconocimientoData = @json($reconocimiento);
    const contenido = reconocimientoData.contenido || [];
    const canvas = document.getElementById('preview-canvas');

    // ESTILOS POR DEFECTO IDÉNTICOS A LOS DE EDIT
    const estilosPorDefecto = {
        'titulo': {
            fontSize: '32px',
            fontWeight: 'bold',
            color: '#ffffff',
            backgroundColor: 'rgba(147, 51, 234, 0.9)',
            padding: '15px 25px',
            borderRadius: '12px',
            textAlign: 'center',
            cursor: 'text'
        },
        'subtitulo': {
            fontSize: '20px',
            fontWeight: '600',
            color: '#1f2937',
            backgroundColor: 'rgba(253, 230, 138, 0.95)',
            padding: '10px 20px',
            borderRadius: '8px',
            textAlign: 'center',
            cursor: 'text'
        },
        'texto': {
            fontSize: '16px',
            color: '#374151',
            backgroundColor: 'rgba(255, 255, 255, 0.95)',
            padding: '15px',
            borderRadius: '8px',
            maxWidth: '400px',
            cursor: 'text',
            lineHeight: '1.5'
        },
        'icono': {
            fontSize: '64px',
            color: '#f59e0b',
            cursor: 'pointer',
            width: '80px',
            height: '80px',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center'
        },
        'imagen': {
            width: '200px',
            height: '200px',
            objectFit: 'contain',
            cursor: 'pointer'
        }
    };

    // Función para obtener URL de imagen (igual que en EDIT)
    function obtenerUrlImagen(path) {
        if (!path) return '';
        if (path.startsWith('http') || path.startsWith('data:') || path.startsWith('//')) {
            return path;
        }
        if (path.startsWith('/storage/') || path.startsWith('storage/') || path.startsWith('uploads/')) {
            return "{{ url('/') }}" + (path.startsWith('/') ? '' : '/') + path;
        }
        if (path.startsWith('/')) {
            return "{{ url('/') }}" + path;
        }
        return "{{ url('/') }}/" + path;
    }

    // Renderizar cada elemento (EXACTAMENTE igual que en EDIT)
    contenido.forEach(item => {
        if (item.type !== 'fondo_color' && item.type !== 'fondo_imagen') {
            const elementoDiv = document.createElement('div');

            // CLASES EXACTAMENTE IGUALES A EDIT
            elementoDiv.className = 'absolute cursor-move transform transition-all duration-200 hover:shadow-2xl hover:z-50';

            // POSICIÓN EXACTA - SIN TRANSFORM SCALE
            elementoDiv.style.left = (item.position?.x || 50) + 'px';
            elementoDiv.style.top = (item.position?.y || 50) + 'px';
            elementoDiv.style.transform = 'scale(1)'; // Sin zoom en show
            elementoDiv.style.zIndex = '10';

            // Aplicar estilos por defecto primero (EXACTAMENTE igual que en EDIT)
            const estilosDefault = estilosPorDefecto[item.type] || {};
            Object.keys(estilosDefault).forEach(key => {
                elementoDiv.style[key] = estilosDefault[key];
            });

            // Aplicar estilos personalizados (EXACTAMENTE igual que en EDIT)
            if (item.style) {
                Object.keys(item.style).forEach(key => {
                    if (item.style[key]) {
                        elementoDiv.style[key] = item.style[key];
                    }
                });
            }

            // Contenido según el tipo (EXACTAMENTE igual que en EDIT)
            let value = item.value || '';

            // Manejar imágenes e iconos
            if ((item.type === 'imagen' || item.type === 'icono') && value) {
                value = obtenerUrlImagen(value);
            }

            if (item.type === 'titulo' || item.type === 'subtitulo' || item.type === 'texto') {
                const contentDiv = document.createElement('div');
                contentDiv.className = 'element-content editable-content';
                contentDiv.style.outline = 'none';
                contentDiv.style.minHeight = '100%';
                contentDiv.style.display = 'flex';
                contentDiv.style.alignItems = 'center';
                contentDiv.style.justifyContent = 'center';
                contentDiv.style.wordWrap = 'break-word';
                contentDiv.textContent = value;

                const wrapperDiv = document.createElement('div');
                wrapperDiv.className = 'relative h-full';
                wrapperDiv.appendChild(contentDiv);

                elementoDiv.appendChild(wrapperDiv);
            }
            else if (item.type === 'icono') {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.className = 'relative group';

                if (value.startsWith('fas ') || value.startsWith('far ') || value.startsWith('fab ') || value.startsWith('fal ')) {
                    const icon = document.createElement('i');
                    icon.className = value;
                    wrapperDiv.appendChild(icon);
                } else {
                    const img = document.createElement('img');
                    img.src = value;
                    img.className = 'w-full h-full object-contain';
                    img.onerror = function() {
                        this.style.display = 'none';
                        this.parentElement.innerHTML = '<div class="text-red-500 text-sm">Error cargando icono</div>';
                    };
                    wrapperDiv.appendChild(img);
                }
                elementoDiv.appendChild(wrapperDiv);
            }
            else if (item.type === 'imagen') {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.className = 'relative group';

                const img = document.createElement('img');
                img.src = value;
                img.className = 'w-full h-full object-contain rounded-lg shadow-lg';
                img.onerror = function() {
                    this.style.display = 'none';
                    this.parentElement.innerHTML = '<div class="text-red-500 text-sm">Error cargando imagen</div>';
                };
                wrapperDiv.appendChild(img);

                elementoDiv.appendChild(wrapperDiv);
            }

            canvas.appendChild(elementoDiv);
        }
    });
});
</script>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f8fafc;
    border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

.reconocimiento-poster {
    box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.1);
}

/* Estilos específicos para coincidir con edit */
.element-content {
    word-wrap: break-word;
    max-width: 100%;
}

/* FORZAR EL MISMO TAMAÑO EXACTO QUE EN EDIT */
#preview-canvas {
    width: 100% !important;
    height: 600px !important;
    min-height: 600px !important;
    max-height: 600px !important;
}
</style>

<!-- Incluir Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
