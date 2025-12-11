<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProyectos = Proyecto::count();
        $proyectosPendientes = Proyecto::where('estado', Proyecto::STATUS_PENDING)->count();
        $proyectosActivos = Proyecto::where('estado', Proyecto::STATUS_ACTIVE)->count();
        $proyectosRechazados = Proyecto::where('estado', Proyecto::STATUS_REJECTED)->count();
        $proyectosCompletados = Proyecto::where('estado', Proyecto::STATUS_COMPLETED)->count();
        
        $totalUsers = User::count();
        $totalCategorias = Categoria::count();

        // Otros KPIs que se puedan necesitar
        // $totalDonaciones = Donacion::count();
        // $montoTotalRecaudado = Donacion::sum('monto');

        return view('admin.dashboard', compact(
            'totalProyectos',
            'proyectosPendientes',
            'proyectosActivos',
            'proyectosRechazados',
            'proyectosCompletados',
            'totalUsers',
            'totalCategorias'
        ));
    }
}