<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cielo Rojo</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside id="sidebar" class="bg-gradient-to-b from-gray-800 to-gray-900 text-white w-64 lg:w-64 hidden lg:flex flex-col shadow-xl overflow-y-auto ">
        <div class="flex flex-col items-center">
            <img src="{{ asset('img/icon.png') }}" alt="Logo" class="h-20 w-20 rounded-full shadow-md border-4 border-white">
            <h1 class="text-3xl font-bold mt-4 tracking-wider text-yellow-400">Cielo Rojo</h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 space-y-4">
            <hr>
            <a href="{{ route('dash2') }}"
               class="flex items-center py-3 px-4 text-base {{ request()->routeIs('dash2') ? 'bg-yellow-500 text-gray-800' : 'hover:bg-yellow-400 hover:text-gray-900' }} rounded-lg transition duration-300">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>

            <h2 class="text-md font-semibold uppercase text-gray-400">Administración</h2>

            <a href="{{ route('admin.publicaciones') }}"
               class="flex items-center py-3 px-4 text-base {{ request()->routeIs('admin.publicaciones') ? 'bg-yellow-500 text-gray-800' : 'hover:bg-yellow-400 hover:text-gray-900' }} rounded-lg transition duration-300">
                <i class="fas fa-edit mr-3"></i> Publicaciones
            </a>


            <h2 class="text-md font-semibold uppercase text-gray-400">Publicaciones</h2>
            <a href="{{ route('posts.project') }}"
               class="flex items-center py-3 px-4 text-base {{ request()->routeIs('posts.project') ? 'bg-yellow-500 text-gray-800' : 'hover:bg-yellow-400 hover:text-gray-900' }} rounded-lg transition duration-300">
                <i class="fas fa-tasks mr-3"></i> Proyectos
            </a>

            <a href="{{ route('posts.blog') }}"
               class="flex items-center py-3 px-4 text-base {{ request()->routeIs('posts.blog') ? 'bg-yellow-500 text-gray-800' : 'hover:bg-yellow-400 hover:text-gray-900' }} rounded-lg transition duration-300">
                <i class="fas fa-pen-fancy mr-3"></i> Blogs
            </a>



            <h2 class="text-md font-semibold uppercase text-gray-400">Comercio</h2>
            <a href="/"
               class="flex items-center py-3 px-4 text-base {{ request()->is('/') ? 'bg-yellow-500 text-gray-800' : 'hover:bg-yellow-400 hover:text-gray-900' }} rounded-lg transition duration-300">
                <i class="fas fa-home mr-3"></i> Inicio
            </a>
        </nav>
        <div class="mt-auto p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-500 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>




    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-gradient-to-r from-gray-900 to-gray-700 shadow-lg px-6 py-4 flex justify-between items-center text-white">
            <button id="sidebarToggle" class="lg:hidden focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <h1 class="text-4xl font-bold tracking-wide">Panel de Control</h1>
            <div class="flex items-center space-x-4">
                <button class="bg-gray-700 p-2 rounded-full hover:bg-yellow-500 focus:outline-none shadow-md">
                    <i class="fas fa-bell"></i>
                </button>
                <button class="bg-gray-700 p-2 rounded-full hover:bg-yellow-500 focus:outline-none shadow-md">
                    <i class="fas fa-user-circle text-3xl"></i>
                </button>
            </div>
        </header>


        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>

<script>
    // Sidebar toggle for mobile
    const sidebarToggle = document.querySelector('#sidebarToggle');
    const sidebar = document.querySelector('aside');
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
</script>

</body>
</html>
