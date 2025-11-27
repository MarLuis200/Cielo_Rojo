<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cielo Rojo</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        nature: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        forest: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        sky: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-sky-50 to-nature-50 font-sans antialiased">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="bg-white shadow-xl w-64 flex flex-col border-r border-nature-200">
        <div class="flex flex-col items-center py-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-nature-500 to-sky-500 flex items-center justify-center shadow-lg mb-4">
                <i class="fas fa-leaf text-2xl text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-forest-800">Cielo Rojo</h1>
        </div>

        <nav class="flex-1 space-y-1 px-4 mt-6">
            <a href="{{ route('dash2') }}"
               class="flex items-center py-3 px-4 text-base font-medium rounded-xl bg-nature-500 text-white shadow-lg">
                <i class="fas fa-chart-pie mr-3 text-lg"></i> Dashboard
            </a>

            <h2 class="text-xs font-semibold uppercase text-forest-400 mt-8 mb-3 px-4">Administración</h2>

            <a href="{{ route('proyectos.create') }}"
               class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
               <i class="fas fa-seedling mr-3 text-lg"></i> Nuevo Proyecto
            </a>

            <a href="{{ route('blogs.create') }}"
               class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
               <i class="fas fa-feather mr-3 text-lg"></i> Crear Blog
            </a>

         <a href="{{ route('reconocimientos.create') }}"
                        class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
                        <i class="fas fa-feather mr-3 text-lg"></i> Crear Reconocimiento
                    </a>

            <h2 class="text-xs font-semibold uppercase text-forest-400 mt-8 mb-3 px-4">Contenido</h2>

            <a href="{{ route('proyectos.list') }}"
               class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
               <i class="fas fa-book mr-3 text-lg"></i> Proyectos
            </a>

            <a href="{{ route('blogs.list') }}"
               class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
               <i class="fas fa-book-open mr-3 text-lg"></i> Blogs
            </a>

             <a href="{{ route('reconocimientos.list') }}"
                               class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
                               <i class="fas fa-book-open mr-3 text-lg"></i> Reconociminetos
                            </a>



            <h2 class="text-xs font-semibold uppercase text-forest-400 mt-8 mb-3 px-4">Navegación</h2>

            <a href="/"
               class="flex items-center py-3 px-4 text-base font-medium rounded-xl text-forest-600 hover:bg-nature-50 hover:text-nature-600">
               <i class="fas fa-home mr-3 text-lg"></i> Inicio
            </a>
        </nav>

        <div class="mt-auto p-6 border-t border-nature-100">
            <div class="flex items-center space-x-3 mb-4 p-3 bg-sky-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-400 to-nature-400 flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ substr(auth()->user()->nombre ?? auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-forest-800 truncate">{{ auth()->user()->nombre ?? auth()->user()->name }}</p>
                    <p class="text-xs text-forest-500">Administrador</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center py-3 px-4 text-forest-600 bg-white border border-forest-200 rounded-xl hover:bg-forest-50 hover:text-forest-700 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="bg-white shadow-sm border-b border-nature-200 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-forest-800">Panel de Control</h1>
            </div>
            <div class="flex items-center space-x-3">
                <button class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 hover:bg-sky-100 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-bell"></i>
                </button>
                <button class="w-10 h-10 rounded-xl bg-nature-50 text-nature-600 hover:bg-nature-100 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </header>

        <main class="flex-1 p-6 overflow-y-auto bg-gradient-to-br from-sky-25 to-nature-25">
            <!-- Aquí va el contenido específico de cada página -->
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
