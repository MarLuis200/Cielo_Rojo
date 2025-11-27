<?php

namespace App\Http\Controllers;

use App\Models\Reconocimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReconocimientoController extends Controller
{
    public function index()
    {
        $reconocimientos = Reconocimiento::where('estado', 'publicado')->latest()->get();
        return view('reconocimientos.index', compact('reconocimientos'));
    }

    public function detail($id)
    {
        $reconocimiento = Reconocimiento::findOrFail($id);
        return view('reconocimientos.detail', compact('reconocimiento'));
    }

    public function create()
    {
        return view('reconocimientos.create');
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|json',
            'estado' => 'nullable|in:publicado,borrador',
            'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $contenido = json_decode($request->contenido, true);
        if (!is_array($contenido)) {
            return response()->json(['message' => 'Contenido inválido'], 422);
        }

        $estado = $request->input('estado', 'borrador');

        // Guardar imágenes e iconos
        if ($request->hasFile('image_files')) {
            $destination = public_path('uploads/reconocimientos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            foreach ($request->file('image_files') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move($destination, $filename);

                // Reemplaza elementos temporales en el contenido
                foreach ($contenido as &$item) {
                    if (in_array($item['type'], ['imagen', 'icono']) && isset($item['value']) && str_contains($item['value'], 'temp')) {
                        $item['value'] = 'uploads/reconocimientos/' . $filename;
                        break; // Reemplaza uno por archivo
                    }
                }
            }
        }

        // Procesar contenido para almacenamiento
        $contenido = $this->procesarContenidoParaAlmacenamiento($contenido);

        // Crear reconocimiento
        Reconocimiento::create([
            'administrador_id' => Auth::user()->administrador->id,
            'titulo' => $request->titulo,
            'contenido' => $contenido,
            'estado' => $estado,
        ]);

        return response()->json([
            'message' => $estado === 'publicado'
                ? 'Reconocimiento publicado correctamente'
                : 'Borrador guardado correctamente'
        ]);
    }

    public function show($id)
    {
        $reconocimiento = Reconocimiento::findOrFail($id);
        return view('reconocimientos.show', compact('reconocimiento'));
    }

    public function list()
    {
        $publicados = Reconocimiento::where('administrador_id', Auth::user()->administrador->id)
            ->where('estado', 'publicado')
            ->latest()
            ->get();

        $borradores = Reconocimiento::where('administrador_id', Auth::user()->administrador->id)
            ->where('estado', 'borrador')
            ->latest()
            ->get();

        return view('reconocimientos.list', compact('publicados', 'borradores'));
    }

public function edit($id)
{
    $reconocimiento = Reconocimiento::findOrFail($id);
    $contenido = collect($reconocimiento->contenido)->map(function($item) {
        if (in_array($item['type'], ['imagen', 'icono']) && isset($item['value'])) {
            if (!str_starts_with($item['value'], 'data:') && !str_starts_with($item['value'], 'http')) {
                $item['value'] = asset('storage/' . $item['value']);
            }
        }
        return $item;
    });

    $reconocimiento->contenido = $contenido;

    return view('reconocimientos.edit', compact('reconocimiento'));
}


    public function update(Request $request, $id)
    {
        $reconocimiento = Reconocimiento::findOrFail($id);
        if ($reconocimiento->administrador_id !== Auth::user()->administrador->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|json',
            'estado' => 'required|in:publicado,borrador',
            'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $contenido = json_decode($request->contenido, true);
        if (!is_array($contenido)) {
            return response()->json(['message' => 'Contenido inválido'], 422);
        }

        // Guardar nuevas imágenes e iconos
        if ($request->hasFile('image_files')) {
            $destination = public_path('uploads/reconocimientos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            foreach ($request->file('image_files') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move($destination, $filename);

                foreach ($contenido as &$item) {
                    if (in_array($item['type'], ['imagen', 'icono']) && isset($item['value']) && str_contains($item['value'], 'temp')) {
                        $item['value'] = 'uploads/reconocimientos/' . $filename;
                        break;
                    }
                }
            }
        }

        $contenido = $this->procesarContenidoParaAlmacenamiento($contenido);

        $reconocimiento->update([
            'titulo' => $request->titulo,
            'contenido' => $contenido,
            'estado' => $request->estado,
        ]);

        return response()->json([
            'message' => 'Reconocimiento actualizado correctamente',
            'reconocimiento' => $reconocimiento->fresh()
        ], 200);
    }

    public function destroy($id)
    {
        $reconocimiento = Reconocimiento::findOrFail($id);
        $this->eliminarArchivosReconocimiento($reconocimiento->contenido);
        $reconocimiento->delete();

        return redirect()->back()->with('success', 'Reconocimiento eliminado correctamente');
    }

    /** ------------------------------
     * FUNCIONES PRIVADAS
     * ------------------------------ */

    private function eliminarArchivosReconocimiento($contenido)
    {
        if (!is_array($contenido)) return;

        foreach ($contenido as $bloque) {
            if (in_array($bloque['type'], ['imagen', 'icono']) &&
                isset($bloque['value']) &&
                file_exists(public_path($bloque['value'])) &&
                str_starts_with($bloque['value'], 'uploads/reconocimientos/')) {
                unlink(public_path($bloque['value']));
            }
        }
    }

  private function procesarContenidoParaAlmacenamiento($contenido)
  {
      $contenidoProcesado = [];

      foreach ($contenido as $item) {
          if ($item['type'] === 'fondo') {
              // Simplificar fondo - solo guardar el valor esencial
              if (str_starts_with($item['value'], 'linear-gradient') || str_starts_with($item['value'], '#')) {
                  $contenidoProcesado[] = [
                      'type' => 'fondo_color',
                      'value' => $item['value']
                  ];
              } else if (str_starts_with($item['value'], 'url')) {
                  // Extraer solo la URL, no todo el CSS
                  $bgValue = $item['value'];
                  if (preg_match('/url\([\'"]([^\'"]+)[\'"]\)/', $bgValue, $matches)) {
                      $bgValue = $matches[1];
                  }
                  $contenidoProcesado[] = [
                      'type' => 'fondo_imagen',
                      'value' => $bgValue
                  ];
              }
          } else {
              // Elementos simplificados
              $elementoProcesado = [
                  'type' => $item['type'],
                  'value' => $item['value']
              ];

              // Solo incluir posición si existe y es diferente de default
              if (isset($item['position']) &&
                  !($item['position']['x'] == 50 && $item['position']['y'] == 50)) {
                  $elementoProcesado['position'] = $item['position'];
              }

              // Solo incluir estilos si existen y no están vacíos
              if (isset($item['style']) && !empty($item['style'])) {
                  $elementoProcesado['style'] = $item['style'];
              }

              // Solo incluir ID si es necesario
              if (isset($item['id']) && in_array($item['type'], ['imagen', 'icono'])) {
                  $elementoProcesado['id'] = $item['id'];
              }

              $contenidoProcesado[] = $elementoProcesado;
          }
      }

      return $contenidoProcesado;
  }
}
