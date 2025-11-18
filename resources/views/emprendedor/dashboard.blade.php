@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard del Emprendedor</h1>
    <p>Bienvenido, {{ Auth::user()->name }}.</p>

    <div class="card mb-4">
        <div class="card-header">Mis Proyectos</div>
        <div class="card-body">
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Proyecto</a>
            <p>Aquí se listarán los proyectos del emprendedor con su estado (borrador, en revisión, aprobado, rechazado).</p>
            {{-- Logic to list projects --}}
        </div>
    </div>
</div>
@endsection
