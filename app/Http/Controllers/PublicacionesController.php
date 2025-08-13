<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PublicacionesController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            if (is_string($post->content)) {
                $post->content = json_decode($post->content, true);
            }
        }

        return view('admin.publicaciones.index', compact('posts'));
    }


    public function crear()
    {
        $posts = Post::all();
        return view('admin.publicaciones.crear', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:blog,project',
            'content' => 'required|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $content = $request->input('content');

        // Procesar imágenes si existen
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads', 'public');
                if (isset($content[$index]) && $content[$index]['type'] === 'image') {
                    $content[$index]['value'] = Storage::url($path);
                }
            }
        }

        $post = Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => json_encode($content),
        ]);

        return redirect()->route('admin.publicaciones')
            ->with('message', 'Publicación creada con éxito.');
    }

    // Mostrar una publicación específica
    public function show($id)
    {
        $post = Post::findOrFail($id); // Obtener la publicación por ID
        return view('admin.publicaciones.detalles', compact('post'));
    }


    public function editar($id)
    {
        $post = Post::findOrFail($id);

        if (is_string($post->content)) {
            $post->content = json_decode($post->content, true);
        }

        return view('admin.publicaciones.editar', compact('post'));
    }


    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:blog,project',
            'fields' => 'required|array', // Validar los campos dinámicos
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Obtener la publicación que se va a actualizar
        $post = Post::findOrFail($id);

        // Obtener los campos del formulario (campos dinámicos)
        $content = $request->input('fields'); // Obtenemos los campos dinámicos

        // Procesar las imágenes si existen
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads', 'public');
                if (isset($content[$index]) && $content[$index]['type'] === 'image') {
                    $content[$index]['value'] = Storage::url($path);
                }
            }
        }


        $post->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => json_encode($content),
        ]);

        return redirect()->route('admin.publicaciones')
            ->with('message', 'Publicación actualizada con éxito.');
    }


    public function eliminar($id)
    {
        $post = Post::findOrFail($id);
        $content = $post->content;
        if (is_string($content)) {
            $content = json_decode($content, true);
        }

        foreach ($content as $item) {
            if ($item['type'] === 'image' && isset($item['value'])) {
                $imagePath = str_replace('/storage/', '', $item['value']);
                Storage::disk('public')->delete($imagePath);
            }
        }

        $post->delete();

        return redirect()->route('admin.publicaciones')
            ->with('message', 'Publicación eliminada con éxito.');
    }

}
