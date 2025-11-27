@extends('layouts.dash2')

@section('content')
<div class="container mx-auto p-4">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">🏆 Mis Reconocimientos</h1>
        <a href="{{ route('reconocimientos.create') }}"
           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition duration-300 shadow-lg">
            ➕ Crear Reconocimiento
        </a>
    </div>

    {{-- ===============================
        RECONOCIMIENTOS PUBLICADOS
    =============================== --}}
    <div class="mb-12">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-4 h-8 bg-green-500 rounded-full"></div>
            <h2 class="text-2xl font-semibold text-green-700">Publicados</h2>
            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $publicados->count() }}
            </span>
        </div>

        @if($publicados->isEmpty())
            <div class="bg-green-50 border border-green-200 rounded-2xl p-8 text-center">
                <div class="text-5xl text-green-400 mb-4">
                    <i class="fas fa-trophy"></i>
                </div>
                <p class="text-green-700 text-lg mb-2">No hay reconocimientos publicados</p>
                <p class="text-green-600">Crea tu primer reconocimiento para mostrarlo al público</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($publicados as $reconocimiento)
                    @php
                        $fondoColor = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                        $fondoImagen = null;
                        $elementos = [];

                        if (is_array($reconocimiento->contenido)) {
                            foreach ($reconocimiento->contenido as $item) {
                                if ($item['type'] === 'fondo_color') {
                                    $fondoColor = $item['value'];
                                } elseif ($item['type'] === 'fondo_imagen') {
                                    $fondoImagen = $item['value'];
                                    // Si es una URL con formato CSS, extraer la URL
                                    if (Str::startsWith($fondoImagen, 'url')) {
                                        preg_match('/url\([\'"]([^\'"]+)[\'"]\)/', $fondoImagen, $matches);
                                        if ($matches && isset($matches[1])) {
                                            $fondoImagen = $matches[1];
                                        }
                                    }
                                    // Construir URL completa si es relativa
                                    if ($fondoImagen && !Str::startsWith($fondoImagen, ['http://', 'https://', 'data:'])) {
                                        $fondoImagen = asset($fondoImagen);
                                    }
                                } elseif (in_array($item['type'], ['titulo', 'subtitulo', 'texto', 'imagen', 'icono'])) {
                                    $elementos[] = $item;
                                }
                            }
                        }

                        // Preparar el estilo de fondo
                        $backgroundStyle = '';
                        if ($fondoImagen) {
                            $backgroundStyle = "background-image: url('{$fondoImagen}'); background-size: cover; background-position: center;";
                        } else {
                            $backgroundStyle = "background: {$fondoColor};";
                        }
                    @endphp

                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">

                        {{-- MINIATURA COMPLETA DEL RECONOCIMIENTO --}}
                        <div class="h-64 relative overflow-hidden" style="{{ $backgroundStyle }}">
                            {{-- Renderizar todos los elementos del reconocimiento --}}
                            @foreach($elementos as $elemento)
                                @php
                                    $style = 'position: absolute; ';
                                    $position = $elemento['position'] ?? ['x' => 50, 'y' => 50];
                                    $elementStyle = $elemento['style'] ?? [];

                                    $style .= "left: {$position['x']}px; top: {$position['y']}px; ";

                                    // Aplicar estilos del elemento
                                    foreach ($elementStyle as $propiedad => $valor) {
                                        if (!in_array($propiedad, ['cursor', 'transform', 'transition', 'zIndex'])) {
                                            $style .= "{$propiedad}: {$valor}; ";
                                        }
                                    }

                                    // Escalar para la miniatura (reducir tamaño)
                                    $style .= "transform: scale(0.4); transform-origin: top left;";
                                @endphp

                                <div style="{{ $style }}">
                                    @if($elemento['type'] === 'imagen' && $elemento['value'])
                                        @php
                                            $imagenSrc = $elemento['value'];
                                            if (!Str::startsWith($imagenSrc, ['http://', 'https://', 'data:'])) {
                                                $imagenSrc = asset($imagenSrc);
                                            }
                                        @endphp
                                        <img src="{{ $imagenSrc }}"
                                             style="width: 100%; height: 100%; object-fit: contain;"
                                             onerror="this.style.display='none'">

                                    @elseif($elemento['type'] === 'icono' && $elemento['value'])
                                        @if(Str::startsWith($elemento['value'], ['fas ', 'far ', 'fab ', 'fal ']))
                                            <i class="{{ $elemento['value'] }}"></i>
                                        @else
                                            @php
                                                $iconoSrc = $elemento['value'];
                                                if (!Str::startsWith($iconoSrc, ['http://', 'https://', 'data:'])) {
                                                    $iconoSrc = asset($iconoSrc);
                                                }
                                            @endphp
                                            <img src="{{ $iconoSrc }}"
                                                 style="width: 100%; height: 100%; object-fit: contain;"
                                                 onerror="this.style.display='none'">
                                        @endif

                                    @elseif(in_array($elemento['type'], ['titulo', 'subtitulo', 'texto']))
                                        <div style="word-wrap: break-word; white-space: pre-wrap;">
                                            {{ $elemento['value'] }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            {{-- Overlay para mejor visibilidad --}}
                            <div class="absolute inset-0 bg-black/10"></div>

                            {{-- BADGE PUBLICADO --}}
                            <div class="absolute top-3 right-3">
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow">
                                    Publicado
                                </span>
                            </div>

                            {{-- Indicador de que es una miniatura --}}
                            <div class="absolute bottom-3 left-3">
                                <span class="bg-black/50 text-white px-2 py-1 rounded text-xs backdrop-blur-sm">
                                    Vista previa
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            {{-- TÍTULO --}}
                            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                                {{ $reconocimiento->titulo }}
                            </h3>

                            {{-- CONTADOR DE ELEMENTOS --}}
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <i class="fas fa-layer-group mr-2"></i>
                                {{ count($elementos) }} elementos
                            </div>

                            {{-- FECHA --}}
                            <div class="flex items-center text-gray-500 text-sm mb-4">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ $reconocimiento->created_at->format('d M Y') }}
                            </div>

                            {{-- BOTONES --}}
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('reconocimientos.show', $reconocimiento->id) }}"
                                   class="flex-1 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 text-center text-sm font-medium">
                                    <i class="fas fa-eye mr-1"></i> Ver
                                </a>

                                <a href="{{ route('reconocimientos.edit', $reconocimiento->id) }}"
                                   class="flex-1 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-300 text-center text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </a>

                                <form action="{{ route('reconocimientos.destroy', $reconocimiento->id) }}"
                                      method="POST"
                                      class="flex-1"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este reconocimiento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 text-center text-sm font-medium">
                                        <i class="fas fa-trash mr-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ===============================
        BORRADORES
    =============================== --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-4 h-8 bg-yellow-500 rounded-full"></div>
            <h2 class="text-2xl font-semibold text-yellow-600">Borradores</h2>
            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $borradores->count() }}
            </span>
        </div>

        @if($borradores->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-8 text-center">
                <div class="text-5xl text-yellow-400 mb-4">
                    <i class="fas fa-edit"></i>
                </div>
                <p class="text-yellow-700 text-lg mb-2">No hay borradores</p>
                <p class="text-yellow-600">Guarda tus reconocimientos como borrador para editarlos más tarde</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($borradores as $reconocimiento)
                    @php
                        $fondoColor = 'linear-gradient(135deg, #a8a8a8 0%, #696969 100%)';
                        $fondoImagen = null;
                        $elementos = [];

                        if (is_array($reconocimiento->contenido)) {
                            foreach ($reconocimiento->contenido as $item) {
                                if ($item['type'] === 'fondo_color') {
                                    $fondoColor = $item['value'];
                                } elseif ($item['type'] === 'fondo_imagen') {
                                    $fondoImagen = $item['value'];
                                    // Si es una URL con formato CSS, extraer la URL
                                    if (Str::startsWith($fondoImagen, 'url')) {
                                        preg_match('/url\([\'"]([^\'"]+)[\'"]\)/', $fondoImagen, $matches);
                                        if ($matches && isset($matches[1])) {
                                            $fondoImagen = $matches[1];
                                        }
                                    }
                                    // Construir URL completa si es relativa
                                    if ($fondoImagen && !Str::startsWith($fondoImagen, ['http://', 'https://', 'data:'])) {
                                        $fondoImagen = asset($fondoImagen);
                                    }
                                } elseif (in_array($item['type'], ['titulo', 'subtitulo', 'texto', 'imagen', 'icono'])) {
                                    $elementos[] = $item;
                                }
                            }
                        }

                        // Preparar el estilo de fondo
                        $backgroundStyle = '';
                        if ($fondoImagen) {
                            $backgroundStyle = "background-image: url('{$fondoImagen}'); background-size: cover; background-position: center;";
                        } else {
                            $backgroundStyle = "background: {$fondoColor};";
                        }
                    @endphp

                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 opacity-90">

                        {{-- MINIATURA COMPLETA DEL BORRADOR --}}
                        <div class="h-64 relative overflow-hidden" style="{{ $backgroundStyle }}">
                            {{-- Renderizar todos los elementos del borrador --}}
                            @foreach($elementos as $elemento)
                                @php
                                    $style = 'position: absolute; ';
                                    $position = $elemento['position'] ?? ['x' => 50, 'y' => 50];
                                    $elementStyle = $elemento['style'] ?? [];

                                    $style .= "left: {$position['x']}px; top: {$position['y']}px; ";

                                    // Aplicar estilos del elemento
                                    foreach ($elementStyle as $propiedad => $valor) {
                                        if (!in_array($propiedad, ['cursor', 'transform', 'transition', 'zIndex'])) {
                                            $style .= "{$propiedad}: {$valor}; ";
                                        }
                                    }

                                    // Escalar para la miniatura (reducir tamaño)
                                    $style .= "transform: scale(0.4); transform-origin: top left;";
                                @endphp

                                <div style="{{ $style }}">
                                    @if($elemento['type'] === 'imagen' && $elemento['value'])
                                        @php
                                            $imagenSrc = $elemento['value'];
                                            if (!Str::startsWith($imagenSrc, ['http://', 'https://', 'data:'])) {
                                                $imagenSrc = asset($imagenSrc);
                                            }
                                        @endphp
                                        <img src="{{ $imagenSrc }}"
                                             style="width: 100%; height: 100%; object-fit: contain;"
                                             onerror="this.style.display='none'">

                                    @elseif($elemento['type'] === 'icono' && $elemento['value'])
                                        @if(Str::startsWith($elemento['value'], ['fas ', 'far ', 'fab ', 'fal ']))
                                            <i class="{{ $elemento['value'] }}"></i>
                                        @else
                                            @php
                                                $iconoSrc = $elemento['value'];
                                                if (!Str::startsWith($iconoSrc, ['http://', 'https://', 'data:'])) {
                                                    $iconoSrc = asset($iconoSrc);
                                                }
                                            @endphp
                                            <img src="{{ $iconoSrc }}"
                                                 style="width: 100%; height: 100%; object-fit: contain;"
                                                 onerror="this.style.display='none'">
                                        @endif

                                    @elseif(in_array($elemento['type'], ['titulo', 'subtitulo', 'texto']))
                                        <div style="word-wrap: break-word; white-space: pre-wrap;">
                                            {{ $elemento['value'] }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            {{-- Overlay para mejor visibilidad --}}
                            <div class="absolute inset-0 bg-black/20"></div>

                            {{-- BADGE BORRADOR --}}
                            <div class="absolute top-3 right-3">
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow">
                                    Borrador
                                </span>
                            </div>

                            {{-- Indicador de que es una miniatura --}}
                            <div class="absolute bottom-3 left-3">
                                <span class="bg-black/50 text-white px-2 py-1 rounded text-xs backdrop-blur-sm">
                                    Vista previa
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            {{-- TÍTULO --}}
                            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                                {{ $reconocimiento->titulo }}
                            </h3>

                            {{-- CONTADOR DE ELEMENTOS --}}
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <i class="fas fa-layer-group mr-2"></i>
                                {{ count($elementos) }} elementos
                            </div>

                            {{-- FECHA --}}
                            <div class="flex items-center text-gray-500 text-sm mb-4">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ $reconocimiento->created_at->format('d M Y') }}
                            </div>

                            {{-- BOTONES --}}
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('reconocimientos.show', $reconocimiento->id) }}"
                                   class="flex-1 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 text-center text-sm font-medium">
                                    <i class="fas fa-eye mr-1"></i> Ver
                                </a>

                                <a href="{{ route('reconocimientos.edit', $reconocimiento->id) }}"
                                   class="flex-1 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-300 text-center text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </a>

                                <form action="{{ route('reconocimientos.destroy', $reconocimiento->id) }}"
                                      method="POST"
                                      class="flex-1"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este borrador?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 text-center text-sm font-medium">
                                        <i class="fas fa-trash mr-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.transform {
    transition: all 0.3s ease;
}

.hover\:-translate-y-1:hover {
    transform: translateY(-4px);
}

/* Mejorar la visualización de elementos en miniatura */
.miniatura-elemento {
    pointer-events: none;
}
</style>

<!-- Incluir Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
