@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .auth-left { background: #052d49; color: #ffffff; }
    .btn-login { background: #f96854; border-color: #f96854; color: #ffffff; }
    .btn-login:hover { background: #e85b48; }
    .card { border-radius: .75rem; }
    .table thead th { border-bottom: 2px solid rgba(0,0,0,0.05); }
    .donation-row:hover { background: #fbf1ef; }
    .project-thumb { width:48px; height:48px; object-fit:cover; border-radius:6px; }
    .badge-status { background: #052d49; color: #fff; font-weight:600; }
    .empty-state { text-align:center; padding:3rem 1rem; color:#6c757d; }
    .donation-card { border: 1px solid rgba(0,0,0,0.04); border-radius: .6rem; padding:1rem; }
    .donation-amount { font-size:1.15rem; font-weight:700; color:#052d49; }
    .donation-meta { font-size:0.9rem; color:#6c757d; }
    .list-empty-cta { margin-top:1rem; }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Mi Historial de Donaciones</h4>
                        <small class="text-muted">Resumen de tus aportes al proyecto</small>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    {{-- Lista visual de donaciones --}}
                    <div class="d-grid gap-3">
                        @forelse($donations ?? [] as $donation)
                            <div class="donation-card d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $donation->project->thumbnail_url ?? asset('images/project-placeholder.jpg') }}" alt="thumb" class="project-thumb d-none d-sm-block">
                                    <div>
                                        <a href="{{ url('proyectos/'.$donation->project->id) }}" class="fw-semibold">{{ $donation->project->title }}</a>
                                        <div class="donation-meta">{{ $donation->created_at->format('Y-m-d') }} · <span class="badge badge-status">{{ $donation->project->status ?? 'Activo' }}</span></div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <div class="donation-amount">S/{{ number_format($donation->amount, 2) }}</div>
                                    <div class="donation-meta">{{ $donation->type ?? 'Donación' }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <h5>No has realizado donaciones todavía</h5>
                                <p class="text-muted">Tus futuras contribuciones aparecerán aquí.</p>
                                <a href="{{ url('/donaciones/create') }}" class="btn btn-login list-empty-cta">Realizar primera donación</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal overlay que aparece al entrar -->
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header auth-left">
        <h5 class="modal-title text-white" id="welcomeModalLabel">Bienvenido</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="mb-2">Gracias por visitar tu historial de donaciones. Aquí puedes revisar tus aportes y crear nuevas donaciones.</p>
        <p class="small text-muted mb-0">Si deseas apoyar un proyecto ahora, haz clic en "Nueva Donación".</p>
      </div>
      <div class="modal-footer">
        <a href="{{ url('/donaciones/create') }}" class="btn btn-login">Nueva Donación</a>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('welcomeModal');
        if (modalEl) {
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    });
</script>
@endpush
@endsection
