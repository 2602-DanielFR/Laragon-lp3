<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProyectoController extends Controller
{
    /**
     * Aplicar middleware de autenticación en ciertos métodos
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource (Pública)
     */
    public function index(Request $request)
    {
        $query = Proyecto::where('estado', 'activo')->with('categoria', 'user');

        // Filtrar por categoría
        if ($request->has('categoria') && $request->categoria) {
            $query->where('categoria_id', $request->categoria);
        }

        // Búsqueda por título o descripción
        if ($request->has('buscar') && $request->buscar) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('titulo', 'LIKE', "%{$buscar}%")
                  ->orWhere('descripcion_corta', 'LIKE', "%{$buscar}%");
            });
        }

        // Ordenamiento
        $orden = $request->get('orden', 'reciente');
        match ($orden) {
            'reciente' => $query->orderBy('created_at', 'desc'),
            'antiguo' => $query->orderBy('created_at', 'asc'),
            'mas_donaciones' => $query->orderBy('contador_donaciones', 'desc'),
            'cercanos_meta' => $query->orderBy('porcentaje_alcanzado', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $proyectos = $query->paginate(12);
        $categorias = Categoria::all();

        return view('proyectos.index', compact('proyectos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource (Solo emprendedores autenticados)
     */
    public function create()
    {
        // Verificar que el usuario tenga rol de emprendedor (ya está validado por middleware)
        $categorias = Categoria::all();
        return view('proyectos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:500',
            'descripcion' => 'required|string|min:50',
            'categoria_id' => 'required|exists:categorias,id',
            'objetivo_recaudacion' => 'required|numeric|min:100',
            'fecha_fin' => 'required|date|after:today',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Procesar imagen principal
            if ($request->hasFile('imagen')) {
                $validated['imagen'] = $request->file('imagen')->store('proyectos/imagenes', 'public');
            }

            // Procesar imagen banner
            if ($request->hasFile('imagen_banner')) {
                $validated['imagen_banner'] = $request->file('imagen_banner')->store('proyectos/banners', 'public');
            }

            // Asignar datos adicionales
            $validated['user_id'] = auth()->id();
            $validated['estado'] = 'pendiente_revision';
            $validated['fecha_inicio'] = now();
            $validated['porcentaje_alcanzado'] = 0;

            // Crear proyecto
            $proyecto = Proyecto::create($validated);

            return redirect()->route('emprendedor.dashboard')
                           ->with('success', 'Proyecto creado exitosamente. Está pendiente de revisión por los administradores.');
        } catch (\Exception $e) {
            return back()->withInput()
                        ->with('error', 'Error al crear el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with(['categoria', 'user.emprendedor', 'actualizaciones'])
                           ->findOrFail($id);

        // Solo mostrar proyectos públicos o si es el propietario/admin
        if ($proyecto->estado !== 'activo' && 
            (!auth()->check() || (auth()->id() !== $proyecto->user_id && !auth()->user()->isAdmin()))) {
            abort(403, 'No tienes permiso para ver este proyecto');
        }

        $actualizaciones = $proyecto->actualizaciones()->latest()->paginate(5);

        return view('proyectos.show', compact('proyecto', 'actualizaciones'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Verificar que sea propietario
        if (auth()->id() !== $proyecto->user_id) {
            abort(403, 'No tienes permiso para editar este proyecto');
        }

        // No permitir editar proyectos aprobados o activos
        if (in_array($proyecto->estado, ['activo', 'completado', 'cancelado', 'rechazado'])) {
            return back()->with('error', 'No puedes editar un proyecto en este estado');
        }

        $categorias = Categoria::all();
        return view('proyectos.edit', compact('proyecto', 'categorias'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Verificar permisos
        if (auth()->id() !== $proyecto->user_id) {
            abort(403, 'No tienes permiso para actualizar este proyecto');
        }

        // Validar que sea borrador o pendiente
        if (!in_array($proyecto->estado, ['draft', 'pendiente_revision'])) {
            return back()->with('error', 'No puedes editar un proyecto en este estado');
        }

        // Validar datos
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:500',
            'descripcion' => 'required|string|min:50',
            'categoria_id' => 'required|exists:categorias,id',
            'objetivo_recaudacion' => 'required|numeric|min:100',
            'fecha_fin' => 'required|date|after:today',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Procesar imagen principal
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior
                if ($proyecto->imagen) {
                    Storage::disk('public')->delete($proyecto->imagen);
                }
                $validated['imagen'] = $request->file('imagen')->store('proyectos/imagenes', 'public');
            }

            // Procesar imagen banner
            if ($request->hasFile('imagen_banner')) {
                // Eliminar banner anterior
                if ($proyecto->imagen_banner) {
                    Storage::disk('public')->delete($proyecto->imagen_banner);
                }
                $validated['imagen_banner'] = $request->file('imagen_banner')->store('proyectos/banners', 'public');
            }

            // Actualizar proyecto
            $proyecto->update($validated);

            return redirect()->route('emprendedor.dashboard')
                           ->with('success', 'Proyecto actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                        ->with('error', 'Error al actualizar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage (Solo borrador)
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Verificar permisos
        if (auth()->id() !== $proyecto->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para eliminar este proyecto');
        }

        // Solo permitir eliminar borradores
        if ($proyecto->estado !== 'draft') {
            return back()->with('error', 'Solo puedes eliminar proyectos en estado de borrador');
        }

        try {
            // Eliminar imágenes
            if ($proyecto->imagen) {
                Storage::disk('public')->delete($proyecto->imagen);
            }
            if ($proyecto->imagen_banner) {
                Storage::disk('public')->delete($proyecto->imagen_banner);
            }

            $proyecto->delete();

            return redirect()->route('emprendedor.dashboard')
                           ->with('success', 'Proyecto eliminado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el proyecto: ' . $e->getMessage());
        }
    }
}