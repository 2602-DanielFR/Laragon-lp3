@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0">Explorar Proyectos</h1>
            <p class="small text-muted mb-0">Proyectos aprobados y activos</p>
        </div>
        <div>
            {{-- Placeholder for filters (keep logic unchanged) --}}
            <button class="btn btn-sm btn-outline-secondary">Filtros</button>
        </div>
    </div>

    <div class="row gy-4">
        @forelse($projects ?? [] as $project)
            <div class="col-sm-6 col-md-4">
                <div class="card h-100 shadow-sm project-card">
                    <img src="{{ asset('images/project-placeholder.jpg') }}" class="card-img-top" alt="{{ $project->titulo ?? 'Proyecto' }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $project->titulo ?? 'Título del Proyecto' }}</h5>
                        <p class="card-text text-muted small mb-2">{{ $project->descripcion ? Str::limit($project->descripcion, 120) : 'Breve descripción del proyecto.' }}</p>
                        <div class="mt-auto">
                            <p class="mb-2 small">Meta: <strong>S/{{ number_format($project->meta ?? 0, 2) }}</strong></p>
                            <a href="#" class="btn btn-sm btn-primary-brand">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No hay proyectos disponibles todavía.</div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .btn-primary-brand{ background: #f96854; color: #fff; border: none; }
    .btn-primary-brand:hover{ background: #e65b48; color:#fff; }
    .project-card img{ height:160px; object-fit:cover; }
    .card { border-radius: .6rem; }
</style>
@endsection
