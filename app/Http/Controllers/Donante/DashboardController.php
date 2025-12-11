<?php

namespace App\Http\Controllers\Donante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donacion;

class DashboardController extends Controller
{
    public function index()
    {
        $donations = Donacion::where('user_id', Auth::id())
            ->with('proyecto')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('donante.donaciones.index', compact('donations'));
    }
}