@extends('layouts.app')

@section('content')
<style>
    :root{ --brand-primary:#f96854; --brand-secondary:#052d49; --muted:#6c757d }
    .projects-wrap{ padding:36px 12px }
    .projects-header{ display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:18px }
    .projects-title{ font-size:1.4rem; font-weight:800; color:var(--brand-secondary) }
    .projects-sub{ color:var(--muted); font-size:.95rem }
    .filters-row{ display:flex; gap:10px; align-items:center }
    .search-input{ padding:8px 12px; border-radius:999px; border:1px solid rgba(0,0,0,0.06); min-width:220px }
    .btn-filter{ background:transparent; border:1px solid rgba(5,45,73,0.06); padding:7px 10px; border-radius:10px }
    .grid{ display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:18px }
    .project-card{ border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(5,45,73,0.05); background:#fff; display:flex; flex-direction:column; height:100% }
    .project-hero{ height:160px; object-fit:cover; width:100% }
    .project-body{ padding:14px; display:flex; flex-direction:column; gap:8px; flex:1 }
    .project-title{ font-weight:800; color:var(--brand-secondary); font-size:1rem }
    .project-desc{ color:var(--muted); font-size:.9rem }
    .project-meta{ display:flex; justify-content:space-between; align-items:center; gap:10px }
    .meta-left{ color:var(--muted); font-size:.9rem }
    .meta-right{ display:flex; gap:8px }
    .btn-brand{ background:var(--brand-primary); color:#fff; border-radius:999px; padding:7px 12px; border:none; font-weight:700; text-decoration:none }
    .btn-outline-brand{ border:1px solid var(--brand-secondary); color:var(--brand-secondary); padding:6px 10px; border-radius:8px; background:transparent; text-decoration:none }
    .progress-track{ height:8px; background:#f1f5f7; border-radius:8px; overflow:hidden }
    .progress-bar{ height:100%; background:linear-gradient(90deg,var(--brand-primary), #ff8a70); }
    @media (max-width:600px){ .projects-title{ font-size:1.2rem } .project-hero{ height:120px } }
</style>

<div class="projects-wrap">
    <div class="projects-header">
        <div>
            <div class="projects-title">Explorar Proyectos</div>
            <div class="projects-sub">Proyectos aprobados y activos — encuentra uno para apoyar</div>
        </div>

        <div class="filters-row">
            <input class="search-input" placeholder="Buscar por título o descripción">
            <button class="btn-filter">Filtros</button>
        </div>
    </div>

    <div class="grid">
        @forelse($projects ?? [] as $project)
            @php
                $meta = $project->meta ?? 0;
                $raised = $project->recaudado ?? ($project->recaudo ?? 0) ;
                $pct = $meta > 0 ? min(100, round(($raised / $meta) * 100)) : 0;
            @endphp
            <div class="project-card">
                <img src="{{ $project->imagen_url ?? asset('images/project-placeholder.jpg') }}" alt="{{ $project->titulo ?? 'Proyecto' }}" class="project-hero">
                <div class="project-body">
                    <div>
                        <div class="project-title">{{ $project->titulo ?? 'Título del Proyecto' }}</div>
                        <div class="project-desc">{{ $project->descripcion ? Str::limit($project->descripcion, 120) : 'Breve descripción del proyecto.' }}</div>
                    </div>

                    <div class="project-meta mt-auto">
                        <div>
                            <div class="meta-left">Meta: <strong>S/{{ number_format($meta,2) }}</strong></div>
                            <div class="meta-left">Recaudado: <strong>S/{{ number_format($raised ?? 0,2) }}</strong></div>
                            <div class="meta-left" style="margin-top:8px">
                                <div class="progress-track"><div class="progress-bar" style="width:{{ $pct }}%"></div></div>
                                <div class="projects-sub" style="margin-top:6px">{{ $pct }}% alcanzado</div>
                            </div>
                        </div>

                        <div class="meta-right">
                            <a href="{{ route('proyectos.show', $project->id) }}" class="btn-outline-brand">Ver</a>
                            <a href="{{ route('donaciones.create', ['id' => $project->id]) }}" class="btn-brand">Donar</a>
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

@endsection
