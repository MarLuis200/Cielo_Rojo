<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use DateTime;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:blog,project',
            'content' => 'required|array',
            'image_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $hasImage = false;
        $content = $validated['content'];

        foreach ($content as $index => $field) {
            if ($field['type'] === 'image') {
                if (!empty($field['value'])) {
                    $hasImage = true;
                } elseif ($request->hasFile("image_files.{$index}")) {
                    $hasImage = true;
                }
            }
        }

        if (!$hasImage) {
            return response()->json([
                'message' => 'La publicación debe contener al menos una imagen (URL o archivo)',
                'errors' => ['image' => ['Debes incluir al menos una imagen']]
            ], 422);
        }

        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $index => $image) {
                if (isset($content[$index]) && $content[$index]['type'] === 'image' && empty($content[$index]['value'])) {
                    $path = $image->store('uploads', 'public');
                    $content[$index]['value'] = Storage::url($path);
                }
            }
        }

        $post = Post::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $content,
            'created_at' => (new DateTime)->getTimestamp(),
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
                $post->content = json_decode($post->content, true);
            }
        }

        return view("posts.$category.index", compact('posts'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:blog,project',
            'content' => 'required|array',
            'image_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $content = $validated['content'];

        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $index => $image) {
                if (isset($content[$index]) && $content[$index]['type'] === 'image' && empty($content[$index]['value'])) {
                    $path = $image->store('uploads', 'public');
                    $content[$index]['value'] = Storage::url($path);
                }
            }
        }

        $post->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $content,
            'updated_at' => (new DateTime)->getTimestamp(), // Igual que ProductosController
        ]);

        return response()->json(['message' => 'Publicación actualizada con éxito']);
    }

    public function show($id)
    {
        $project = Post::findOrFail($id);
        if (is_string($project->content)) {
            $project->content = json_decode($project->content, true);
        }

        return view('posts.project.show', compact('project'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $content = is_string($post->content) ? json_decode($post->content, true) : $post->content;

        foreach ($content as $element) {
            if ($element['type'] === 'image' && isset($element['value'])) {
                if (strpos($element['value'], '/storage/uploads/') !== false) {
                    $filename = basename($element['value']);
                    Storage::disk('public')->delete('uploads/' . $filename);
                }
            }
        }
        $post->delete();

        return response()->json(['message' => 'Publicación eliminada con éxito']);
    }
}
