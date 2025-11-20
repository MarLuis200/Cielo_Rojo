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

<body class="transition-colors duration-500 bg-white dark:bg-gradient-to-br dark:from-[#0f172a] dark:to-[#1e293b] text-gray-800 dark:text-[#f8fafc] font-poppins">
<nav class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm fixed w-full z-50 top-0 start-0 border-b border-gray-200/50 dark:border-gray-600/50 shadow-sm" x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = window.pageYOffset > 10">
    <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex items-center space-x-2 rtl:space-x-reverse mr-auto group">
            <img src="{{ asset('img/cielo2.png') }}" class="h-10 w-10 rounded-full transform group-hover:scale-110 transition-transform duration-300" alt="Logo">
            <span class="self-center text-xl md:text-2xl font-bold whitespace-nowrap text-gray-800 dark:text-white">Cielo<span class="text-red-600">Rojo</span></span>
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
                <li>
                    <a href="{{ route('landing.index') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('landing.proyectos') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Proyectos</a>
                </li>
                <li>
                    <a href="{{ route('landing.blogs') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Blogs</a>
                </li>
                <li>
                    <a href="{{ route('landing.galeria') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Galería</a>
                </li>
                <li>
                    <a href="{{ route('landing.quienes.somos') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">¿Quiénes Somos?</a>
                </li>
                <li>

                     <a href="{{ route('landing.premios') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Premios</a>
                </li>
                <li>
                    <a href="{{ route('landing.acerca') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Acerca De</a>
                </li>

                <li>
                    <a href="{{ route('landing.donaciones') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Donaciones</a>
                </li>

                <li class="mt-3 md:mt-0 md:ml-4">
                    <button @click="theme = theme === 'light' ? 'dark' : 'light'" class="p-2 rounded-full bg-gray-200 dark:bg-gray-800 transition duration-300 ease-in-out focus:outline-none hover:scale-110 shadow-md">
                        <svg x-show="theme === 'light'" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 5a5 5 0 000 10 5 5 0 000-10zm0-3a1 1 0 110 2h-.02a1 1 0 010-2H10zm0 16a1 1 0 110 2h-.02a1 1 0 010-2H10zm9-9a1 1 0 110 2v-.02a1 1 0 110-2V10zm-16 0a1 1 0 110 2H3a1 1 0 010-2h.02zM15.45 6.14a1 1 0 011.41 0l.02.02a1 1 0 010 1.41L16.88 8a1 1 0 11-1.41-1.42l-.02-.02zM4.12 13.76a1 1 0 110 1.42l-.02.02a1 1 0 01-1.41 0L2 14.17a1 1 0 111.42-1.41l.02.02z"/>
                        </svg>
                        <svg x-show="theme === 'dark'" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 1a9 9 0 000 18 9 9 0 000-18zm1 16V3a7 7 0 010 14z"/>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>

        <div class="hidden md:flex space-x-3 ml-6">
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm bg-gradient-to-r from-blue-400 to-blue-600 text-white font-semibold rounded-full hover:from-blue-500 hover:to-blue-700 focus:outline-none transition-all duration-300 transform hover:scale-105 shadow-md">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-semibold rounded-full hover:from-yellow-500 hover:to-yellow-700 focus:outline-none transition-all duration-300 transform hover:scale-105 shadow-md">Registro</a>
        </div>
    </div>
</nav>

<div class="hero-section relative overflow-hidden bg-black text-white ">
    <div id="carousel" class="absolute inset-0 w-full h-full">
        <img src="{{ asset('img/paisaje1.jpeg') }}" alt="Fondo 1" class="carousel-slide absolute inset-0 w-full h-full object-cover opacity-80 transition-opacity duration-1000">
        <img src="{{ asset('img/valle.jpeg') }}" alt="Fondo 2" class="carousel-slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('img/hongo2.jpeg') }}" alt="Fondo 3" class="carousel-slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('img/cedro.jpeg') }}" alt="Fondo 5" class="carousel-slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000">
    </div>
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-screen max-w-screen-lg mx-auto text-center px-4">

        <div class="absolute left-5 md:left-10 bg-green-200 text-black p-3 md:p-4 rounded-lg shadow-lg animate-pulse flex items-center space-x-2" style="top: 530px;">
            <img src="https://img.icons8.com/ios-filled/50/000000/leaf.png" class="h-5 w-5 md:h-6 md:w-6" alt="Icono Hoja">
            <p class="text-sm md:text-base font-semibold">Cuidemos el medio ambiente, un pequeño cambio hace la diferencia.</p>
        </div>

        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight uppercase text-purple-500 mb-4 animate-pulse leading-tight shadow-md md:shadow-lg lg:shadow-xl transform transition-all duration-300 ease-in-out hover:scale-105">
            Galeria de <br> Fotos
        </h1>

        <p class="text-base md:text-lg lg:text-2xl max-w-xl mx-auto mb-8 text-white text-justify font-semibold tracking-wide leading-relaxed italic">
            Sumérgete en nuestra galería visual: un viaje de imágenes que capturan la esencia de la naturaleza, la vida silvestre y las maravillas del planeta.
        </p>

        <a href="#galeria" class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-6 py-3 md:px-8 md:py-4 text-base md:text-lg font-semibold rounded-full shadow-lg hover:bg-gradient-to-l hover:scale-105 transition transform duration-300 ease-in-out">
            Ver Galería
        </a>
    </div>
</div>


<div class="flex flex-col md:flex-row items-center md:space-x-10 mt-16">
    <div data-aos="fade-left" class="md:w-1/2 lg:pl-14">
        <h1 class="text-darken font-semibold text-3xl lg:pr-56 text-gray-800 dark:text-gray-100 text-justify">
            <span class="text-yellow-500 dark:text-amber-200">Avance </span> o <span class="text-green-500 dark:text-green-500">Destrucción?</span>
        </h1>
        <p class="text-gray-500 dark:text-gray-300 my-4 lg:pr-32 text-justify">
            “Hoy en día existe un dilema capital a la escala de especie entre una porción de la humanidad que recuerda y otra que olvida, entre un sector que innova para enriquecer la diversidad natural y cultural del mundo y otra que, si bien también crea nuevas formas, esas terminan destruyendo esa diversidad biocultural que representa la memoria de la especie.”    </p>
        <p class="mt-4 text-right text-gray-700 dark:text-gray-400 italic">
            V. M. Toledo y Barrera-Bassols N., 2008.
        </p>
    </div>
    <img data-aos="fade-right" class="md:w-1/2" src="img/hongos.png">
</div>

<div id="galeria" data-aos="zoom-in" class="mt-16 text-center">
    <h1 class="text-3xl font-extrabold text-blue-500 dark:text-amber-300">Galería</h1>
</div>
<div class="lg:w-10/12 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-12">

    <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-96 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/cocina.jpeg" alt="Imagen 1">
    </div>

    <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-72 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/combate.jpeg" alt="Imagen 2">
    </div>

    <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-56 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/monte2.jpeg" alt="Imagen 3">
    </div>


    <div data-aos="fade-up" data-aos-delay="700" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-72 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/hongo.jpeg" alt="Imagen 4">
    </div>

    <div data-aos="fade-up" data-aos-delay="900" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-96 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/mag.jpeg" alt="Imagen 5">
    </div>

    <div data-aos="fade-up" data-aos-delay="1100" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-56 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/arboles.jpeg" alt="Imagen 6">
    </div>

    <div data-aos="fade-up" data-aos-delay="700" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-72 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/paisaje3.jpeg" alt="Imagen 4">
    </div>

    <div data-aos="fade-up" data-aos-delay="1100" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-56 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/monte.jpeg" alt="Imagen 6">
    </div>

    <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-72 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/limpieza.jpeg" alt="Imagen 2">
    </div>

    <div data-aos="fade-up" data-aos-delay="900" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-96 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/hongos4.jpeg" alt="Imagen 5">
    </div>

    <div data-aos="fade-up" data-aos-delay="1100" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-56 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/telaraña.jpeg" alt="Imagen 6">
    </div>

    <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" class="group relative flex flex-col items-center justify-center text-center rounded-lg shadow-lg overflow-hidden bg-transparent transition-transform duration-300 hover:scale-110 hover:shadow-2xl">
        <img class="w-full h-72 object-cover rounded-lg transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3d group-hover:shadow-2xl" src="img/reptil.jpeg" alt="Imagen 2">
    </div>

</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</div>


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
</main>
</body>
</html>
