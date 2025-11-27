<!DOCTYPE html>
<html lang="es" x-data="{ theme: localStorage.getItem('theme') || 'light', open: false }" :class="{ 'dark': theme === 'dark' }" x-init="$watch('theme', val => localStorage.setItem('theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $reconocimiento->titulo }} - Reconocimiento</title>
    @vite('resources/css/app.css')
    @vite('resources/css/styles.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="transition-colors duration-500 bg-white dark:bg-gradient-to-br dark:from-[#0f172a] dark:to-[#1e293b] text-gray-800 dark:text-[#f8fafc] font-poppins">

<!-- Navbar -->
<nav class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm fixed w-full z-50 top-0 start-0 border-b border-gray-200/50 dark:border-gray-600/50 shadow-sm" x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.pageYOffset > 10">
    <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex items-center space-x-2 rtl:space-x-reverse mr-auto group">
            <a href="{{ route('landing.index') }}">
                <img src="{{ asset('img/cielo2.png') }}" class="h-10 w-10 rounded-full transform group-hover:scale-110 transition-transform duration-300" alt="Logo">
            </a>
            <span class="self-center text-xl md:text-2xl font-bold whitespace-nowrap text-gray-800 dark:text-white"> Ambiente <span class="text-red-600">Cielo Rojo</span></span>
        </div>

        <div class="flex items-center space-x-3 md:space-x-6 md:order-2">
            <button @click="open = !open" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5h14a1 1 0 110 2H3a1 1 0 110-2zm0 6h14a1 1 0 110 2H3a1 1 0 110-2zm0 6h14a1 1 0 110 2H3a1 1 0 110-2z" clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd" d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 011.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div :class="open ? 'block' : 'hidden'" class="w-full md:flex md:items-center md:w-auto md:justify-center" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                <li><a href="{{ route('landing.proyectos') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Proyectos</a></li>
                <li><a href="{{ route('landing.blogs') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Blogs</a></li>
                <li><a href="{{ route('reconocimientos.index') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Reconocimientos</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido Principal del Reconocimiento -->
<div class="pt-24 pb-12 px-4">
    <!-- Poster del Reconocimiento -->
    <div class="max-w-6xl mx-auto" data-aos="zoom-in">
        <div class="reconocimiento-poster rounded-3xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
            <!-- Canvas del reconocimiento que replica el diseño creado -->
            @php
                $backgroundStyle = '';
                $hasBackground = false;

                // Primero procesamos los fondos
                foreach ($reconocimiento->contenido as $item) {
                    if ($item['type'] === 'fondo_color' && !empty($item['value'])) {
                        $backgroundStyle = "background: {$item['value']};";
                        $hasBackground = true;
                        break;
                    } elseif ($item['type'] === 'fondo_imagen' && !empty($item['value'])) {
                        // Extraer la URL de fondo del formato "url('...')"
                        $fondoValue = $item['value'];
                        if (str_starts_with($fondoValue, 'url')) {
                            $backgroundStyle = "background-image: {$fondoValue}; background-size: cover; background-position: center;";
                        } else {
                            $backgroundStyle = "background-image: url('" . asset($fondoValue) . "'); background-size: cover; background-position: center;";
                        }
                        $hasBackground = true;
                        break;
                    }
                }

                // Si no hay fondo definido, usamos uno por defecto
                if (!$hasBackground) {
                    $backgroundStyle = "background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);";
                }
            @endphp

            <div class="poster-canvas min-h-[70vh] relative overflow-hidden" style="{{ $backgroundStyle }}">
                <!-- Renderizar todos los elementos en sus posiciones guardadas -->
                @foreach ($reconocimiento->contenido as $item)
                    @php
                        // Saltar el fondo ya que ya lo procesamos
                        if (in_array($item['type'], ['fondo', 'fondo_color', 'fondo_imagen'])) continue;

                        // Obtener posición y estilo
                        $position = $item['position'] ?? ['x' => 50, 'y' => 50];
                        $style = $item['style'] ?? [];
                        $elementStyle = '';

                        // Construir estilos CSS
                        foreach ($style as $prop => $value) {
                            if (!empty($value)) {
                                $elementStyle .= "{$prop}: {$value}; ";
                            }
                        }

                        // Añadir posición absoluta
                        $elementStyle .= "position: absolute; left: {$position['x']}px; top: {$position['y']}px;";
                    @endphp

                    @if ($item['type'] === 'titulo' && !empty($item['value']))
                        <div class="elemento-titulo" style="{{ $elementStyle }}" data-aos="fade-up">
                            <div class="elemento-contenido">
                                {{ $item['value'] }}
                            </div>
                        </div>
                    @elseif ($item['type'] === 'subtitulo' && !empty($item['value']))
                        <div class="elemento-subtitulo" style="{{ $elementStyle }}" data-aos="fade-up" data-aos-delay="100">
                            <div class="elemento-contenido">
                                {{ $item['value'] }}
                            </div>
                        </div>
                    @elseif ($item['type'] === 'texto' && !empty($item['value']))
                        <div class="elemento-texto" style="{{ $elementStyle }}" data-aos="fade-up" data-aos-delay="200">
                            <div class="elemento-contenido">
                                {!! nl2br(e($item['value'])) !!}
                            </div>
                        </div>
                    @elseif ($item['type'] === 'icono' && !empty($item['value']))
                        <div class="elemento-icono" style="{{ $elementStyle }}" data-aos="zoom-in" data-aos-delay="300">
                            <div class="elemento-contenido">
                                @if (str_starts_with($item['value'], 'fas ') || str_starts_with($item['value'], 'fab ') || str_starts_with($item['value'], 'far '))
                                    <i class="{{ $item['value'] }}"></i>
                                @else
                                    <img src="{{ asset($item['value']) }}" alt="Icono" class="w-full h-full object-contain">
                                @endif
                            </div>
                        </div>
                    @elseif ($item['type'] === 'imagen' && !empty($item['value']))
                        <div class="elemento-imagen" style="{{ $elementStyle }}" data-aos="fade-up" data-aos-delay="400">
                            <div class="elemento-contenido">
                                <img src="{{ asset($item['value']) }}"
                                     alt="Imagen de reconocimiento"
                                     class="w-full h-full object-contain rounded-lg shadow-lg">
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Título principal del reconocimiento (si no existe como elemento) -->
                @php
                    $hasTituloElement = false;
                    foreach ($reconocimiento->contenido as $item) {
                        if ($item['type'] === 'titulo') {
                            $hasTituloElement = true;
                            break;
                        }
                    }
                @endphp

                @if (!$hasTituloElement)
                    <div class="absolute top-8 left-0 right-0 text-center" data-aos="fade-down">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white drop-shadow-2xl bg-black/30 px-8 py-4 rounded-2xl inline-block">
                            {{ $reconocimiento->titulo }}
                        </h1>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="max-w-4xl mx-auto mt-12" data-aos="fade-up">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="space-y-2">
                    <div class="text-2xl text-purple-600">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-white">Fecha</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ $reconocimiento->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="text-2xl text-green-600">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-white">Estado</h3>
                    <p class="text-gray-600 dark:text-gray-300 capitalize">
                        {{ $reconocimiento->estado }}
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="text-2xl text-blue-600">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-white">Tipo</h3>
                    <p class="text-gray-600 dark:text-gray-300">Reconocimiento</p>
                </div>
            </div>

            <!-- Estadísticas de elementos -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Elementos incluidos:</h4>
                <div class="flex flex-wrap gap-2 justify-center">
                    @php
                        $elementosCount = [
                            'titulo' => 0,
                            'subtitulo' => 0,
                            'texto' => 0,
                            'icono' => 0,
                            'imagen' => 0
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
                                    'imagen' => 'bg-purple-100 text-purple-800'
                                ];
                                $icons = [
                                    'titulo' => 'fas fa-heading',
                                    'subtitulo' => 'fas fa-text-width',
                                    'texto' => 'fas fa-paragraph',
                                    'icono' => 'fas fa-icons',
                                    'imagen' => 'fas fa-image'
                                ];
                            @endphp
                            <span class="px-3 py-2 rounded-lg text-sm font-medium {{ $colors[$tipo] }} flex items-center space-x-2">
                                <i class="{{ $icons[$tipo] }} text-xs"></i>
                                <span>{{ $cantidad }} {{ $tipo }}{{ $cantidad > 1 ? 's' : '' }}</span>
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="max-w-4xl mx-auto mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('reconocimientos.index') }}"
               class="px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:from-purple-600 hover:to-indigo-600 transition duration-300 shadow-lg flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver a Reconocimientos
            </a>

            <button onclick="window.print()"
                    class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 transition duration-300 shadow-lg flex items-center gap-2">
                <i class="fas fa-print"></i>
                Imprimir Reconocimiento
            </button>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="mt-12 bg-gray-900 text-white py-8">
    <div class="max-w-6xl mx-auto text-center">
        <div class="flex justify-center space-x-6 mb-4">
            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                <i class="fab fa-facebook text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                <i class="fab fa-twitter text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                <i class="fab fa-instagram text-xl"></i>
            </a>
        </div>
        <p class="text-gray-400">&copy; 2025 Cielo Rojo. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 800,
        offset: 50
    });
</script>

<style>
    .reconocimiento-poster {
        border: 8px solid white;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .poster-canvas {
        background-blend-mode: overlay;
        min-height: 600px;
    }

    .elemento-contenido {
        word-wrap: break-word;
        white-space: pre-wrap;
        max-width: 100%;
    }

    /* Estilos para impresión */
    @media print {
        nav, footer, .bg-white\\/80, .max-w-4xl.mx-auto.mt-8 {
            display: none !important;
        }

        .reconocimiento-poster {
            box-shadow: none !important;
            border: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .poster-canvas {
            min-height: 100vh !important;
            padding: 2cm !important;
        }

        .elemento-contenido {
            break-inside: avoid;
        }
    }

    /* Asegurar que los elementos se vean bien */
    .elemento-titulo .elemento-contenido {
        font-weight: bold;
        text-align: center;
        padding: 15px 25px;
        border-radius: 12px;
    }

    .elemento-subtitulo .elemento-contenido {
        font-weight: 600;
        text-align: center;
        padding: 10px 20px;
        border-radius: 8px;
    }

    .elemento-texto .elemento-contenido {
        padding: 15px;
        border-radius: 8px;
        line-height: 1.5;
    }

    .elemento-icono .elemento-contenido {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .elemento-imagen .elemento-contenido {
        width: 100%;
        height: 100%;
    }
</style>

</body>
</html>
