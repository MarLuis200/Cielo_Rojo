<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Post;
class ProjectController extends Controller
{

    public function index()
    {

        $projects = Project::all();
        return view('posts.project.index', compact('projects'));
    }


    public function show($id)
    {
        $project = Post::findOrFail($id);
        if (is_string($project->content)) {
            $project->content = json_decode($project->content, true);
        }

        return view('posts.project.show', compact('project'));
    }


    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('posts.project.edit', compact('project'));
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('posts.project')->with('message', 'Proyecto eliminado con éxito');
    }
}
