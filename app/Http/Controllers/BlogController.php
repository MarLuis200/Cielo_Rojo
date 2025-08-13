<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Mostrar todos los blogs
    public function index()
    {
        $blogs = Blog::all();
        return view('posts.blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Post::findOrFail($id);
        if (is_string($blog->content)) {
            $blog->content = json_decode($blog->content, true);
        }

        return view('posts.blog.show', compact('blog'));
    }

    // Mostrar el formulario de edición de un blog
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('posts.blog.edit', compact('blog'));
    }


    // Eliminar un blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('posts.blog')->with('message', 'Blog eliminado con éxito');
    }
}
