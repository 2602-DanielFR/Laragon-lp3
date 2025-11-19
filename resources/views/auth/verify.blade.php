@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .auth-left { background: #052d49; color: #ffffff; }
    .btn-login { background: #f96854; border-color: #f96854; color: #ffffff; }
    .btn-login:hover, .btn-login:focus { background: #e85b48; border-color: #e85b48; }
    input.form-control:focus, .btn-link:focus { box-shadow: 0 0 0 .2rem rgba(249,104,84,0.15); }
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
                            <p class="small mb-0">{{ __('Verifica tu correo electrónico') }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 p-4">
                        <div class="card-body">
                            <h4 class="card-title mb-3">{{ __('Verify Your Email Address') }}</h4>

                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            <p class="mb-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p class="mb-0">{{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
