@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .brand-primary { background: #f96854 !important; color: #fff !important; border-color: #f96854 !important; }
    .brand-secondary { background: #052d49 !important; color: #fff !important; }
    .card-rounded { border-radius: .75rem; }
    .stat-value { font-size: 1.5rem; font-weight:700; color:#052d49; }
    .stat-label { color:#6c757d; }
    .project-thumb { width:72px; height:56px; object-fit:cover; border-radius:6px; }
    .project-card { border:1px solid rgba(0,0,0,0.04); border-radius:.6rem; padding:1rem; }
    .empty-state { text-align:center; padding:2.5rem 1rem; color:#6c757d; }
</style>

<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Dashboard del Emprendedor</h3>
            <small class="text-muted">Bienvenido, {{ Auth::user()->name }}.</small>
        </div>
        <div>
            <a href="{{ route('proyectos.create') }}" class="btn brand-primary btn-lg">Crear Nuevo Proyecto</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-rounded shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value">{{ $projects_count ?? (isset($projects) ? $projects->count() : 0) }}</div>
                        <div class="stat-label">Proyectos</div>
                    </div>
                    <div class="text-end">
                        <i class="bi bi-collection" style="font-size:1.6rem;color:#f96854"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-rounded shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value">S/{{ number_format($funds_received ?? 0, 2) }}</div>
                        <div class="stat-label">Fondos recibidos</div>
                    </div>
                    <div class="text-end">
                        <i class="bi bi-currency-dollar" style="font-size:1.6rem;color:#052d49"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-rounded shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value">{{ $active_projects ?? 0 }}</div>
                        <div class="stat-label">Proyectos activos</div>
                    </div>
                    <div class="text-end">
                        <i class="bi bi-graph-up" style="font-size:1.6rem;color:#f96854"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-rounded shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Proyectos recientes</h5>
                        <a href="{{ route('proyectos.index') }}" class="small text-muted">Ver todos</a>
                    </div>

                    <div class="d-grid gap-3">
                        @forelse($projects ?? [] as $project)
                            <div class="project-card d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="{{ $project->thumbnail_url ?? asset('images/project-placeholder.jpg') }}" alt="thumb" class="project-thumb d-none d-sm-block">
                                    <div>
                                        <a href="{{ route('proyectos.show', $project->id) }}" class="fw-semibold">{{ $project->title }}</a>
                                        <div class="small text-muted">{{ Str::limit($project->summary ?? '', 80) }}</div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="small text-muted mb-1">{{ $project->status ?? 'Borrador' }}</div>
                                    <a href="{{ route('proyectos.edit', $project->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <h5 class="mb-2">Aún no tienes proyectos</h5>
                                <p class="text-muted">Comienza creando tu primer proyecto para recibir apoyo.</p>
                                <a href="{{ route('proyectos.create') }}" class="btn brand-primary">Crear proyecto</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-rounded shadow-sm mb-4 p-3">
                <h6 class="mb-3">Sugerencias rápidas</h6>
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="mb-2">• Completa el perfil de tu proyecto para aumentar la aprobación.</li>
                    <li class="mb-2">• Añade imágenes atractivas y una meta clara.</li>
                    <li class="mb-2">• Comparte tu proyecto en redes sociales para ganar visibilidad.</li>
                </ul>
            </div>

            <div class="card card-rounded shadow-sm p-3">
                <h6 class="mb-2">Acciones rápidas</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('proyectos.create') }}" class="btn brand-primary">Crear nuevo proyecto</a>
                    <a href="{{ route('proyectos.index') }}" class="btn btn-outline-secondary">Administrar proyectos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
