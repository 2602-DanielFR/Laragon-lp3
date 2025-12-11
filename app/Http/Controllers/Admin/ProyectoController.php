<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyecto; // Ensured this is present
use App\Models\Categoria; // Ensured this is present
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Constructor - Middleware de autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Asumiendo que existe un middleware admin
    }

    /**
     * Display a listing of the resource - Todos los proyectos con diferentes estados
     */
    public function index(Request $request)
    {
        $query = Proyecto::with(['user', 'categoria']);

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $proyectos = $query->paginate(12);
        $categorias = Categoria::all();

        // Estadísticas
        $stats = [
            'total' => Proyecto::count(),
            'pendiente_revision' => Proyecto::where('estado', Proyecto::STATUS_PENDING)->count(),
            'activos' => Proyecto::where('estado', Proyecto::STATUS_ACTIVE)->count(),
            'rechazados' => Proyecto::where('estado', Proyecto::STATUS_REJECTED)->count(),
            'completados' => Proyecto::where('estado', Proyecto::STATUS_COMPLETED)->count(),
            'borradores' => Proyecto::where('estado', Proyecto::STATUS_DRAFT)->count(),
            'cancelados' => Proyecto::where('estado', Proyecto::STATUS_CANCELLED)->count(),
        ];

        return view('admin.proyectos.index', compact('proyectos', 'categorias', 'stats'));
    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with([
            'user',
            'categoria',
            'donaciones'
        ])->findOrFail($id);

        return view('admin.proyectos.show', compact('proyecto'));
    }

    /**
     * Aprobar un proyecto
     */
    public function aprobar(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Validar que el proyecto esté en pendiente revisión
        if ($proyecto->estado !== Proyecto::STATUS_PENDING) {
            return redirect()
                ->back()
                ->with('error', 'Solo se pueden aprobar proyectos en estado "Pendiente de Revisión".');
        }

        try {
            $proyecto->update([
                'estado' => Proyecto::STATUS_ACTIVE,
                'fecha_inicio' => now(), // Activar fecha de inicio al aprobar
            ]);

            // TODO: Enviar notificación al emprendedor (opcional)
            // Mail::to($proyecto->user->email)->send(new ProyectoAprobado($proyecto));

            return redirect()
                ->route('admin.proyectos.show', $proyecto->id)
                ->with('success', 'Proyecto aprobado exitosamente. Ahora está activo.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al aprobar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Rechazar un proyecto
     */
    public function rechazar(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Validar que el proyecto esté en pendiente revisión
        if ($proyecto->estado !== Proyecto::STATUS_PENDING) {
            return redirect()
                ->back()
                ->with('error', 'Solo se pueden rechazar proyectos en estado "Pendiente de Revisión".');
        }

        $validated = $request->validate([
            'razon_rechazo' => 'required|string|max:1000',
        ], [
            'razon_rechazo.required' => 'Debes proporcionar un motivo de rechazo.',
            'razon_rechazo.max' => 'El motivo no puede exceder 1000 caracteres.',
        ]);

        try {
            $proyecto->update([
                'estado' => Proyecto::STATUS_REJECTED,
                'razon_rechazo' => $validated['razon_rechazo'],
            ]);

            // TODO: Enviar notificación al emprendedor (opcional)
            // Mail::to($proyecto->user->email)->send(new ProyectoRechazado($proyecto));

            return redirect()
                ->route('admin.proyectos.show', $proyecto->id)
                ->with('success', 'Proyecto rechazado.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al rechazar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Revertir estado a pendiente revisión
     */
    public function revertir(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Solo se puede revertir si está rechazado
        if ($proyecto->estado !== Proyecto::STATUS_REJECTED) {
            return redirect()
                ->back()
                ->with('error', 'Solo se pueden revertir proyectos rechazados.');
        }

        try {
            $proyecto->update([
                'estado' => Proyecto::STATUS_PENDING,
                'razon_rechazo' => null,
            ]);

            return redirect()
                ->route('admin.proyectos.show', $proyecto->id)
                ->with('success', 'El proyecto ha sido revertido a estado "Pendiente de Revisión".');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al revertir el estado: ' . $e->getMessage());
        }
    }
}