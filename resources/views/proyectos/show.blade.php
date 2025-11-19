@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $project = $project ?? null;
        $meta = optional($project)->meta ?? 0;
        $recaudado = optional($project)->recaudado ?? 0;
        $percent = $meta > 0 ? round(min(100, ($recaudado / $meta) * 100)) : 0;
        $donantes = optional($project)->donantes_count ?? (optional(optional($project)->donantes)->count() ?? 0);
    @endphp

    <div class="row g-4">
        <div class="col-lg-8">
            <h1 class="h3">{{ optional($project)->titulo ?? 'Título del Proyecto' }}</h1>
            <p class="text-muted small mb-3">{{ optional($project)->categoria ?? '' }}</p>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Descripción</h5>
                    <p class="card-text">{{ optional($project)->descripcion ?? 'Descripción completa del proyecto...' }}</p>
                </div>
            </div>

            {{-- Tabs for Updates, Donors, etc. --}}
            <div class="card">
                <div class="card-body">
                    {{-- Placeholder tabs keep logic unchanged --}}
                    <p class="small text-muted">Sección de actualizaciones, comentarios y donantes.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="mb-0">S/{{ number_format($recaudado, 2) }}</h3>
                    <p class="small text-muted">recaudados de una meta de S/{{ number_format($meta, 2) }}</p>

                    <div class="progress mb-3" style="height:12px; background: #eee; border-radius: 8px; overflow: hidden;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%; background: #052d49;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">{{ $percent }}%</div>
                    </div>

                    <p class="mb-3"><strong>{{ $donantes }}</strong> donantes</p>

                    <a href="#" class="btn btn-primary-brand w-100 mb-2">Donar a este proyecto</a>

                    @if(optional($project)->fecha_limite)
                        <p class="small text-muted mb-0">Fecha límite: {{ \Carbon\Carbon::parse(optional($project)->fecha_limite)->format('d M, Y') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary-brand{ background: #f96854; color: #fff; border: none; }
    .btn-primary-brand:hover{ background: #e65b48; color:#fff; }
    .card { border-radius: .6rem; }
    .progress-bar{ transition: width .6s ease; }
</style>
@endsection
