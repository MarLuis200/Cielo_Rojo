<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambiente Cielo Rojo | @yield('title', 'Inicio')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="transition-colors duration-300 bg-white dark:bg-[#0f172a] text-gray-800 dark:text-[#f8fafc]">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600" x-data="{ open: false }">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/cielo2.png') }}" class="h-8 w-8 rounded-full" alt="Logo">
            <span class="self-center text-lg md:text-2xl font-semibold whitespace-nowrap text-gray-800 dark:text-white">Cielo Rojo</span>
        </a>


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
            <ul class="flex flex-col p-2 md:p-0 mt-2 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-6 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('landing.index') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('landing.proyectos') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Proyectos</a>
                </li>
                <li>
                    <a href="{{ route('landing.blogs') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Blogs</a>
                </li>
                <li>
                    <a href="{{ route('landing.galeria') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Galeria de Fotos</a>
                </li>
                <li>
                    <a href="{{ route('landing.quienes.somos') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">¿Quiénes Somos?</a>
                </li>
                <li>
                    <a href="{{ route('landing.quienes.somos') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Acerca De</a>
                </li>
                <li>
                    <a href="{{ route('landing.quienes.somos') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Premios</a>
                </li>
                <li>
                    <a href="{{ route('landing.quienes.somos') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Donaciones</a>
                </li>

            </ul>
        </div>

        <div class="hidden md:flex space-x-6">
            <a href="#" class="px-4 py-2 text-sm bg-blue-300 text-gray-800 dark:bg-gray-600 dark:text-white font-semibold rounded-full hover:bg-gray-300 dark:hover:bg-yellow-600 focus:outline-none transition duration-300 ease-in-out">Acceso</a>
        </div>
    </div>
</nav>


<main class="py-8">
    @yield('content')
</main>

<footer class="bg-gray-900 text-white py-6">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm">&copy; 2024 Ambiente Cielo Rojo. Todos los derechos reservados.</p>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="#" target="_blank"><img src="https://img.icons8.com/fluent/30/ffffff/facebook-new.png" alt="Facebook"></a>
            <a href="#" target="_blank"><img src="https://img.icons8.com/fluent/30/ffffff/linkedin-2.png" alt="LinkedIn"></a>
            <a href="#" target="_blank"><img src="https://img.icons8.com/fluent/30/ffffff/instagram-new.png" alt="Instagram"></a>
            <a href="#" target="_blank"><img src="https://img.icons8.com/fluent/30/ffffff/twitter.png" alt="Twitter"></a>
        </div>
    </div>
</footer>

</body>
</html>
