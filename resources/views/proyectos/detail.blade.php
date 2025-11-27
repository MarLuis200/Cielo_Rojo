<!DOCTYPE html>
<html lang="es" x-data="{ theme: localStorage.getItem('theme') || 'light', open: false }" :class="{ 'dark': theme === 'dark' }" x-init="$watch('theme', val => localStorage.setItem('theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proyecto->nombre }} - Detalle del Proyecto</title>
    @vite('resources/css/app.css')
    @vite('resources/css/styles.css')
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="transition-colors duration-500 bg-white dark:bg-gradient-to-br dark:from-[#0f172a] dark:to-[#1e293b] text-gray-800 dark:text-[#f8fafc] font-poppins">

<!-- Navbar igual que en index -->
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

            </ul>
        </div>
    </div>
</nav>

<!-- Hero / Título del proyecto -->
<div class="pt-28 text-center px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">{{ $proyecto->nombre }}</h1>
</div>

<!-- Contenido completo del proyecto -->
<div class="max-w-6xl mx-auto mt-12 px-4 space-y-8">
    @foreach ($proyecto->contenido as $item)
        @if ($item['type'] === 'text')
            <div data-aos="fade-up" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="text-gray-800 dark:text-gray-100 leading-relaxed">{{ $item['value'] }}</p>
            </div>
        @elseif ($item['type'] === 'image')
            <div data-aos="zoom-in" class="overflow-hidden rounded-lg shadow-md">
                <img src="{{ asset($item['value']) }}" alt="Imagen del proyecto" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
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

<!-- Footer simple -->
<footer class="mt-12 bg-gray-900 text-white py-6">
    <div class="max-w-6xl mx-auto text-center">
        &copy; 2025 Cielo Rojo. Todos los derechos reservados.
    </div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 800 });
</script>

</body>
</html>
