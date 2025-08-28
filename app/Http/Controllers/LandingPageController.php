<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Post;
use App\Models\Tipos;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }


    public function blogs()
    {
        $blogs = Post::where('category', 'blog')->get();

        foreach ($blogs as $blog) {
            if (is_string($blog->content)) {
                $blog->content = json_decode($blog->content, true);
            }
        }
        return view('landing.blogs', compact('blogs'));
    }

    public function proyectos()
    {
        $projects = Post::where('category', 'project')->get();
        foreach ($projects as $project) {
            if (is_string($project->content)) {
                $project->content = json_decode($project->content, true);
            }
        }

        return view('Landing.proyectos', compact('projects'));

    }


    public function galeria()
    {
        return view('landing.galeria');
    }

    public function acerca()
    {
        return view('landing.acerca');
    }

public function quienesSomos()
{

    $projects = Post::where('category', 'project')->get();
    foreach ($projects as $project) {
        if (is_string($project->content)) {
            $project->content = json_decode($project->content, true);
        }
    }

   $blogs = Post::where('category', 'blog')->take(3)->get();

   foreach ($blogs as $blog) {
       if (is_string($blog->content)) {
           $blog->content = json_decode($blog->content, true);
       }
   }


    return view('Landing.quienes-somos', compact('projects', 'blogs'));
}


    public function premios()
    {
        return view('landing.premios');
    }

    public function donaciones()
    {
        return view('landing.donaciones');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
