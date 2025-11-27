<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
         $blogs = Blog::where('estado', 'publicado')->latest()->get();
        return view('blogs.index', compact('blogs'));
    }



   public function detail($id)
   {
       $blog = Blog::findOrFail($id);

       return view('blogs.detail', compact('blog'));
   }

   public function create()
   {
       return view('blogs.create');
   }


    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contenido' => 'required',
            'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'video_files.*' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:20000',
        ]);

        // Decodificar contenido JSON
        $contenido = json_decode($request->contenido, true);
        if (!is_array($contenido)) {
            return response()->json(['message' => 'Contenido inválido'], 422);
        }

        // Obtener el estado: 'publicado' o 'borrador'
        $estado = $request->input('estado', 'borrador');

        /** ------------------------------
         *   MANEJO DE IMÁGENES LOCALES
         * ------------------------------ */
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $index => $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path('uploads/blogs');
                $file->move($destination, $filename);

                // Reemplazar valor en el contenido si corresponde
                if (isset($contenido[$index]) && $contenido[$index]['type'] === 'image') {
                    $contenido[$index]['value'] = 'uploads/blogs/' . $filename;
                }
            }
        }

        /** ------------------------------
         *   MANEJO DE VIDEOS LOCALES
         * ------------------------------ */
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path('uploads/blogs/videos');
                $file->move($destination, $filename);

                // Buscar primer bloque de video sin valor o con blob
                for ($i = 0; $i < count($contenido); $i++) {
                    if ($contenido[$i]['type'] === 'video' &&
                        (empty($contenido[$i]['value']) || str_starts_with($contenido[$i]['value'], 'blob:')))
                    {
                        $contenido[$i]['value'] = 'uploads/blogs/videos/' . $filename;
                        break;
                    }
                }
            }
        }

        // Crear blog
        Blog::create([
            'administrador_id' => Auth::user()->administrador->id,
            'nombre' => $request->nombre,
            'contenido' => $contenido,
            'estado' => $estado,
        ]);

        return response()->json([
            'message' => $estado === 'publicado'
                        ? 'Blog publicado correctamente'
                        : 'Borrador guardado correctamente'
        ]);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function list()
    {
        $publicados = Blog::where('administrador_id', Auth::user()->administrador->id)
            ->where('estado', 'publicado')
            ->latest()
            ->get();

        $borradores = Blog::where('administrador_id', Auth::user()->administrador->id)
            ->where('estado', 'borrador')
            ->latest()
            ->get();

        return view('blogs.list', compact('publicados', 'borradores'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with('success', 'Blog eliminado correctamente');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->administrador_id !== Auth::user()->administrador->id) {
            abort(403);
        }

        return view('blogs.edit', compact('blog'));
    }

  public function update(Request $request, $id)
  {
      $blog = Blog::findOrFail($id);

      if ($blog->administrador_id !== Auth::user()->administrador->id) {
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

      // Ordenar el contenido según el orden recibido desde el frontend
      $contenido = array_values($contenido);

      /** ------------------------------
       *   IMÁGENES LOCALES
       * ------------------------------ */
      if ($request->hasFile('image_files')) {
          foreach ($request->file('image_files') as $file) {
              for ($i = 0; $i < count($contenido); $i++) {
                  if ($contenido[$i]['type'] === 'image' &&
                      (empty($contenido[$i]['value']) || str_starts_with($contenido[$i]['value'], 'data:image')))
                  {
                      $filename = time() . '_' . $file->getClientOriginalName();
                      $destination = public_path('uploads/blogs');
                      $file->move($destination, $filename);

                      $contenido[$i]['value'] = 'uploads/blogs/' . $filename;
                      break;
                  }
              }
          }
      }

      /** ------------------------------
       *   VIDEOS LOCALES
       * ------------------------------ */
      if ($request->hasFile('video_files')) {
          foreach ($request->file('video_files') as $file) {
              for ($i = 0; $i < count($contenido); $i++) {
                  if ($contenido[$i]['type'] === 'video' &&
                      (empty($contenido[$i]['value']) || str_starts_with($contenido[$i]['value'], 'blob:')))
                  {
                      $filename = time() . '_' . $file->getClientOriginalName();
                      $destination = public_path('uploads/blogs/videos');
                      $file->move($destination, $filename);

                      $contenido[$i]['value'] = 'uploads/blogs/videos/' . $filename;
                      break;
                  }
              }
          }
      }

      // Guardar todo junto: nombre, contenido y estado
      $blog->update([
          'nombre' => $request->nombre,
          'contenido' => $contenido,
          'estado' => $request->estado,  // <-- aquí se guarda si es borrador o publicado
      ]);

      return response()->json([
          'message' => 'Blog actualizado correctamente',
          'blog' => $blog->fresh()
      ], 200);
  }
}
