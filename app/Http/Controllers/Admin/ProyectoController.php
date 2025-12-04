<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
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

        // Filtrar por estado
        $estado = $request->get('estado', 'pendiente_revision');
        if ($estado !== 'todos') {
            $query->where('estado', $estado);
        }

        // Búsqueda
        if ($request->has('buscar') && $request->buscar) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('titulo', 'LIKE', "%{$buscar}%")
                  ->orWhere('descripcion', 'LIKE', "%{$buscar}%")
                  ->orWhereHas('user', function ($q) use ($buscar) {
                      $q->where('name', 'LIKE', "%{$buscar}%");
                  });
            });
        }

        // Ordenamiento
        $query->orderBy('created_at', 'desc');

        $proyectos = $query->paginate(15);
        $totalPendientes = Proyecto::where('estado', 'pendiente_revision')->count();
        $totalActivos = Proyecto::where('estado', 'activo')->count();
        $totalRechazados = Proyecto::where('estado', 'rechazado')->count();

        return view('admin.proyectos.index', compact(
            'proyectos',
            'estado',
            'totalPendientes',
            'totalActivos',
            'totalRechazados'
        ));
    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with(['user.emprendedor', 'categoria', 'actualizaciones'])
                           ->findOrFail($id);

        $estadoActual = $proyecto->estado;

        return view('admin.proyectos.show', compact('proyecto', 'estadoActual'));
    }

    /**
     * Aprobar proyecto
     */
    public function aprobar(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        if ($proyecto->estado !== 'pendiente_revision') {
            return back()->with('error', 'Solo se pueden aprobar proyectos pendientes de revisión');
        }

        try {
            $proyecto->update([
                'estado' => 'activo',
                'fecha_inicio' => now(),
            ]);

            return back()->with('success', 'Proyecto aprobado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al aprobar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Rechazar proyecto
     */
    public function rechazar(Request $request, string $id)
    {
        $validated = $request->validate([
            'razon_rechazo' => 'required|string|min:10|max:1000',
        ]);

        $proyecto = Proyecto::findOrFail($id);

        if ($proyecto->estado !== 'pendiente_revision') {
            return back()->with('error', 'Solo se pueden rechazar proyectos pendientes de revisión');
        }

        try {
            $proyecto->update([
                'estado' => 'rechazado',
                'razon_rechazo' => $validated['razon_rechazo'],
            ]);

            return back()->with('success', 'Proyecto rechazado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al rechazar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Activar proyecto (cambiar estado a activo si está pausado)
     */
    public function activar(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        if (!in_array($proyecto->estado, ['completado', 'cancelado'])) {
            return back()->with('error', 'Solo se pueden activar proyectos completados o cancelados');
        }

        try {
            $proyecto->update([
                'estado' => 'activo',
                'fecha_fin' => now()->addDays(30),
            ]);

            return back()->with('success', 'Proyecto activado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al activar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Cancelar proyecto
     */
    public function cancelar(Request $request, string $id)
    {
        $validated = $request->validate([
            'razon_rechazo' => 'required|string|min:10',
        ]);

        $proyecto = Proyecto::findOrFail($id);

        if ($proyecto->estado !== 'activo') {
            return back()->with('error', 'Solo se pueden cancelar proyectos activos');
        }

        try {
            $proyecto->update([
                'estado' => 'cancelado',
                'razon_rechazo' => $validated['razon_rechazo'],
            ]);

            return back()->with('success', 'Proyecto cancelado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cancelar el proyecto: ' . $e->getMessage());
        }
    }
}