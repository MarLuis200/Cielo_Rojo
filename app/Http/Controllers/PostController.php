<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'required|string|in:blog,project',
            'content' => 'required|array', // Contenido como array
            'images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Validar imágenes
        ]);

        $content = $validated['content'];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads', 'public');
                if (isset($content[$index]) && $content[$index]['type'] === 'image') {
                    $content[$index]['value'] = Storage::url($path);
                }
            }
        }
        $post = Post::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $content,
        ]);

        return response()->json(['message' => 'Publicación creada con éxito', 'post' => $post], 201);
    }


    public function index($category)
    {
        if (!in_array($category, ['blog', 'project'])) {
            abort(404);
        }
        $posts = Post::where('category', $category)->get();

        foreach ($posts as $post) {
            if (is_string($post->content)) {
                $post->content = json_decode($post->content, true); // Convertir el contenido a un array
            }
        }

        return view("posts.$category.index", compact('posts'));
    }



    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $content = $request->input('content'); // Suponiendo que estás enviando los datos correctamente

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads', 'public');
                if (isset($content[$index]) && $content[$index]['type'] === 'image') {
                    $content[$index]['value'] = Storage::url($path); // Actualiza la URL de la imagen
                }
            }
        }

        $post->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => json_encode($content), // Asegúrate de guardar el contenido correctamente
        ]);

        return redirect()->route('landing.proyectos')
            ->with('message', 'Proyecto actualizado con éxito.');
    }


    public function show($id)
    {
        $project = Post::findOrFail($id);
        if (is_string($project->content)) {
            $project->content = json_decode($project->content, true);
        }

        return view('posts.project.show', compact('project'));
    }


}
