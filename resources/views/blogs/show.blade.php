@extends('layouts.dash2')

@section('content')

<div class="container mx-auto py-6" x-data="{ openModal: true }">

    <div x-show="openModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 bg-gray-900/50 flex items-center justify-center z-50 p-4">

        <div class="bg-white w-full max-w-4xl rounded-xl shadow-2xl overflow-hidden"
             x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             @click.away="openModal = false">

            <!-- Header elegante -->
            <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900">{{ $blog->nombre }}</h2>
                            <p class="text-sm text-gray-500 mt-1">Detalles del blog</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="max-h-[70vh] overflow-y-auto p-8">
                <div class="space-y-8">

                    @if(!$blog->contenido || count($blog->contenido) == 0)
                        <div class="text-center py-12">
                            <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Sin contenido</h3>
                            <p class="text-gray-500">No hay elementos para mostrar en este blog.</p>
                        </div>
                    @endif

                    @foreach($blog->contenido as $index => $item)

                        {{-- Texto --}}
                        @if($item['type'] === 'text')
                            <div class="group">
                                <div class="flex items-start space-x-4 p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200 border border-transparent hover:border-gray-200">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed flex-1">
                                        {{ $item['value'] }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        {{-- Título --}}
                        @if($item['type'] === 'title')
                            <div class="group border-l-4 border-blue-500 pl-6 ml-2">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        {{ $item['value'] }}
                                    </h3>
                                </div>
                                <div class="ml-11 mt-2 w-12 h-0.5 bg-blue-200 rounded-full"></div>
                            </div>
                        @endif

                        {{-- Imagen --}}
                        @if($item['type'] === 'image')
                            <div class="group">
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">Imagen</span>
                                    </div>
                                    <div class="text-center">
                                        <img src="{{ asset($item['value']) }}"
                                             class="rounded-lg shadow-sm max-h-80 mx-auto border border-gray-200"
                                             alt="Imagen del blog">
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Video --}}
                        @if($item['type'] === 'video')
                            <div class="group">
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">Video</span>
                                    </div>
                                    <div class="text-center">
                                        @php
                                            $value = $item['value'];
                                            $esUrl = filter_var($value, FILTER_VALIDATE_URL);
                                        @endphp

                                        @if($esUrl && (str_contains($value, 'youtube.com') || str_contains($value, 'youtu.be')))
                                            @php
                                                $videoId = null;
                                                if (preg_match('/youtu\.be\/([^\?]+)/', $value, $match)) {
                                                    $videoId = $match[1];
                                                } elseif (preg_match('/v=([^\&]+)/', $value, $match)) {
                                                    $videoId = $match[1];
                                                }
                                            @endphp

                                            @if($videoId)
                                                <iframe class="rounded-lg shadow-sm w-full max-w-2xl mx-auto border border-gray-200"
                                                        height="350"
                                                        src="https://www.youtube.com/embed/{{ $videoId }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                </iframe>
                                            @endif

                                        @elseif($esUrl)
                                            <video controls class="rounded-lg shadow-sm w-full max-w-2xl mx-auto border border-gray-200">
                                                <source src="{{ $value }}">
                                            </video>
                                        @else
                                            <video controls class="rounded-lg shadow-sm w-full max-w-2xl mx-auto border border-gray-200">
                                                <source src="{{ asset($value) }}">
                                            </video>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforeach

                </div>
            </div>

            <!-- Footer profesional -->
            <div class="bg-gray-50 border-t border-gray-200 px-8 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span>{{ count($blog->contenido ?? []) }} elementos</span>
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div class="text-gray-500">Blog</div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button
                            @click="window.location.href='{{ route('blogs.list') }}'"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            Cerrar
                        </button>
                        <button
                            @click="window.location.href='{{ route('blogs.list') }}'"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Volver a blogs</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 6px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; border-radius: 3px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

@endsection
