@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Dashboard</h1>
    <span class="badge bg-primary">Bienvenido {{ Auth::user()->name }}</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="kpi">
            <div class="value">X</div>
            <div class="label">Proyectos pendientes</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi secondary">
            <div class="value">Y</div>
            <div class="label">Usuarios registrados</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi">
            <div class="value">Z</div>
            <div class="label">Categorías activas</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card admin-card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Proyectos</h5>
                <p class="flex-grow-1">Revisa y aprueba iniciativas enviadas por emprendedores.</p>
                <a href="{{ route('admin.proyectos.index') }}" class="btn btn-primary w-100">Ver cola</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card admin-card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Usuarios</h5>
                <p class="flex-grow-1">Gestiona roles, bloqueo y edición de perfiles.</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100">Gestionar</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card admin-card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Categorías</h5>
                <p class="flex-grow-1">Organiza etiquetas para clasificar proyectos.</p>
                <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary w-100">Administrar</a>
            </div>
        </div>
    </div>
</div>
@endsection
