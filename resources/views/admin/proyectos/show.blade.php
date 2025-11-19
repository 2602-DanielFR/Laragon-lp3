@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Proyecto: Título del Proyecto</h1>
    <a href="{{ route('admin.proyectos.index') }}" class="btn btn-secondary">Volver</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card admin-card mb-3">
            <div class="card-body">
                <h5 class="card-title mb-3">Detalles</h5>
                <dl class="row mb-0">
                    <dt class="col-sm-3">Emprendedor</dt>
                    <dd class="col-sm-9">Juan Emprendedor</dd>
                    <dt class="col-sm-3">Descripción</dt>
                    <dd class="col-sm-9">...</dd>
                    <dt class="col-sm-3">Meta</dt>
                    <dd class="col-sm-9">€1000</dd>
                </dl>
            </div>
        </div>
        <div class="d-flex gap-2">
            <form action="#" method="POST">
                @csrf
                <button type="submit" class="btn btn-success px-4">Aprobar</button>
            </form>
            <form action="#" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger px-4">Rechazar</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card admin-card">
            <div class="card-body">
                <h6 class="card-title">Resumen</h6>
                <p class="small text-muted mb-2">Información rápida del proyecto.</p>
                <ul class="list-unstyled mb-0 small">
                    <li><strong>Estado:</strong> Pendiente</li>
                    <li><strong>Creado:</strong> 2025-11-18</li>
                    <li><strong>Categoría:</strong> Tecnología</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
