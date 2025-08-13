<!DOCTYPE html>
<html lang="es" x-data="{ theme: localStorage.getItem('theme') || 'light', open: false }" :class="{ 'dark': theme === 'dark' }" x-init="$watch('theme', val => localStorage.setItem('theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambiente Cielo Rojo</title>
    @vite('resources/css/app.css')
    @vite('resources/css/styles.css')
    @vite('resources/js/script.js')
    <script src="{{ asset('js/carousel.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body class="transition-colors duration-300 bg-white dark:bg-[#0f172a] text-gray-800 dark:text-[#f8fafc]">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600" x-data="{ open: false }">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <a href="#" class="flex items-center space-x-0 rtl:space-x-reverse mr-auto">
            <img src="{{ asset('img/cielo2.png') }}" class="h-8 w-8 rounded-full" alt="Logo">
            <span class="self-center text-lg md:text-2xl font-semibold whitespace-nowrap text-gray-800 dark:text-white">CieloRojo</span>
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
                    <a href="{{ route('landing.acerca') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Acerca De</a>
                </li>
                <li>
                    <a href="{{ route('landing.premios') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Pemios</a>
                </li>
                <li>
                    <a href="{{ route('landing.donaciones') }}" class="block py-1 px-3 text-gray-900 dark:text-white hover:text-yellow-400 dark:hover:text-yellow-300 md:p-0 transition duration-300">Donaciones</a>
                </li>

                <li>
                    <button @click="theme = theme === 'light' ? 'dark' : 'light'" class="p-2 rounded-full bg-gray-200 dark:bg-gray-800 transition duration-300 ease-in-out focus:outline-none">
                        <svg x-show="theme === 'light'" class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 5a5 5 0 000 10 5 5 0 000-10zm0-3a1 1 0 110 2h-.02a1 1 0 010-2H10zm0 16a1 1 0 110 2h-.02a1 1 0 010-2H10zm9-9a1 1 0 110 2v-.02a1 1 0 110-2V10zm-16 0a1 1 0 110 2H3a1 1 0 010-2h.02zM15.45 6.14a1 1 0 011.41 0l.02.02a1 1 0 010 1.41L16.88 8a1 1 0 11-1.41-1.42l-.02-.02zM4.12 13.76a1 1 0 110 1.42l-.02.02a1 1 0 01-1.41 0L2 14.17a1 1 0 111.42-1.41l.02.02z"/>
                        </svg>
                        <svg x-show="theme === 'dark'" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 1a9 9 0 000 18 9 9 0 000-18zm1 16V3a7 7 0 010 14z"/>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>

        <div class="hidden md:flex space-x-4 mr-auto"></div>


        <div class="hidden md:flex space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm bg-blue-300 text-gray-800 dark:bg-gray-600 dark:text-white font-semibold rounded-full hover:bg-green-600 dark:hover:bg-yellow-600 focus:outline-none transition duration-300 ease-in-out">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-yellow-300 text-gray-800 dark:bg-gray-600 dark:text-white font-semibold rounded-full hover:bg-pink-400 dark:hover:bg-yellow-600 focus:outline-none transition duration-300 ease-in-out">Registro</a>
        </div>
    </div>
</nav>

    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg">
        <ul class="space-y-4 p-6 text-black">
            <li><a href="{{ route('landing.index') }}" class="block transition">Inicio</a></li>
            <li><a href="{{ route('landing.proyectos') }}" class="block transition">Proyectos</a></li>
            <li><a href="{{ route('landing.blogs') }}" class="block transition">Blogs</a></li>
            <li><a href="{{ route('landing.galeria') }}" class="block transition">Galería De Fotos</a></li>
            <li><a href="{{ route('landing.acerca') }}" class="block transition">Acerca de</a></li>
            <li><a href="{{ route('landing.quienes.somos') }}" class="block transition">¿Quiénes Somos?</a></li>
            <li><a href="{{ route('landing.premios') }}" class="block transition">Premios</a></li>
            <li><a href="{{ route('landing.donaciones') }}" class="block transition">Donaciones</a></li>
        </ul>
    </div>
</header>

<main class="relative">
    <section class="h-screen bg-black relative">
        <div class="absolute inset-0">
            <img src="{{ asset('img/fondo.jpg') }}" alt="Background" class="w-full h-full object-cover">
        </div>
<div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-6 md:p-10">
<h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-10xl font-extrabold text-white text-center">
    Donaciones
</h1>

</div>
    </section>
<section class="h-screen bg-black relative">
    <div class="absolute inset-0">
        <img src="{{ asset('img/fondo5.jpg') }}" alt="Background" class="w-full h-full object-cover">
    </div>
<div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-6 md:p-10">
        <!-- Tarjeta con información de donaciones -->
        <div class="bg-gray-800 bg-opacity-90 p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-semibold text-white text-center px-4 mb-6">
                ¡Apoya nuestra causa con tu donación!
            </h2>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl text-white text-center px-4 mb-4">
                Si deseas apoyar nuestra labor, puedes hacerlo a través de una donación directa a nuestra cuenta bancaria. Tu contribución nos permitirá continuar con nuestro trabajo de investigación, conservación y defensa del patrimonio natural.
            </p>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl text-white text-center px-4 mb-4">
                <strong>Banco: BBVA</strong><br>
                <strong>Cuenta Bancaria:</strong> #<br>
                <strong>Alias:</strong> <br>
                <strong>Teléfono de contacto:</strong> #
            </p>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl text-white text-center px-4 mt-4">
                ¡Gracias por tu apoyo! Cada donación cuenta para mejorar el futuro del planeta.
            </p>
        </div>
    </div>
</section>





    <footer class="bg-black text-white py-10">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <!-- Logo y descripción centrados -->
        <div class="flex flex-col items-center space-y-6">
<h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-extrabold text-white text-center">
    Ambiente Cielo Rojo
</h2>

            <!-- Redes sociales con iconos más grandes y en círculos -->
            <div class="flex space-x-6">
                <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-opacity-20 transition duration-300 ease-in-out">
                    <img src="https://img.icons8.com/fluent/36/ffffff/facebook-new.png" alt="Facebook">
                </a>
                <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-opacity-20 transition duration-300 ease-in-out">
                    <img src="https://img.icons8.com/fluent/36/ffffff/linkedin-2.png" alt="LinkedIn">
                </a>
                <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-opacity-20 transition duration-300 ease-in-out">
                    <img src="https://img.icons8.com/fluent/36/ffffff/instagram-new.png" alt="Instagram">
                </a>
                <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-opacity-20 transition duration-300 ease-in-out">
                    <img src="https://img.icons8.com/fluent/36/ffffff/twitter.png" alt="Twitter">
                </a>
            </div>
        </div>

        <!-- Divisor decorativo -->
        <div class="mt-8 border-t border-white border-opacity-10"></div>

        <!-- Copyright y enlaces de navegación -->
        <div class="flex flex-col md:flex-row justify-between items-center mt-8 text-center text-sm">
            <p class="font-light text-gray-400">&copy; 2024 Ambiente Cielo Rojo. Todos los derechos reservados.</p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Política de privacidad</a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Términos de servicio</a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Contacto</a>
            </div>
        </div>
    </div>
</footer>
</main>
</body>
</html>
