<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index()
    {
          $proyectos = Proyecto::where('estado', 'publicado')->latest()->get();;
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

public function detail($id)
{
    $proyecto = Proyecto::findOrFail($id);

    return view('proyectos.detail', compact('proyecto'));
}


   public function store(Request $request)
   {
       $request->validate([
           'nombre' => 'required|string|max:255',
           'contenido' => 'required',
           'estado' => 'required|in:publicado,borrador', // <- agregamos validación del estado
           'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
           'video_files.*' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:20000',
       ]);

       $contenido = json_decode($request->contenido, true);

       if (!is_array($contenido)) {
           return response()->json(['message' => 'Contenido inválido'], 422);
       }

       // Subir imágenes
       if ($request->hasFile('image_files')) {
           foreach ($request->file('image_files') as $index => $file) {
               $filename = time() . '_' . $file->getClientOriginalName();
               $destination = public_path('uploads/proyectos');
               $file->move($destination, $filename);

               if (isset($contenido[$index]) && $contenido[$index]['type'] === 'image') {
                   $contenido[$index]['value'] = 'uploads/proyectos/' . $filename;
               }
           }
       }

       // Subir videos
       if ($request->hasFile('video_files')) {
           foreach ($request->file('video_files') as $file) {
               for ($i = 0; $i < count($contenido); $i++) {
                   if ($contenido[$i]['type'] === 'video' &&
                       (empty($contenido[$i]['value']) || str_starts_with($contenido[$i]['value'], 'blob:')))
                   {
                       $filename = time() . '_' . $file->getClientOriginalName();
                       $destination = public_path('uploads/videos');
                       $file->move($destination, $filename);

                       $contenido[$i]['value'] = 'uploads/videos/' . $filename;
                       break;
                   }
               }
           }
       }

       Proyecto::create([
           'administrador_id' => Auth::user()->administrador->id,
           'nombre' => $request->nombre,
           'contenido' => $contenido,
           'estado' => $request->estado,
       ]);

       $msg = $request->estado === 'publicado'
           ? 'Proyecto publicado correctamente'
           : 'Borrador guardado correctamente';

       return response()->json(['message' => $msg]);
   }

    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    public function list()
    {
        $publicados = Proyecto::where('administrador_id', Auth::user()->administrador->id)
            ->where('estado', 'publicado')
            ->latest()
            ->get();

        $borradores = Proyecto::where('administrador_id', Auth::user()->administrador->id)
            ->where('estado', 'borrador')
            ->latest()
            ->get();

        return view('proyectos.list', compact('publicados', 'borradores'));
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()->back()->with('success', 'Proyecto eliminado correctamente');
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        if ($proyecto->administrador_id !== Auth::user()->administrador->id) {
            abort(403);
        }

        return view('proyectos.edit', compact('proyecto'));
    }

public function update(Request $request, $id)
{
    $proyecto = Proyecto::findOrFail($id);

    if ($proyecto->administrador_id !== Auth::user()->administrador->id) {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $request->validate([
        'nombre' => 'required|string|max:255',
        'contenido' => 'required|json',
        'estado' => 'required|in:publicado,borrador',
        'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        'video_files.*' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:20000',
    ]);

    $contenido = json_decode($request->contenido, true);

    if (!is_array($contenido)) {
        return response()->json(['message' => 'Contenido inválido'], 422);
    }

    // Mantener orden del contenido
    $contenido = array_values($contenido);

    // IMÁGENES
    if ($request->hasFile('image_files')) {
        foreach ($request->file('image_files') as $file) {
            for ($i = 0; $i < count($contenido); $i++) {
                if ($contenido[$i]['type'] === 'image' &&
                    (empty($contenido[$i]['value']) || str_starts_with($contenido[$i]['value'], 'data:image')))
                {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $destination = public_path('uploads/proyectos');
                    $file->move($destination, $filename);

                    $contenido[$i]['value'] = 'uploads/proyectos/' . $filename;
                    break;
                }
            }
        }
    }

    // VIDEOS
    if ($request->hasFile('video_files')) {
        foreach ($request->file('video_files') as $file) {
            for ($i = 0; $i < count($contenido); $i++) {
                if ($contenido[$i]['type'] === 'video' &&
                    (empty($contenido[$i]['value']) || str_starts_with($contenido[$i]['value'], 'blob:')))
                {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $destination = public_path('uploads/videos');
                    $file->move($destination, $filename);

                    $contenido[$i]['value'] = 'uploads/videos/' . $filename;
                    break;
                }
            }
        }
    }

    $proyecto->update([
        'nombre' => $request->nombre,
        'contenido' => $contenido,
        'estado' => $request->estado,
    ]);

    return response()->json([
        'message' => 'Proyecto actualizado correctamente',
        'proyecto' => $proyecto->fresh()
    ], 200);
}

}
