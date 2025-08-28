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

<div class="pt-20 max-w-screen-xl mx-auto px-4">

    <div class="flex flex-col lg:flex-row items-start">
        <div class="flex flex-col w-full lg:w-6/12 justify-center lg:pt-24 items-start text-center lg:text-left mb-5 md:mb-0">
            <h1 data-aos="fade-right" data-aos-once="true" class="my-4 text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-bold leading-tight text-red-700 font-poppins tracking-wide">
                <span class="text-black">Ambiente</span> <span class="text-red-700">Cielo Rojo</span>
            </h1>

            <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="leading-normal text-2xl mb-8 text-black">
                Nuestra Conexión con la Tierra: Redescubriendo el Valor del Medio Ambiente
            </p>
            <div data-aos="fade-up" data-aos-once="true" data-aos-delay="700" class="w-full md:flex items-center justify-center lg:justify-start md:space-x-5">
                <div class="flex items-center justify-center space-x-3 mt-5 md:mt-0 focus:outline-none transform transition hover:scale-110 duration-300 ease-in-out">
                </div>
            </div>
        </div>

        <div class="w-full lg:w-6/12 relative" id="girl">
            <img data-aos="fade-up" data-aos-once="true" class="w-16/14 mx-auto 2xl:-mb-20" src="{{ asset('img/planett.png') }}" />
            <div data-aos="fade-up" data-aos-delay="300" data-aos-once="true" class="absolute bottom-48 -left-6 sm:left-10 md:bottom-56 md:left-16 lg:-left-0 lg:bottom-60 floating-4">
                <div class="bg-white bg-opacity-80 rounded-lg h-20 w-64 p-3 flex items-center justify-start space-x-3 text-gray-600 font-medium shadow-lg">
                    <img src="{{ asset('img/quemabosque.png') }}" alt="Bosque" class="h-16 w-16">
                    <span class="text-left" style="font-size: 13px;">Cada minuto se pierden 2 hectáreas de selva tropical</span>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="500" data-aos-once="true" class="absolute bottom-14 left-20 sm:left-32 sm:bottom-20 lg:bottom-24 lg:left-72 floating">
                <div class="relative bg-white bg-opacity-80 rounded-lg h-20 w-64 p-3 flex items-center text-gray-600 font-medium shadow-lg">
                    <img src="{{ asset('img/ocean.jpg') }}" alt="Bosque" class="absolute inset-0 h-full w-full object-cover rounded-lg opacity-20">
                    <span class="relative text-left z-10" style="font-size: 13px;">Los océanos absorben alrededor del 30% del dióxido de carbono humano</span>
                </div>
            </div>
        </div>
    </div>


        <div class="mt-24"></div>

        <div class="max-w-screen-xl mx-auto px-8 sm:px-16 mt-5">
            <div class="sm:flex items-center sm:space-x-8 overflow-hidden">
                <div data-aos="zoom-in" class="sm:w-1/2 relative flex flex-col items-center text-center">
                    <h1 class="font-semibold text-2xl text-green-700 mb-4 max-w-md">
                        Investigación y <span class="text-blue-900">Cultura</span>
                    </h1>
                    <div class="flex flex-col items-center max-w-md">
                        <p class="py-5 text-justify">Investigación y Comunicación Audiovisual: Medio Ambiente y Cultura. Nuestro proyecto se enfoca en la preservación del entorno natural y la promoción de la diversidad cultural.</p>
                        <p class="py-5 text-justify">Desde la creación de Proyectos hasta la organización de eventos de concientización, nuestro objetivo es inspirar a la comunidad para proteger nuestro planeta.</p>
                    </div>
                </div>


                <div data-aos="zoom-in" class="sm:w-1/2 relative mt-5 sm:mt-0"> <!-- Efecto de acercamiento -->
                    <div class="rounded-xl z-40 relative max-w-full bg-gray-900 bg-opacity-80 p-4" style="padding-bottom: 56.25%; height: 0;">
                        <iframe
                            src="https://www.youtube.com/embed/EBgZ-SdkOtQ?rel=0&controls=1&loop=1&playlist=EBgZ-SdkOtQ"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            class="absolute top-0 left-0 w-full h-full rounded-xl">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Separación entre los bloques -->
        <div class="mt-24"></div> <!-- Espacio de separación -->

        <div class="max-w-screen-xl mx-auto px-8 sm:px-16 mt-5"> <!-- Contenedor principal con margen superior reducido -->

            <div class="sm:flex items-center sm:space-x-8 overflow-hidden">
                <div data-aos="zoom-in" class="sm:w-1/2 relative flex flex-col items-center text-center"> <!-- items-center para centrar el contenido -->
                    <h1 class="font-semibold text-2xl text-green-700 mb-4 max-w-md text-justify">
                        Gobernanza del agua en las comunidades <span class="text-blue-900">de la Cuenca del Río San Juan Zitácuaro</span>
                    </h1>
                    <div class="flex flex-col items-center max-w-md">
                        <p class="py-5 text-justify">La crisis del agua avanza rápidamente, y la gobernanza hídrica comunitaria se presenta como un modelo ideal para enfrentarla en el medio rural.</p>
                        <p class="py-5 text-justify">Este enfoque ha demostrado ser efectivo en la Cuenca del Río San Juan Zitácuaro, ubicada en la región de la mariposa monarca, donde las comunidades se esfuerzan por preservar y gestionar sus recursos hídricos.</p>
                    </div>
                </div>

                <div data-aos="zoom-in" class="sm:w-1/2 relative mt-5 sm:mt-0"> <!-- Efecto de acercamiento -->
                    <div class="rounded-xl z-40 relative max-w-full bg-gray-900 bg-opacity-80 p-4" style="padding-bottom: 56.25%; height: 0;">
                        <iframe
                            src="https://www.youtube.com/embed/MBM4yN-8yYE?rel=0&showinfo=0&controls=1"
                            title="Gobernanza del agua en las comunidades de la Cuenca del Río San Juan Zitácuaro"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            class="absolute top-0 left-0 w-full h-full rounded-xl">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

                <!-- Separación entre los bloques -->
        <div class="mt-10"></div> <!-- Espacio de separación -->

        <section class="bg-white text-black py-12">
            <div class="max-w-screen-xl mx-auto px-8 sm:px-16">
            <div data-aos="fade-down" class="text-center mb-6">
                <h2 data-aos="fade-down" class="font-semibold text-center text-green-700 mb-6 text-4xl">
                    Documental <br>
                    <span class="text-blue-900 text-2xl">El taco Mazahua, entre el oro verde y la monarca</span>
                </h2>
            </div>

                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="rounded-xl overflow-hidden bg-gray-900 bg-opacity-80 transform transition duration-300 hover:shadow-2xl hover:scale-105" style="width: 100%; max-width: 560px;">
                        <div style="padding-top: 56.25%; position: relative;">
                            <iframe
                                src="https://www.youtube.com/embed/zP3_M483aZU"
                                frameborder="0"
                                allow="autoplay; fullscreen;"
                                allowfullscreen
                                class="absolute top-0 left-0 w-full h-full rounded-xl"
                                title="Documental">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="mt-24"></div>


        <section class="bg-white text-blue-200 py-12">
            <div class="container mx-auto text-center"> <!-- Centrado de todo el contenido -->
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-indigo-600 mb-4">
                    Nuestros Proyectos
                </h2>
                <p class="max-w-2xl mx-auto text-gray-700"> <!-- Ajuste de ancho y centrado -->
                    Explora algunos de los proyectos más innovadores que hemos desarrollado recientemente.
                </p>
            </div>
        </section>

<section class="bg-white text-black py-12">
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center text-fuchsia-500 mb-8">
        Aliados
    </h1>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-4 md:px-8 lg:px-16"> <!-- Contenedor de collage con espaciado -->

        <!-- Imágenes en collage -->
        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/red_monarca.jpg') }}" alt="Monarca">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/alternare.jpg') }}" alt="Alternare">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/monarch.jpg') }}" alt="Monarch">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/soy_mazahua.jpg') }}" alt="Soy Mazahua">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/silencio.png') }}" alt="Silencio">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/procuenca.jpg') }}" alt="Procuenca">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/consejo_civil.jpg') }}" alt="Consejo Civil">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/colonos_montana.jpg') }}" alt="Colonos">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/agaveli.jpg') }}" alt="Agaveli">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/reserva_mariposa_monarca.jpg') }}" alt="Monarca">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/cemda.jpg') }}" alt="Cemda">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/biocenosis.jpg') }}" alt="Biocenosis">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/fondo_mexicano.jpg') }}" alt="Fondo Mexicano">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/focem.jpg') }}" alt="Focem">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/iztacala2.jpg') }}" alt="Izcala">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/tesvb.jpg') }}" alt="Tesvb">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/icar.jpg') }}" alt="Icar">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/probosque.jpg') }}" alt="Probosque">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/conanp.jpg') }}" alt="Conanp">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/aguacateros.jpg') }}" alt="Aguacateros">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/pacmyc.jpg') }}" alt="Pacmyc">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/cruz_roja.jpg') }}" alt="Cruz Roja">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/leddy.jpg') }}" alt="Leddy">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/onirica.jpg') }}" alt="Onirica">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/puerto_ventanas.jpg') }}" alt="Puerto Ventanas">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/odisea.jpg') }}" alt="Odisea">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/medical_mission.jpg') }}" alt="Medical Mission">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/flesh.jpg') }}" alt="Flesh">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/barrio.jpg') }}" alt="Barrio">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/va_valle.jpg') }}" alt="Va Valle">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/ecoacatitlan.jpg') }}" alt="Ecoacatitlan">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/camaleon.jpg') }}" alt="Camaleon">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/guardianes_valle.jpg') }}" alt="Guardianes Valle">
        </div>

        <div class="p-2">
            <img class="h-auto w-full rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105" src="{{ asset('img/efas.jpeg') }}" alt="Efas">
        </div>

    </div>
</section>

</div>

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
