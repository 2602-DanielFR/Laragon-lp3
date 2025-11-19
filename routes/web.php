<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\ProyectoController as AdminProyectoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Emprendedor\DashboardController as EmprendedorDashboardController;
use App\Http\Controllers\Donante\DashboardController as DonanteDashboardController;


Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile resource routes (only show, edit, update). Protected by auth.
Route::middleware('auth')->group(function () {
    Route::resource('perfil', PerfilController::class)->only(['show', 'edit', 'update']);
});

// Emprendedor Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/emprendedor/dashboard', [EmprendedorDashboardController::class, 'index'])->name('emprendedor.dashboard');
});

// Proyectos (Emprendedor)
Route::middleware(['auth'])->group(function () {
    Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
    Route::get('/proyectos/{id}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
});

// Admin Dashboard & Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () { // Assuming an 'admin' middleware will be created
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categorias', AdminCategoriaController::class)->except(['show']);

    // Project Review
    Route::get('/proyectos', [AdminProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/{id}', [AdminProyectoController::class, 'show'])->name('proyectos.show');

    // User Management
    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show']);
});

// Public Project Exploration
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');


// Donante Routes
Route::middleware(['auth'])->group(function () {
    // Donation Process
    Route::get('/proyectos/{id}/donar', [DonacionController::class, 'create'])->name('donaciones.create');

    // Donation History
    Route::get('/donante/donaciones', [DonanteDashboardController::class, 'index'])->name('donante.donaciones.index');
});
