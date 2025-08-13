@extends('layouts.dash2')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Publicaciones de Proyectos</h1>

        <!-- Contenedor con scroll -->
        <div class="overflow-y-scroll h-[70vh]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <!-- Tarjeta de publicación -->
                    <div class="border rounded-lg shadow-lg bg-white p-4 hover:shadow-xl transition-shadow duration-200">
                        <h2 class="text-xl font-semibold mb-2 text-center text-blue-600">{{ $post->title }}</h2>
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
                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-3">No hay publicaciones disponibles.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
