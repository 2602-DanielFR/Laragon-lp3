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
                            <p class="small mb-0">{{ __('Confirm your password') }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 p-4">
                        <div class="card-body">
                            <h4 class="card-title mb-3">{{ __('Confirm Password') }}</h4>

                            <p class="mb-3">{{ __('Please confirm your password before continuing.') }}</p>

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-login btn-lg">{{ __('Confirm Password') }}</button>
                                </div>

                                <div class="mt-3 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif
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
