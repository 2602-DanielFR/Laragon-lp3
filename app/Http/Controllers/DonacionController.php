<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Donacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DonacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($proyectoId)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);

        if (!$proyecto->puedeRecibirDonaciones()) {
            return redirect()->back()->with('error', 'Este proyecto no está activo para recibir donaciones.');
        }

        return view('donaciones.create', compact('proyecto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'monto' => 'required|numeric|min:1',
            'metodo_pago' => 'nullable|string', 
        ]);

        $proyecto = Proyecto::findOrFail($request->proyecto_id);

        if (!$proyecto->puedeRecibirDonaciones()) {
            return back()->with('error', 'Este proyecto no puede recibir donaciones en este momento.');
        }

        try {
            $donacion = DB::transaction(function () use ($request, $proyecto) {
                // Crear la donación
                $donacion = Donacion::create([
                    'user_id' => Auth::id(),
                    'proyecto_id' => $proyecto->id,
                    'monto' => $request->monto,
                    'estado' => 'completada', // Simulado directo a completado
                    'metodo_pago' => $request->metodo_pago ?? 'tarjeta_simulada',
                    'referencia' => 'SIM-' . time() . '-' . mt_rand(1000,9999),
                ]);

                // Actualizar contadores del proyecto
                $proyecto->increment('monto_actual', $request->monto);
                $proyecto->increment('contador_donaciones');
                
                // Verificar si es un donante nuevo para este proyecto
                $existeDonacionPrevia = Donacion::where('proyecto_id', $proyecto->id)
                    ->where('user_id', Auth::id())
                    ->where('id', '!=', $donacion->id)
                    ->exists();

                if (!$existeDonacionPrevia) {
                    $proyecto->increment('contador_donantes');
                }

                // Recalcular porcentaje
                if ($proyecto->objetivo_recaudacion > 0) {
                    $porcentaje = ($proyecto->monto_actual / $proyecto->objetivo_recaudacion) * 100;
                    $proyecto->update(['porcentaje_alcanzado' => $porcentaje]);
                }

                return $donacion;
            });

            return redirect()->route('donaciones.success', $donacion->id);

        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al procesar tu donación: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $donacion = Donacion::with('proyecto')->findOrFail($id);

        if ($donacion->user_id !== Auth::id()) {
            abort(403);
        }

        return view('donaciones.success', compact('donacion'));
    }
}