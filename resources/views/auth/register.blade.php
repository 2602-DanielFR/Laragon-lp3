@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .auth-left { background: #052d49; color: #ffffff; }
    .btn-login { background: #f96854; border-color: #f96854; color: #ffffff; }
    .btn-login:hover, .btn-login:focus { background: #e85b48; border-color: #e85b48; }
    input.form-control:focus { box-shadow: 0 0 0 .2rem rgba(249,104,84,0.15); border-color: #f96854; }
    a.small { color: #052d49; }
    .card { border-radius: .75rem; }
    @media (max-width: 767px) {
        .auth-left { padding: 1.5rem !important; }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center auth-left p-4">
                        <div class="text-center">
                            <h3 class="mb-1">{{ config('app.name', 'Aplicación') }}</h3>
                            <p class="small mb-0">{{ __('Crea una cuenta para empezar') }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 p-4">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('Register') }}</h4>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Nombre completo') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('name@example.com') }}">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">{{ __('ConfirmPassword') }}</label>
                                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">{{ __('Rol') }}</label>

                                    <div class="form-check">
                                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="roleDonante" value="Donante" {{ old('role')=='Donante' ? 'checked' : '' }} required>
                                        <label class="form-check-label ms-2" for="roleDonante">Donante</label>
                                    </div>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="roleEmprendedor" value="Emprendedor" {{ old('role')=='Emprendedor' ? 'checked' : '' }} required>
                                        <label class="form-check-label ms-2" for="roleEmprendedor">Emprendedor</label>
                                    </div>

                                    @error('role')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <small class="text-muted d-block mt-2">Pueden tener ambos roles después; seleccione aquí su rol principal.</small>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-login btn-lg">{{ __('Register') }}</button>
                                </div>

                                <div class="text-center mt-3">
                                    <small class="text-muted">{{ __('Al registrarte aceptas los términos y condiciones.') }}</small>
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