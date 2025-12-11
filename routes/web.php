<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\ProyectoController as AdminProyectoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Emprendedor\DashboardController as EmprendedorDashboardController;
use App\Http\Controllers\Donante\DashboardController as DonanteDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ===== HOME =====
Route::get('/', function () {
    return view('home');
})->name('home');

// ===== AUTENTICACIÓN =====
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home.dashboard');

// ===== RUTAS PROTEGIDAS (AUTENTICADAS) =====
Route::middleware('auth')->group(function () {
    // Perfil - SIN {id}
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/actualizar', [PerfilController::class, 'update'])->name('perfil.update');
});

// ===== RUTAS PÚBLICAS =====
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');

// ===== RUTAS EMPRENDEDOR =====
Route::middleware(['auth', 'verified', 'emprendedor'])->group(function () {
    Route::get('/emprendedor/dashboard', [EmprendedorDashboardController::class, 'index'])->name('emprendedor.dashboard');
    Route::get('/emprendedor/proyectos/activos', [EmprendedorDashboardController::class, 'proyectosActivos'])->name('emprendedor.proyectos.activos');
    Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
    // Route to store a new proyecto (form submits here)
    Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
    Route::get('/proyectos/{id}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
});

// ===== RUTA PÚBLICA - MOSTRAR PROYECTO =====
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');

// ===== RUTAS ADMIN =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Categorías
    Route::resource('categorias', AdminCategoriaController::class)->except(['show']);

    // Proyectos
    Route::get('/proyectos', [AdminProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/{id}', [AdminProyectoController::class, 'show'])->name('proyectos.show');
    Route::post('/proyectos/{id}/aprobar', [AdminProyectoController::class, 'aprobar'])->name('proyectos.aprobar');
    Route::post('/proyectos/{id}/rechazar', [AdminProyectoController::class, 'rechazar'])->name('proyectos.rechazar');
    Route::post('/proyectos/{id}/revertir', [AdminProyectoController::class, 'revertir'])->name('proyectos.revertir');

    // Usuarios
    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show']);
});

// ===== RUTAS DONANTE =====
Route::middleware(['auth', 'verified', 'donante'])->group(function () {
    Route::get('/donante/dashboard', [DonanteDashboardController::class, 'index'])->name('donante.dashboard');
    Route::get('/donante/donaciones', [DonanteDashboardController::class, 'index'])->name('donante.donaciones.index');
    Route::get('/proyectos/{id}/donar', [DonacionController::class, 'create'])->name('donaciones.create');
    Route::post('/donaciones', [DonacionController::class, 'store'])->name('donaciones.store');
    Route::get('/donaciones/{id}/exito', [DonacionController::class, 'success'])->name('donaciones.success');
});
