@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard de Administrador</h1>
    <p>Bienvenido, {{ Auth::user()->name }}.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Proyectos Pendientes</h5>
                    <p class="card-text">X proyectos esperando revisión.</p>
                    <a href="{{ route('admin.proyectos.index') }}" class="btn btn-primary">Ver Cola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <p class="card-text">Y usuarios registrados.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Gestionar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Categorías</h5>
                    <p class="card-text">Z categorías existentes.</p>
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary">Gestionar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
