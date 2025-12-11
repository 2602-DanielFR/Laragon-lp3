<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $proyectosActivos = Proyecto::where('user_id', $userId)
            ->where('estado', Proyecto::STATUS_ACTIVE)
            ->orderBy('created_at', 'desc')
            ->get();

        $proyectosPendientes = Proyecto::where('user_id', $userId)
            ->where('estado', Proyecto::STATUS_PENDING)
            ->orderBy('created_at', 'desc')
            ->get();

        $proyectosBorradores = Proyecto::where('user_id', $userId)
            ->where('estado', Proyecto::STATUS_DRAFT)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $proyectosRechazados = Proyecto::where('user_id', $userId)
            ->where('estado', Proyecto::STATUS_REJECTED)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('emprendedor.dashboard', compact(
            'proyectosActivos', 
            'proyectosPendientes', 
            'proyectosBorradores',
            'proyectosRechazados'
        ));
    }

    /**
     * Mostrar lista de proyectos activos del emprendedor (Legacy/Specific view)
     */
    public function proyectosActivos()
    {
        $proyectos = Proyecto::where('user_id', Auth::id())
            ->where('estado', Proyecto::STATUS_ACTIVE)
            ->with('categoria')
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view('emprendedor.proyectos-activos', compact('proyectos'));
    }
}