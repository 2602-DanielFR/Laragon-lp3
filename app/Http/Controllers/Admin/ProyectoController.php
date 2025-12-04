<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\Categoria;
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
        $query = Proyecto::with(['emprendedor.user', 'categoria']);

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
                  ->orWhereHas('emprendedor.user', function($q) use ($search) {
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
            'pendientes' => Proyecto::where('estado', 'pendiente')->count(),
            'aprobados' => Proyecto::where('estado', 'aprobado')->count(),
            'rechazados' => Proyecto::where('estado', 'rechazado')->count(),
        ];

        return view('admin.proyectos.index', compact('proyectos', 'categorias', 'stats'));
    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with([
            'emprendedor.user',
            'categoria',
            'donaciones.donante.user'
        ])->findOrFail($id);

        // Calcular estadísticas del proyecto
        $totalRecaudado = $proyecto->donaciones->sum('monto');
        $porcentajeRecaudado = $proyecto->meta_financiamiento > 0 
            ? ($totalRecaudado / $proyecto->meta_financiamiento) * 100 
            : 0;
        $totalDonantes = $proyecto->donaciones->count();

        return view('admin.proyectos.show', compact(
            'proyecto',
            'totalRecaudado',
            'porcentajeRecaudado',
            'totalDonantes'
        ));
    }

    /**
     * Aprobar un proyecto
     */
    public function aprobar(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Validar que el proyecto esté pendiente
        if ($proyecto->estado !== 'pendiente') {
            return redirect()
                ->back()
                ->with('error', 'Solo se pueden aprobar proyectos en estado pendiente.');
        }

        try {
            $proyecto->update([
                'estado' => 'aprobado',
                'fecha_aprobacion' => now()
            ]);

            // TODO: Enviar notificación al emprendedor (opcional)
            // Mail::to($proyecto->emprendedor->user->email)->send(new ProyectoAprobado($proyecto));

            return redirect()
                ->route('admin.proyectos.show', $proyecto->id)
                ->with('success', 'Proyecto aprobado exitosamente.');
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

        // Validar que el proyecto esté pendiente
        if ($proyecto->estado !== 'pendiente') {
            return redirect()
                ->back()
                ->with('error', 'Solo se pueden rechazar proyectos en estado pendiente.');
        }

        $validated = $request->validate([
            'motivo_rechazo' => 'required|string|max:1000',
        ], [
            'motivo_rechazo.required' => 'Debes proporcionar un motivo de rechazo.',
            'motivo_rechazo.max' => 'El motivo no puede exceder 1000 caracteres.',
        ]);

        try {
            $proyecto->update([
                'estado' => 'rechazado',
                'motivo_rechazo' => $validated['motivo_rechazo'],
                'fecha_rechazo' => now()
            ]);

            // TODO: Enviar notificación al emprendedor (opcional)
            // Mail::to($proyecto->emprendedor->user->email)->send(new ProyectoRechazado($proyecto));

            return redirect()
                ->route('admin.proyectos.index')
                ->with('success', 'Proyecto rechazado.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al rechazar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Revertir estado a pendiente
     */
    public function revertir(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Solo se puede revertir si está aprobado o rechazado
        if (!in_array($proyecto->estado, ['aprobado', 'rechazado'])) {
            return redirect()
                ->back()
                ->with('error', 'Solo se pueden revertir proyectos aprobados o rechazados.');
        }

        try {
            $proyecto->update([
                'estado' => 'pendiente',
                'motivo_rechazo' => null,
                'fecha_aprobacion' => null,
                'fecha_rechazo' => null
            ]);

            return redirect()
                ->route('admin.proyectos.show', $proyecto->id)
                ->with('success', 'El proyecto ha sido revertido a estado pendiente.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al revertir el estado: ' . $e->getMessage());
        }
    }
}