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
        return view('emprendedor.dashboard');
    }

    /**
     * Mostrar lista de proyectos activos del emprendedor
     */
    public function proyectosActivos()
    {
        $proyectos = Proyecto::where('user_id', Auth::id())
            ->where('estado', 'activo')
            ->with('categoria')
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view('emprendedor.proyectos-activos', compact('proyectos'));
    }
}