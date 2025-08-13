@extends('layouts.dash2')

@section('content')

    <div x-data="{ showModal: false, showDeleteModal: false, deleteId: null }" class="container mx-auto p-4 h-screen overflow-y-auto">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Gestión de Personas</h1>
            <button @click="showModal = true" class="flex items-center bg-blue-600 text-white px-4 py-2 mt-2 sm:mt-0 rounded-md hover:bg-blue-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear Persona
            </button>
        </div>

        <div class="mb-6">
            <input
                id="searchInput"
                type="text"
                placeholder="Buscar personas..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                oninput="filterPersons()"
            >
        </div>

        <!-- Tarjetas de Personas -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($personas as $person)
                <div class="relative bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <!-- Enlace Directo a los Detalles -->
                    <a href="{{ route('admin.personas.detalles', $person->id) }}" class="block">
                        <!-- Imagen -->
                        <img src="{{ asset('uploads/' . $person->img) }}"
                             class="w-full h-56 object-cover transition-transform duration-300 hover:scale-105"
                             alt="Imagen de {{ $person->nombre }}">

                        <!-- Contenido -->
                        <div class="p-5">
                            <h2 class="text-lg font-extrabold text-gray-800 truncate tracking-wide">
                                {{ $person->nombre }} {{ $person->apellido_paterno }}
                            </h2>
                            <p class="text-sm text-gray-600 font-medium mt-2"><strong>Dirección:</strong> {{ $person->direccion }}</p>
                            <p class="text-sm text-gray-600 font-medium mt-2"><strong>Teléfono:</strong> {{ $person->telefono }}</p>
                            <p class="text-sm text-gray-600 font-medium mt-2"><strong>Correo:</strong> {{ $person->correo }}</p>
                        </div>
                    </a>

                    <!-- Botón Eliminar -->
                    <div class="p-5 flex justify-end">
                        <button @click="deleteId = {{ $person->id }}; showDeleteModal = true;"
                                class="flex items-center text-red-600 hover:text-red-800 font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M9 6v12m6-12v12M4 6l1.5-2h13l1.5 2" />
                            </svg>
                            Eliminar
                        </button>
                    </div>

                    <div class="absolute top-0 left-0 h-2 w-full bg-blue-600"></div>
                </div>
            @endforeach
        </section>



        <!-- Modal Crear Persona -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Crear Persona</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <form method="POST" action="{{ route('admin.personas.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <input id="nombre" name="nombre" type="text" placeholder="Nombre" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno:</label>
                            <input id="apellido_paterno" name="apellido_paterno" type="text" placeholder="Apellido Paterno" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="apellido_materno" class="block text-sm font-medium text-gray-700">Apellido Materno:</label>
                            <input id="apellido_materno" name="apellido_materno" type="text" placeholder="Apellido Materno" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección:</label>
                            <input id="direccion" name="direccion" type="text" placeholder="Dirección" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                            <input id="telefono" name="telefono" type="text" placeholder="Teléfono" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="correo" class="block text-sm font-medium text-gray-700">Correo:</label>
                            <input id="correo" name="correo" type="email" placeholder="Correo" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="img" class="block text-sm font-medium text-gray-700">Imagen:</label>
                            <input id="img" name="img" type="file"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="px-6 py-3 border-t flex justify-end space-x-2">
                        <button @click="showModal = false" type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Confirmar Eliminación -->
        <div x-show="showDeleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm">
                <div class="px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">¿Estás seguro de eliminar esta persona?</h3>
                </div>
                <div class="px-6 py-4 flex justify-end space-x-2 border-t">
                    <button @click="showDeleteModal = false" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancelar</button>
                    <form :action="`/admin/personas/eliminar/${deleteId}`" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
