@extends('layouts.ap')

@section('title', 'Detalles del Blog')

@section('content')
    <div class="container mx-auto p-6 md:p-12">

        <!-- Imagen del Blog y Título -->
        <div class="relative mb-10">
            @if(isset($blog->content[0]['value']))
                @php
                    $firstImage = $blog->content[0]['value'];  // Guardamos la primera imagen
                @endphp
                <img class="w-full h-[100vh] object-cover rounded-lg shadow-lg transform transition duration-300 ease-in-out hover:scale-105" src="{{ $firstImage }}" alt="{{ $blog->title }}">
            @else
                <img class="w-full h-[100vh] object-cover rounded-lg shadow-lg transform transition duration-300 ease-in-out hover:scale-105" src="default-image.jpg" alt="Imagen predeterminada">
            @endif
            <div class="absolute inset-x-0 bottom-5 text-center">
                <h2 class="text-white text-4xl font-extrabold bg-black bg-opacity-60 p-3 rounded shadow-lg">{{ $blog->title }}</h2>
            </div>
        </div>

        <!-- Descripción del Blog -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-10">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Descripción del Blog</h3>
            @php
                $firstText = null;
                foreach ($blog->content as $element) {
                    if ($element['type'] === 'text') {
                        $firstText = $element['value'];
                        break;
                    }
                }
            @endphp

            <p class="text-gray-700 mb-4">
                @if($firstText)
                    {{ $firstText }}
                @else
                    Descripción no disponible.
                @endif
            </p>
        </div>

        <!-- Contenido adicional del Blog -->
        <div class="mt-10 space-y-8">
            @foreach ($blog->content as $element)
                @if ($element['type'] === 'text')
                    <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
                        <p class="text-gray-700">{{ $element['value'] }}</p>
                    </div>
                @elseif ($element['type'] === 'image' && isset($element['value']) && $element['value'] !== $firstImage)
                    <!-- Comprobamos que la imagen adicional no sea igual a la primera -->
                    <div class="relative rounded-lg overflow-hidden shadow-lg mb-6">
                        <img src="{{ $element['value'] }}" alt="Imagen adicional" class="w-full h-auto max-h-[500px] object-cover rounded-lg transform transition duration-300 ease-in-out hover:scale-105">
                    </div>
                @elseif ($element['type'] === 'video' && isset($element['value']))
                    @php
                        $videoID = null;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $element['value'], $matches)) {
                            $videoID = $matches[1];
                        }
                    @endphp
                    @if ($videoID)
                        <div class="relative overflow-hidden rounded-lg shadow-lg mb-6">
                            <iframe class="w-full h-[500px] rounded-lg" src="https://www.youtube.com/embed/{{ $videoID }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <p class="text-red-500">URL de video no válida</p>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endsection
