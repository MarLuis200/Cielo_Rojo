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

<div class="pt-24 max-w-7xl mx-auto px-4">

    <div class="flex flex-col lg:flex-row items-center">
        <div class="flex flex-col w-full lg:w-6/12 justify-center lg:pt-24 items-start text-center lg:text-left mb-10 md:mb-0">
            <h1 data-aos="fade-right" data-aos-once="true" class="my-4 text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold leading-tight text-red-700 font-poppins tracking-wide">
                <span class="text-black dark:text-white">¿Quiénes</span> <span class="text-red-700 bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-red-800 dark:from-red-400 dark:to-red-600">somos?</span>
            </h1>

            <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="leading-normal text-2xl mb-8 text-black dark:text-gray-300">
                Nuestra Conexión con la Tierra: Redescubriendo el Valor del Medio Ambiente
            </p>

            <div data-aos="fade-up" data-aos-once="true" data-aos-delay="700" class="w-full md:flex items-center justify-center lg:justify-start md:space-x-5">
                <button class="px-8 py-3 bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-full font-semibold text-lg shadow-lg transform transition hover:scale-105 hover:shadow-xl duration-300 flex items-center group">
                    Explorar más
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                </button>
            </div>
        </div>

        <div class="w-full lg:w-6/12 relative" id="girl">
            <div data-aos="fade-up" data-aos-once="true" data-aos-delay="500" class="relative">
                <img class="w-full max-w-md mx-auto lg:mr-0 lg:ml-auto transform hover:scale-105 transition-transform duration-700" src="{{ asset('img/arboll.png') }}" alt="Árbol" />
                <div class="absolute -bottom-5 -left-5 w-24 h-24 bg-yellow-400 rounded-full opacity-70 animate-pulse"></div>
                <div class="absolute -top-5 -right-5 w-16 h-16 bg-red-500 rounded-full opacity-70 animate-bounce"></div>
            </div>
        </div>
    </div>

    <div class="mt-20"></div>

    <section class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-blue-600 dark:from-red-400 dark:to-blue-400">
                Ambiente Cielo Rojo
            </h2>
            <p class="max-w-3xl mx-auto text-xl text-gray-700 dark:text-gray-300 mb-12">
                Explora algunos de los proyectos más innovadores que hemos desarrollado recientemente.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div data-aos="flip-left" data-aos-delay="300" class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-leaf text-2xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-green-700 dark:text-green-400 mb-2">Nuestro Compromiso</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Nos dedicamos a crear contenido impactante y educativo sobre sostenibilidad, naturaleza y acciones para proteger nuestro planeta.
                        </p>
                        <button class="mt-4 px-4 py-2 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-sm font-semibold hover:bg-green-200 dark:hover:bg-green-800 transition-colors duration-300">
                            Saber más
                        </button>
                    </div>
                </div>

                <div data-aos="flip-right" data-aos-delay="500" class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-heart text-2xl text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-red-700 dark:text-red-400 mb-2">Nuestra Misión</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Creemos en el poder de la información para inspirar cambios reales. Únete a nuestro viaje hacia un planeta más saludable.
                        </p>
                        <button class="mt-4 px-4 py-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full text-sm font-semibold hover:bg-red-200 dark:hover:bg-red-800 transition-colors duration-300">
                            Unirse
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-20"></div>

    <!-- Sección de estadísticas -->
    <section class="py-16 bg-gradient-to-r from-blue-50 to-green-50 dark:from-gray-800 dark:to-gray-900 rounded-3xl shadow-inner">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 text-gray-800 dark:text-white">Nuestro Impacto</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto">
                <div data-aos="zoom-in" data-aos-delay="200" class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg transform transition hover:scale-110 duration-500">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-tree text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">500+</h3>
                    <p class="text-gray-600 dark:text-gray-300">Árboles Plantados</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="300" class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg transform transition hover:scale-110 duration-500">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-recycle text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-green-600 dark:text-green-400 mb-2">1.2K</h3>
                    <p class="text-gray-600 dark:text-gray-300">Kg Reciclados</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="400" class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg transform transition hover:scale-110 duration-500">
                    <div class="w-16 h-16 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-users text-2xl text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">350+</h3>
                    <p class="text-gray-600 dark:text-gray-300">Voluntarios</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="500" class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg transform transition hover:scale-110 duration-500">
                    <div class="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-hand-holding-heart text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-red-600 dark:text-red-400 mb-2">98%</h3>
                    <p class="text-gray-600 dark:text-gray-300">Satisfacción</p>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="mt-20"></div>




</main>


<section class="py-16 px-4 bg-gradient-to-b from-white to-blue-50 dark:from-gray-900 dark:to-gray-800" x-data="{selectedTab: 'all'}">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-blue-600 dark:from-red-400 dark:to-blue-400">
                Proyectos Destacados
            </h2>
            <p class="max-w-3xl mx-auto text-xl text-gray-700 dark:text-gray-300 mb-12">
                Descubre nuestras iniciativas más impactantes para preservar el medio ambiente.
            </p>
        </div>

       <div class="lg:w-10/12 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
           @foreach ($projects as $project)
               <a href="{{ route('posts.project.show', $project->id) }}"  data-aos="fade-up" data-aos-delay="100" data-aos-duration="800" class="flex flex-col items-center text-center rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 bg-transparent group">
                   <div class="relative overflow-hidden rounded-lg">
                       @if(isset($project->content[0]['value']))
                           <img class="w-full h-48 object-cover transform transition-transform duration-500 group-hover:scale-110 rounded-lg" src="{{ $project->content[0]['value'] }}" alt="{{ $project->title }}">
                       @else
                           <img class="w-full transform transition-transform duration-500 group-hover:scale-110 rounded-lg" src="default-image.jpg" alt="Imagen predeterminada">
                       @endif
                       <span class="absolute bottom-2 left-2 bg-blue-300 text-darken font-semibold px-4 py-px text-sm rounded-full">{{ $project->title }}</span>
                   </div>
                   <p class="text-gray-600 dark:text-gray-300 my-4 text-sm text-justify group-hover:text-gray-500 transition-colors duration-300" style="font-family: 'Poppins', sans-serif;">
                       @php
                           $firstText = null;
                           foreach ($project->content as $element) {
                               if ($element['type'] === 'text') {
                                   $firstText = $element['value'];
                                   break;
                               }
                           }
                       @endphp

                       @if($firstText)
                           {{ $firstText }}
                       @else
                           Descripción no disponible.
                       @endif
                   </p>
               </a>
           @endforeach
       </div>
    </div>
</section>


<section class="py-16 px-4 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-purple-600 dark:from-red-400 dark:to-purple-400">
               Cuidado del Medio Ambiente
            </h2>
            <p class="max-w-3xl mx-auto text-xl text-gray-700 dark:text-gray-300">
                Sostenibilidad y más.
            </p>
        </div>



            <div class="flex flex-col space-y-8">



<div class="lg:w-10/12 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
    @foreach ($blogs as $blog)
        <a href="{{ route('posts.blog.show', $blog->id) }}" data-aos="fade-left" data-aos-delay="300"
           class="flex bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transform transition duration-500 hover:scale-105">


            <div class="relative overflow-hidden rounded-lg">
                @if(isset($blog->content[0]['value']))
                    <img class="w-full h-full object-cover" src="{{ $blog->content[0]['value'] }}" alt="{{ $blog->title }}">
                @else
                    <img class="w-full h-full object-cover" src="default-image.jpg" alt="Imagen predeterminada">
                @endif
                 <span class="absolute bottom-2 left-2 bg-red-300 text-darken font-semibold px-4 py-px text-sm rounded-full">{{ $blog->title }}</span>
            </div>

            <div class="w-2/3 p-6 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">
                        {{ $blog->category->name ?? 'Blog' }}
                    </span>

                    <h4 class="font-bold mt-2 mb-2">
                        {{ $blog->title }}
                    </h4>

                    @php
                        $firstText = collect($blog->content)->firstWhere('type', 'text')['value'] ?? null;
                    @endphp
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                        {{ $firstText ? Str::limit($firstText, 100) : 'Descripción no disponible.' }}
                    </p>
                </div>

                <div class="flex items-center text-sm text-gray-500">
                    <i class="far fa-clock mr-1"></i>
                    <span>Leer</span>
                </div>
            </div>
        </a>

    @endforeach
</div>

            </div>
        </div>


    </div>
</section>

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
        duration: 1000,
        once: true,
        easing: 'ease-out-back'
    });
</script>
</body>
</html>
