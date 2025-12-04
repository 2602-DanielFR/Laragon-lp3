@extends('layouts.app')

@section('content')
<style>
    :root{ --brand-primary:#f96854; --brand-secondary:#052d49; --muted:#6c757d }
    .donor-page{ padding:40px 12px; display:flex; justify-content:center }
    .donor-panel{ width:100%; max-width:980px }
    .header-row{ display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:18px }
    .panel-card{ background:#fff; border-radius:12px; box-shadow:0 10px 30px rgba(5,45,73,0.06); overflow:hidden }
    .panel-top{ padding:18px 20px; display:flex; align-items:center; gap:16px }
    .brand-badge{ width:62px; height:62px; border-radius:10px; background:linear-gradient(135deg,var(--brand-primary), #ff7a62); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px }
    .panel-title{ font-size:1.1rem; font-weight:800; color:var(--brand-secondary) }
    .panel-sub{ color:var(--muted); font-size:.92rem }
    .stats{ display:flex; gap:12px; align-items:center }
    .stat{ background:linear-gradient(180deg,#fff,#fff); padding:8px 12px; border-radius:999px; border:1px solid rgba(5,45,73,0.04); font-weight:700 }
    .controls{ display:flex; gap:10px; align-items:center }
    .search{ border-radius:999px; padding:6px 12px; border:1px solid rgba(0,0,0,0.06); min-width:200px }
    .cta-new{ background:var(--brand-primary); color:#fff; padding:8px 14px; border-radius:999px; font-weight:700; text-decoration:none }
    .donations-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:12px; padding:12px }
    .donation-card{ background:#fff; border-radius:10px; padding:12px; display:flex; gap:12px; align-items:center; border:1px solid rgba(5,45,73,0.03) }
    .thumb{ width:64px; height:64px; border-radius:8px; object-fit:cover; flex-shrink:0 }
    .d-info{ flex:1 }
    .d-title{ font-weight:800; color:var(--brand-secondary); margin-bottom:6px }
    .d-meta{ color:var(--muted); font-size:.86rem }
    .d-amount{ font-weight:900; color:var(--brand-primary); font-size:1rem }
    .empty-box{ text-align:center; padding:28px; color:var(--muted) }
    @media (max-width:600px){ .brand-badge{ width:48px; height:48px; font-size:16px } .thumb{ width:56px; height:56px } }
</style>

<div class="donor-page">
    <div class="donor-panel">
        <div class="header-row">
            <div>
                <div class="panel-title">Mi Historial de Donaciones</div>
                <div class="panel-sub">Revisa tus aportes y vuelve a apoyar proyectos que te importan</div>
            </div>

                <div class="controls">
                <div class="stats">
                    <div class="stat">Total: S/{{ number_format(collect($donations ?? [])->sum('amount'),2) }}</div>
                    <div class="stat">{{ count($donations ?? []) }} donación(es)</div>
                </div>
                <a href="{{ route('proyectos.index') }}" class="cta-new">Nueva Donación</a>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-top">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="brand-badge">S/</div>
                    <div>
                        <div class="panel-title">Resumen</div>
                        <div class="panel-sub">Tu historial y recibos recientes</div>
                    </div>
                </div>
                <div style="margin-left:auto; display:flex; gap:10px; align-items:center">
                    <input class="search" placeholder="Buscar por proyecto o fecha" style="outline:none">
                </div>
            </div>

            <div class="donations-grid">
                @forelse($donations ?? [] as $donation)
                    <div class="donation-card">
                        <img src="{{ $donation->project->thumbnail_url ?? asset('images/project-placeholder.jpg') }}" alt="thumb" class="thumb">
                        <div class="d-info">
                            <a href="{{ url('proyectos/'.$donation->project->id) }}" class="d-title">{{ $donation->project->title ?? 'Proyecto' }}</a>
                            <div class="d-meta">{{ $donation->created_at->format('d M, Y') }} · <span class="badge" style="background:var(--brand-secondary); color:#fff; border-radius:8px; padding:4px 8px; font-size:.76rem">{{ $donation->project->status ?? 'Activo' }}</span></div>
                        </div>
                        <div style="text-align:right">
                            <div class="d-amount">S/{{ number_format($donation->amount,2) }}</div>
                            <div class="d-meta">{{ $donation->type ?? 'Donación' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-box" style="grid-column:1/-1">
                        <h5>No has realizado donaciones todavía</h5>
                        <p class="panel-sub">Explora proyectos y realiza tu primera contribución para empezar a generar impacto.</p>
                        <div style="margin-top:12px"><a href="{{ url('/proyectos') }}" class="cta-new">Explorar Proyectos</a></div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('welcomeModal');
        if (modalEl && !sessionStorage.getItem('donor_welcome_shown')){
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
            sessionStorage.setItem('donor_welcome_shown','1');
        }
    });
</script>
@endpush

@endsection
