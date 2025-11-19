@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .auth-left { background: #052d49; color: #ffffff; }
    .btn-login { background: #f96854; border-color: #f96854; color: #ffffff; }
    .card { border-radius: .75rem; }
    .table thead th { border-bottom: 2px solid rgba(0,0,0,0.05); }
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
                    <div>
                        <a href="{{ url('/donaciones/create') }}" class="btn btn-login">Nueva Donación</a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Proyecto</th>
                                    <th class="text-end">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop through donations --}}
                                <tr>
                                    <td>2025-11-18</td>
                                    <td><a href="#">Mi Gran Proyecto</a></td>
                                    <td class="text-end">S/50.00</td>
                                </tr>
                            </tbody>
                        </table>
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
