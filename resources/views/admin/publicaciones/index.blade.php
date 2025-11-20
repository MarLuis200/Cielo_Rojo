@extends('layouts.dash2')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Todas las Publicaciones</h1>

        <div class="flex justify-end mb-4">
            <button id="openModal" class="px-4 py-2 bg-emerald-300 text-black rounded-lg hover:bg-blue-300-500">
                Crear Publicación
            </button>
        </div>

        @if(session()->has('message'))
            <div class="bg-red-700 text-white p-4 rounded-lg mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-y-scroll h-[70vh]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <div class="border rounded-lg shadow-lg bg-white p-4 hover:shadow-xl transition-shadow duration-200">
                        <h2 class="text-xl font-semibold mb-2 text-center text-blue-600">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-500 mb-4">Tipo: {{ $post->category === 'blog' ? 'Blog' : 'Proyecto' }}</p>
                        <div class="space-y-4">
                            @foreach ($post->content as $element)
                                @if ($element['type'] === 'title')
                                    <h3 class="text-lg font-bold text-gray-800">{{ $element['value'] }}</h3>
                                @elseif ($element['type'] === 'text')
                                    <p class="text-gray-700">{{ $element['value'] }}</p>
                                @elseif ($element['type'] === 'image' && isset($element['value']))
                                    <img src="{{ $element['value'] }}" alt="Imagen" class="w-full h-40 object-cover rounded-lg">
                                @elseif ($element['type'] === 'video' && isset($element['value']))
                                    @php
                                        $videoID = null;
                                        if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $element['value'], $matches)) {
                                            $videoID = $matches[1];
                                        }
                                    @endphp
                                    @if ($videoID)
                                        <iframe class="w-full h-40 rounded-lg"
                                                src="https://www.youtube.com/embed/{{ $videoID }}"
                                                frameborder="0"
                                                allowfullscreen></iframe>
                                    @else
                                        <p class="text-red-500">URL de video no válida</p>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('admin.publicaciones.edit', $post->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                                Editar
                            </a>
                            <form action="{{ route('admin.publicaciones.eliminar', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-3">No hay publicaciones disponibles.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

