<?php

namespace App\Http\Controllers\Donante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('donante.donaciones.index');
    }
}