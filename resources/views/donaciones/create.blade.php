@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .auth-left { background: #052d49; color: #ffffff; }
    .btn-login { background: #f96854; border-color: #f96854; color: #ffffff; }
    .btn-login:hover, .btn-login:focus { background: #e85b48; border-color: #e85b48; }
    input.form-control:focus { box-shadow: 0 0 0 .2rem rgba(249,104,84,0.15); border-color: #f96854; }
    .card { border-radius: .75rem; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-4 d-none d-md-flex align-items-center justify-content-center auth-left p-4">
                        <div class="text-center">
                            <h4 class="mb-1">Donar</h4>
                            <p class="small mb-0">Apoya el proyecto con tu aporte</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 p-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Donar al Proyecto: Título del Proyecto</h5>

                            <form action="#" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="monto" class="form-label">Monto a Donar (S/)</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">S/</span>
                                        <input type="number" min="1" step="0.01" class="form-control form-control-lg @error('monto') is-invalid @enderror" id="monto" name="monto" value="{{ old('monto') }}" placeholder="50.00">
                                    </div>
                                    @error('monto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="anonimo" name="anonimo" {{ old('anonimo') ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="anonimo">Hacer donación anónima</label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Método de pago</label>
                                    <div class="border rounded p-3">
                                        <p class="mb-1 small text-muted">Aquí irá la integración con la pasarela de pago (Stripe, PayPal, etc.).</p>
                                        <small class="text-muted">(Campo de prueba en esta vista)</small>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-login btn-lg">Confirmar Donación</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
