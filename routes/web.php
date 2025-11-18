<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile resource routes (only show, edit, update). Protected by auth.
Route::middleware('auth')->group(function () {
    Route::resource('perfil', PerfilController::class);
});
