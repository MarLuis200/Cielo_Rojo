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
                    <a href="{{ route('landing.acerca') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Acerca De</a>
                </li>
                <li>
                    <!-- ENLACE CORREGIDO: Se quitaron las clases de color fijas -->
                    <a href="{{ route('landing.premios') }}" class="block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg md:hover:bg-transparent md:dark:hover:bg-transparent md:p-0 transition-all duration-300 hover:text-red-600 dark:hover:text-yellow-300">Premios</a>
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

<main class="pt-20 max-w-7xl mx-auto px-4 md:px-8">
    <div class="flex flex-col lg:flex-row items-center min-h-[80vh] py-10">
        <div class="flex flex-col w-full lg:w-1/2 justify-center items-start text-center lg:text-left mb-10 lg:mb-0">
            <h1 data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="my-4 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
                <span class="text-gray-800 dark:text-white">Nuestros</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">Premios</span>
            </h1>

            <p data-aos="fade-down" data-aos-duration="1000" data-aos-once="true" data-aos-delay="300" class="leading-normal text-xl md:text-2xl mb-8 text-gray-700 dark:text-gray-300">
                Nuestra Conexión con la Tierra: Redescubriendo el Valor del Medio Ambiente
            </p>

            <div data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="500" class="w-full flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-5">
                <a href="#premios" class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-800 text-white font-semibold rounded-full shadow-lg hover:from-red-700 hover:to-red-900 transition-all duration-300 transform hover:scale-105 flex items-center">
                    Ver Premios
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <a href="{{ route('landing.proyectos') }}" class="px-8 py-3 border-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold rounded-full hover:bg-red-600 hover:text-white dark:hover:bg-red-400 dark:hover:text-white transition-all duration-300 transform hover:scale-105">
                    Nuestros Proyectos
                </a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 relative" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-red-600 to-yellow-500 rounded-lg blur-lg opacity-30 animate-pulse"></div>
                <img class="relative w-full max-w-lg mx-auto transform hover:scale-105 transition-transform duration-700" src="{{ asset('img/cedro.jpeg') }}" alt="Árbol representando el medio ambiente" />
            </div>
        </div>
    </div>


    <section class="py-16" id="premios">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <h2 class="text-3xl md:text-4xl font-bold text-red-700 dark:text-red-500 mb-4">Ambiente Cielo Rojo</h2>
            <div class="w-20 h-1 bg-red-600 mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-lg text-gray-700 dark:text-gray-300">
                Explora algunos de los proyectos más innovadores que hemos desarrollado recientemente.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div data-aos="fade-right" data-aos-duration="800" data-aos-delay="200" class="bg-gradient-to-br from-green-50 to-emerald-100 dark:from-gray-800 dark:to-gray-900 shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-2 transition-transform duration-500 group">
                <div class="p-8">
                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-leaf text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-green-700 dark:text-green-400 mb-4">Nuestro Compromiso con el Medio Ambiente</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Nos dedicamos a crear contenido impactante y educativo sobre sostenibilidad, naturaleza y acciones para proteger nuestro planeta.
                        Únete a nuestra misión para construir un futuro más verde.
                    </p>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="400" class="bg-gradient-to-br from-red-50 to-orange-100 dark:from-gray-800 dark:to-gray-900 shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-2 transition-transform duration-500 group">
                <div class="p-8">
                    <div class="w-14 h-14 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-seedling text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-red-600 dark:text-red-400 mb-4">Nuestra Misión Ambiental</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Creemos en el poder de la información para inspirar cambios reales. Creemos en el cuidado y preservación de los recursos naturales para las generaciones futuras.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Premios -->
    <section class="py-16 bg-gray-100 dark:bg-gray-800 rounded-3xl px-6">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">Reconocimientos y Premios</h2>
            <div class="w-20 h-1 bg-red-600 mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-lg text-gray-700 dark:text-gray-300">
                Estos son algunos de los reconocimientos que hemos recibido por nuestro trabajo en pro del medio ambiente.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Premio 1 -->
            <div data-aos="flip-left" data-aos-duration="800" data-aos-delay="200" class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-3 transition-all duration-500 group">
                <div class="h-48 bg-gradient-to-r from-green-400 to-blue-500 relative overflow-hidden">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition-all duration-500"></div>
                    <div class="absolute top-6 right-6 w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-500">
                        <i class="fas fa-trophy text-2xl text-white"></i>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Premio a la Innovación Ambiental</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">2023 - Por nuestro proyecto de reforestación inteligente</p>
                    <a href="#" class="text-red-600 dark:text-red-400 font-semibold flex items-center group-hover:underline">
                        Ver detalles
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Premio 2 -->
            <div data-aos="flip-left" data-aos-duration="800" data-aos-delay="400" class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-3 transition-all duration-500 group">
                <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-500 relative overflow-hidden">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition-all duration-500"></div>
                    <div class="absolute top-6 right-6 w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-500">
                        <i class="fas fa-award text-2xl text-white"></i>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Reconocimiento a la Sostenibilidad</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">2022 - Por nuestras prácticas de economía circular</p>
                    <a href="#" class="text-red-600 dark:text-red-400 font-semibold flex items-center group-hover:underline">
                        Ver detalles
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Premio 3 -->
            <div data-aos="flip-left" data-aos-duration="800" data-aos-delay="600" class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-3 transition-all duration-500 group">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-cyan-500 relative overflow-hidden">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition-all duration-500"></div>
                    <div class="absolute top-6 right-6 w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-500">
                        <i class="fas fa-medal text-2xl text-white"></i>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Mejor Iniciativa Comunitaria</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">2021 - Por nuestro programa de educación ambiental</p>
                    <a href="#" class="text-red-600 dark:text-red-400 font-semibold flex items-center group-hover:underline">
                        Ver detalles
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>


<footer class="bg-gradient-to-b from-gray-900 to-black text-white py-16 mt-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <div class="flex flex-col space-y-6">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('img/cielo2.png') }}" class="h-10 w-10 rounded-full" alt="Logo">
                    <span class="text-2xl font-bold">Cielo<span class="text-red-600">Rojo</span></span>
                </div>
                <p class="text-gray-400 leading-relaxed">
                    Trabajando por un futuro sostenible y en armonía con nuestro planeta.
                </p>
                <div class="flex space-x-4">
                    <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-red-600 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-red-600 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-red-600 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" target="_blank" class="p-3 bg-white bg-opacity-10 rounded-full hover:bg-red-600 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>


            <div>
                <h3 class="text-lg font-semibold mb-6 relative inline-block">
                    Enlaces Rápidos
                    <div class="absolute -bottom-2 left-0 w-10 h-1 bg-red-600"></div>
                </h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('landing.index') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Inicio</a></li>
                    <li><a href="{{ route('landing.proyectos') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Proyectos</a></li>
                    <li><a href="{{ route('landing.blogs') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Blogs</a></li>
                    <li><a href="{{ route('landing.galeria') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Galería</a></li>
                </ul>
            </div>

            <!-- Más información -->
            <div>
                <h3 class="text-lg font-semibold mb-6 relative inline-block">
                    Más Información
                    <div class="absolute -bottom-2 left-0 w-10 h-1 bg-red-600"></div>
                </h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('landing.quienes.somos') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">¿Quiénes Somos?</a></li>
                    <li><a href="{{ route('landing.premios') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Premios</a></li>
                    <li><a href="{{ route('landing.donaciones') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Donaciones</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-300">Contacto</a></li>
                </ul>
            </div>


            <div>
                <h3 class="text-lg font-semibold mb-6 relative inline-block">
                    Suscríbete
                    <div class="absolute -bottom-2 left-0 w-10 h-1 bg-red-600"></div>
                </h3>
                <p class="text-gray-400 mb-4">Recibe nuestras últimas noticias y actualizaciones.</p>

            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-500">&copy; 2024 Ambiente Cielo Rojo. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out-back'
    });
</script>
</body>
</html>
