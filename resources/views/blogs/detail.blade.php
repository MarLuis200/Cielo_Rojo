<!DOCTYPE html>
<html lang="es" x-data="{ theme: localStorage.getItem('theme') || 'light', open: false }" :class="{ 'dark': theme === 'dark' }" x-init="$watch('theme', val => localStorage.setItem('theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->titulo }} - Detalle del Blog</title>
    @vite('resources/css/app.css')
    @vite('resources/css/styles.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="transition-colors duration-500 bg-white dark:bg-gradient-to-br dark:from-[#0f172a] dark:to-[#1e293b] text-gray-800 dark:text-[#f8fafc] font-poppins">

<!-- Navbar responsiva igual que index -->
<nav class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm fixed w-full z-50 top-0 start-0 border-b border-gray-200/50 dark:border-gray-600/50 shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl flex items-center justify-between mx-auto p-4">
        <a href="{{ route('landing.index') }}" class="font-bold text-xl md:text-2xl text-red-600">Ambiente Cielo Rojo</a>

        <button @click="open = !open" type="button" class="md:hidden p-2 text-gray-500 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <ul :class="open ? 'block' : 'hidden'" class="absolute md:static top-16 left-0 w-full md:w-auto bg-white dark:bg-gray-900 md:flex md:space-x-6 p-4 md:p-0 border-t md:border-0 border-gray-200 dark:border-gray-700 md:dark:border-0">
            <li><a href="{{ route('landing.proyectos') }}" class="block py-2 md:py-0 text-gray-900 dark:text-white hover:text-red-600">Proyectos</a></li>
            <li><a href="{{ route('landing.blogs') }}" class="block py-2 md:py-0 text-gray-900 dark:text-white hover:text-red-600">Blogs</a></li>
        </ul>
    </div>
</nav>

<!-- Hero / Título del blog -->
<div class="pt-28 text-center px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">{{ $blog->titulo }}</h1>
    <p class="text-gray-600 dark:text-gray-300 italic">Publicado el: {{ $blog->created_at->format('d M Y') }}</p>
</div>

<!-- Contenido completo del blog -->
<div class="max-w-6xl mx-auto mt-12 px-4 space-y-8">
    @foreach ($blog->contenido as $item)
        @if ($item['type'] === 'text')
            <div data-aos="fade-up" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="leading-relaxed">{{ $item['value'] }}</p>
            </div>
        @elseif ($item['type'] === 'image')
            <div data-aos="zoom-in" class="overflow-hidden rounded-lg shadow-md">
                <img src="{{ asset($item['value']) }}" alt="Imagen del blog" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
            </div>
        @elseif ($item['type'] === 'video')
            <div data-aos="fade-up" class="rounded-lg shadow-md overflow-hidden">
                <video controls class="w-full h-auto rounded-lg">
                    <source src="{{ asset($item['value']) }}" type="video/mp4">
                    Tu navegador no soporta este video.
                </video>
            </div>
        @endif
    @endforeach
</div>

<!-- Footer -->
<footer class="mt-12 bg-gray-900 text-white py-6">
    <div class="max-w-6xl mx-auto text-center">
        &copy; 2025 Ambiente Cielo Rojo. Todos los derechos reservados.
    </div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 800 });
</script>
</body>
</html>
