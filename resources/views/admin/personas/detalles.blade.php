@extends('layouts.dash2')

@section('content')
    <div x-data="{ showModal: true }" class="container mx-auto p-4">
        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg overflow-y-auto max-h-[90vh]">
                <!-- Encabezado del Modal -->
                <div class="flex justify-between items-center px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-800 text-white rounded-t-lg">
                    <h2 class="text-xl font-semibold">Detalles de Persona</h2>
                    <a href="{{ route('admin.personas.index') }}" class="text-white hover:text-gray-300">&times;</a>
                </div>

                <!-- Contenido del Modal -->
                <div class="px-6 py-4">
                    <!-- Mensaje -->
                    @if(Session::has('message'))
                        <div class="bg-blue-100 text-blue-800 p-4 rounded-lg mb-4">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <!-- Detalles -->
                    <div class="space-y-4">
                        <div>
                            <p class="font-semibold text-lg">Nombre:</p>
                            <p class="text-gray-700">{{ $personas->nombre }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-lg">Apellido Paterno:</p>
                            <p class="text-gray-700">{{ $personas->apellido_paterno }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-lg">Apellido Materno:</p>
                            <p class="text-gray-700">{{ $personas->apellido_materno }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-lg">Dirección:</p>
                            <p class="text-gray-700">{{ $personas->direccion }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-lg">Teléfono:</p>
                            <p class="text-gray-700">{{ $personas->telefono }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-lg">Correo:</p>
                            <p class="text-gray-700">{{ $personas->correo }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-lg">Imagen:</p>
                            <img src="../../../uploads/{{ $personas->img }}" class="rounded shadow-lg w-32">
                        </div>
                    </div>
                </div>

                <!-- Pie del Modal -->
                <div class="px-6 py-4 border-t flex justify-end space-x-2">
                    <a href="{{ route('admin.personas.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cerrar</a>
                    <a href="{{ route('admin.personas.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Volver</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

