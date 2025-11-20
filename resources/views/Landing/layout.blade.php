<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Ambiente Cielo Rojo</title>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-50 text-gray-800">
<header class="bg-white text-gray-800 shadow-md">
    <nav class="container mx-auto flex justify-between items-center p-6">
        <a href="{{ route('landing.index') }}" class="text-2xl md:text-3xl font-extrabold text-indigo-600">
        </a>
        <div class="hidden md:flex space-x-6">
            <ul class="flex space-x-6">
                <li><a href="{{ route('landing.index') }}" class="hover:text-indigo-600 transition">Inicio</a></li>
                <li><a href="{{ route('landing.proyectos') }}" class="hover:text-indigo-600 transition">Proyectos</a></li>
                <li><a href="{{ route('landing.blogs') }}" class="hover:text-indigo-600 transition">Blogs</a></li>
                <li><a href="{{ route('landing.galeria') }}" class="hover:text-indigo-600 transition">Galería De Fotos</a></li>
                <li><a href="{{ route('landing.acerca') }}" class="hover:text-indigo-600 transition">Acerca de</a></li>
                <li><a href="{{ route('landing.quienes.somos') }}" class="hover:text-indigo-600 transition">¿Quiénes Somos?</a></li>
                <li><a href="{{ route('landing.premios') }}" class="hover:text-indigo-600 transition">Premios</a></li>
                <li><a href="{{ route('landing.donaciones') }}" class="hover:text-indigo-600 transition">Donaciones</a></li>
                <!-- Login, Register y Logout -->
                @if (Auth::check())
                    <li>
                        <a href="{{ route('logout') }}" class="hover:text-indigo-600 transition"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Register</a></li>
                    @endif
                @endif
            </ul>
        </div>
        <button class="md:hidden text-2xl text-indigo-600" id="menu-toggle">
            &#9776;
        </button>
    </nav>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg">
        <ul class="space-y-4 p-6">
            <li><a href="{{ route('landing.index') }}" class="block hover:text-indigo-600 transition">Inicio</a></li>
            <li><a href="{{ route('landing.proyectos') }}" class="block hover:text-indigo-600 transition">Proyectos</a></li>
            <li><a href="{{ route('landing.blogs') }}" class="block hover:text-indigo-600 transition">Blogs</a></li>
            <li><a href="{{ route('landing.galeria') }}" class="block hover:text-indigo-600 transition">Galería De Fotos</a></li>
            <li><a href="{{ route('landing.acerca') }}" class="block hover:text-indigo-600 transition">Acerca de</a></li>
            <li><a href="{{ route('landing.premios') }}" class="block hover:text-indigo-600 transition">Premios</a></li>
            <li><a href="{{ route('landing.quienes.somos') }}" class="block hover:text-indigo-600 transition">¿Quiénes Somos?</a></li>
            <li><a href="{{ route('landing.donaciones') }}" class="block hover:text-indigo-600 transition">Donaciones</a></li>
            @if (Auth::check())
                <li>
                    <a href="{{ route('logout') }}" class="block hover:text-indigo-600 transition"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                </li>
            @else
                @if (Route::has('login'))
                    <li><a href="{{ route('login') }}" class="block hover:text-indigo-600 transition">Login</a></li>
                @endif
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="block hover:text-indigo-600 transition">Register</a></li>
                @endif
            @endif
        </ul>
    </div>
</header>

<main class="py-10">
    @yield('content')
</main>

<footer class="bg-white text-gray-800 py-6 text-center mt-10 border-t">
    <p>&copy; 2024 Ambiente Cielo Rojo. Todos los derechos reservados.</p>
</footer>

<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

</body>
</html>
