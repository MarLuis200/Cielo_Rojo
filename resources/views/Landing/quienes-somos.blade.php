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

<div class="pt-20 max-w-screen-xl mx-auto px-4">

    <div class="flex flex-col lg:flex-row items-start">
        <div class="flex flex-col w-full lg:w-6/12 justify-center lg:pt-24 items-start text-center lg:text-left mb-5 md:mb-0">
            <h1 data-aos="fade-right" data-aos-once="true" class="my-4 text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-bold leading-tight text-red-700 font-poppins tracking-wide">
                <span class="text-black">¿Quiénes</span> <span class="text-red-700">somos?</span>
            </h1>

            <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="leading-normal text-2xl mb-8 text-black">
                Nuestra Conexión con la Tierra: Redescubriendo el Valor del Medio Ambiente
            </p>
            <div data-aos="fade-up" data-aos-once="true" data-aos-delay="700" class="w-full md:flex items-center justify-center lg:justify-start md:space-x-5">
                <div class="flex items-center justify-center space-x-3 mt-5 md:mt-0 focus:outline-none transform transition hover:scale-110 duration-300 ease-in-out">
                </div>
            </div>
        </div>

        <!-- Right Col -->
        <div class="w-full lg:w-6/12 relative" id="girl">
            <img data-aos="fade-up" data-aos-once="true" class="w-16/14 mx-auto 2xl:-mb-20" src="{{ asset('img/arboll.png') }}" />
        </div>
    </div>

        <!-- Separación entre los bloques -->
        <div class="mt-6"></div> <!-- Espacio de separación -->

        <section class="bg-blue text-red-700 py-12">
            <div class="container mx-auto text-center"> <!-- Centrado de todo el contenido -->
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-red-600 mb-4">
                    Ambiente Cielo Rojo
                </h2>
                <p class="max-w-2xl mx-auto text-blue-800 mb-8"> <!-- Ajuste de ancho y centrado -->
                    Explora algunos de los proyectos más innovadores que hemos desarrollado recientemente.
                </p>

            <div class="max-w-2xl mx-auto bg-green-100 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-green-700 mb-2">Nuestro Compromiso con el Medio Ambiente</h3>
                    <p class="text-gray-700">
                        Nos dedicamos a crear contenido impactante y educativo sobre sostenibilidad, naturaleza y acciones para proteger nuestro planeta.
                        Únete a nuestra misión para construir un futuro más verde.
                    </p>
                </div>
            </div>
            <div class="max-w-2xl mx-auto bg-red-100 shadow-lg rounded-lg overflow-hidden mt-6">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-red-600 mb-2">Nuestra Misión Ambiental</h3>
                    <p class="text-blue-800">
                        En nuestra página, creemos en el poder de la información para inspirar cambios reales. Creemos en el cuidado y preservación de los recursos naturales para las generaciones futuras. Acompáñanos en nuestro viaje hacia un planeta más saludable.
                    </p>
                </div>
            </div>


            </div>
        </section>

</div>

        <div class="mt-10"></div>

<footer class="bg-black text-white py-10">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <!-- Logo y descripción centrados -->
        <div class="flex flex-col items-center space-y-6">
            <h2 class="text-3xl font-bold tracking-wide text-center">Ambiente Cielo Rojo</h2>


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

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
