@extends('layouts.dash2')
@section('content')
<h1 class="text-2xl font-bold mb-4">Proyectos</h1>

<a href="{{ route('proyectos.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
    Crear Proyecto
</a>

<div class="mt-6">
    @foreach($proyectos as $p)
        <div class="border p-4 mb-3 rounded shadow">
            <h2 class="text-xl font-semibold">{{ $p->nombre }}</h2>
            <p>{{ Str::limit($p->descripcion, 120) }}</p>
            <a href="{{ route('proyectos.show', $p->id) }}" class="text-blue-500">Ver proyecto</a>
        </div>
    @endforeach
</div>
@endsection
