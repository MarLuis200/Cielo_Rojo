@extends('layouts.dash2')

@section('content')

    <!-- Fila con botones a los extremos -->
    <div class="flex justify-between mb-4">
        <a href="{{ route('admin.publicaciones') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
            Regresar a las publicaciones
        </a>

        <button type="submit" form="updateForm" class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-400">
            Actualizar
        </button>
    </div>

    <div class="container mx-auto p-6">
        <form method="POST" action="{{ route('admin.publicaciones.update', $post->id) }}" class="bg-white p-6 rounded-lg shadow-lg" id="updateForm">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-medium mb-2">Título</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="category" class="block text-gray-700 font-medium mb-2">Categoría</label>
                <select name="category" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                    <option value="blog" {{ $post->category == 'blog' ? 'selected' : '' }}>Blog</option>
                    <option value="project" {{ $post->category == 'project' ? 'selected' : '' }}>Proyecto</option>
                </select>
            </div>

            <!-- Contenido dinámico con scroll -->
            <div id="dynamicFields" class="space-y-4 overflow-y-auto max-h-[400px] mb-6 border p-4 rounded-lg bg-gray-50">
                @foreach ($post->content as $key => $element)
                    <div class="flex items-center space-x-4 mb-4">
                        <select name="fields[{{ $key }}][type]" class="border border-gray-300 p-3 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 w-1/3">
                            <option value="title" {{ $element['type'] == 'title' ? 'selected' : '' }}>Título</option>
                            <option value="text" {{ $element['type'] == 'text' ? 'selected' : '' }}>Texto</option>
                            <option value="image" {{ $element['type'] == 'image' ? 'selected' : '' }}>Imagen</option>
                            <option value="video" {{ $element['type'] == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        <input type="text" name="fields[{{ $key }}][value]" value="{{ $element['value'] }}" class="w-2/3 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                @endforeach
            </div>

        </form>
    </div>
@endsection
