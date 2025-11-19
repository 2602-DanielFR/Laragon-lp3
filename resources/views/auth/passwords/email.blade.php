@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .auth-left { background: #052d49; color: #ffffff; }
    .btn-login { background: #f96854; border-color: #f96854; color: #ffffff; }
    .btn-login:hover, .btn-login:focus { background: #e85b48; border-color: #e85b48; }
    input.form-control:focus { box-shadow: 0 0 0 .2rem rgba(249,104,84,0.15); border-color: #f96854; }
    a.small, .btn-link { color: #052d49; }
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
                            <p class="small mb-0">{{ __('Recupera tu contraseña') }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 p-4">
                        <div class="card-body">
                            <h4 class="card-title mb-3">{{ __('Reset Password') }}</h4>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('name@example.com') }}">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-login btn-lg">{{ __('Send Password Reset Link') }}</button>
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
