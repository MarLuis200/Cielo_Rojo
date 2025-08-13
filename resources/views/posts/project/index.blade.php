@extends('layouts.dash2')

@section('content')
    <div class="container">
        <h1>Proyectos Publicados</h1>
        @foreach ($posts as $post)
            <div class="mb-4">
                <h2>{{ $post->title }}</h2>
                @foreach ($post->content as $element)
                    @if ($element['type'] === 'title')
                        <h3>{{ $element['value'] }}</h3>
                    @elseif ($element['type'] === 'text')
                        <p>{{ $element['value'] }}</p>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
