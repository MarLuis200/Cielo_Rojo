@extends('layouts.dash2')

@section('content')
<div class="container mx-auto">


    <h1 class="text-3xl font-bold mb-6 text-gray-800">Mis Proyectos</h1>

    {{-- ===============================
        PROYECTOS PUBLICADOS
    =============================== --}}
    <div class="mb-10">
        <h2 class="text-2xl font-semibold mb-3 text-green-700">Publicados</h2>

        @if($publicados->isEmpty())
            <p class="text-gray-500">No hay proyectos publicados.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($publicados as $p)

                    @php
                        $primerTexto = null;
                        $primerImagen = null;

                        if (is_array($p->contenido)) {
                            foreach ($p->contenido as $item) {

                                // PRIMERA IMAGEN (local o URL)
                                if ($item['type'] === 'image' && !$primerImagen) {

                                    $value = $item['value'];
                                    if (Str::startsWith($value, ['http://', 'https://'])) {
                                        $primerImagen = $value;

                                    } else {
                                        $primerImagen = '/' . ltrim($value, '/');
                                    }
                                }

                                // PRIMER TEXTO
                                if (($item['type'] === 'text' || $item['type'] === 'title') && !$primerTexto) {
                                    $primerTexto = Str::limit($item['value'], 100);
                                }
                            }
                        }
                    @endphp

                    <div class="bg-white shadow rounded-lg overflow-hidden">

                        {{-- IMAGEN --}}
                        @if($primerImagen)
                            <img src="{{ $primerImagen }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                                Sin imagen
                            </div>
                        @endif

                        <div class="p-4">
                            {{-- TÍTULO --}}
                            <h3 class="text-lg font-bold text-gray-800">{{ $p->nombre }}</h3>

                            {{-- DESCRIPCIÓN --}}
                            <p class="text-sm text-gray-600 mt-2">
                                {{ $primerTexto ?? 'Sin descripción disponible.' }}
                            </p>

                            {{-- BOTONES --}}
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('proyectos.show', $p->id) }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                    Ver
                                </a>

                                <a href="{{ route('proyectos.edit', $p->id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                    Editar
                                </a>

                                <form action="{{ route('proyectos.destroy', $p->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar proyecto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>
        @endif
    </div>


    {{-- ===============================
        BORRADORES
    =============================== --}}
    <div>
        <h2 class="text-2xl font-semibold mb-3 text-yellow-600">Borradores</h2>

        @if($borradores->isEmpty())
            <p class="text-gray-500">No hay borradores.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($borradores as $p)

                    @php
                        $primerTexto = null;
                        $primerImagen = null;

                        if (is_array($p->contenido)) {
                            foreach ($p->contenido as $item) {

                                if ($item['type'] === 'image' && !$primerImagen) {
                                    $primerImagen = '/' . ltrim($item['value'], '/');
                                }

                                if (($item['type'] === 'text' || $item['type'] === 'title') && !$primerTexto) {
                                    $primerTexto = Str::limit($item['value'], 100);
                                }

                            }
                        }
                    @endphp

                    <div class="bg-white shadow rounded-lg overflow-hidden">

                        {{-- IMAGEN --}}
                        @if($primerImagen)
                            <img src="{{ $primerImagen }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                                Sin imagen
                            </div>
                        @endif

                        <div class="p-4">
                            {{-- TÍTULO --}}
                            <h3 class="text-lg font-bold text-gray-800">{{ $p->nombre }}</h3>

                            {{-- DESCRIPCIÓN --}}
                            <p class="text-sm text-gray-600 mt-2">
                                {{ $primerTexto ?? 'Sin descripción disponible.' }}
                            </p>

                            {{-- BOTONES --}}
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('proyectos.show', $p->id) }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                    Ver
                                </a>

                                <a href="{{ route('proyectos.edit', $p->id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                    Editar
                                </a>

                                <form action="{{ route('proyectos.destroy', $p->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar proyecto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>
        @endif
    </div>

</div>
@endsection
