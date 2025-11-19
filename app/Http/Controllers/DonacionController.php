<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonacionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($proyectoId)
    {
        return view('donaciones.create');
    }
}