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
      $validated = $request->validate([
          'title' => 'required|string|max:255',
          'category' => 'required|in:blog,project',
          'content' => 'required|array',
      ]);

      foreach ($validated['content'] as &$item) {
          if ($item['type'] === 'video') {
              $url = $item['value'];
              $videoId = null;
              $patterns = [
                  '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^&]+)/',
                  '/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([^&]+)/',
                  '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([^&]+)/',
                  '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/v\/([^&]+)/'
              ];

              foreach ($patterns as $pattern) {
                  if (preg_match($pattern, $url, $matches)) {
                      $videoId = $matches[1];
                      break;
                  }
              }

              if (!$videoId && strlen($url) === 11) {
                  $videoId = $url;
              }

              if (!$videoId) {
                  return response()->json([
                      'message' => 'URL de YouTube no válida: ' . $url
                  ], 422);
              }


              $item['value'] = 'https://www.youtube.com/watch?v=' . $videoId;
          }
      }

      $post = Post::create([
          'title' => $validated['title'],
          'category' => $validated['category'],
          'content' => $validated['content'],
      ]);

      return response()->json([
          'message' => 'Publicación creada con éxito',
          'post' => $post
      ], 201);
  }

    public function show($id)
    {
        $post = Post::findOrFail($id);
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
            'fields' => 'required|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $post = Post::findOrFail($id);


        $content = $request->input('fields');
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
