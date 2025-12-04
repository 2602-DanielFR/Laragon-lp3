@extends('layouts.app')

@section('content')
<style>
    :root{ --brand-primary:#f96854; --brand-secondary:#052d49; }
    body.auth-bg{ background: linear-gradient(135deg, #eaf6f7 0%, rgba(5,45,73,0.02) 50%, rgba(5,45,73,0.06) 100%); }
    .center-wrap{ min-height:100vh; display:flex; align-items:center; justify-content:center; }
    .login-card{ width:380px; border-radius:12px; box-shadow:0 18px 40px rgba(5,45,73,0.08); overflow:hidden; background:#fff }
    .login-top{ height:140px; background: linear-gradient(180deg, var(--brand-secondary), #044056); display:flex; align-items:center; justify-content:center; color:#fff; }
    .login-top h2{ margin:0; font-weight:700; letter-spacing:0.6px }
    .login-body{ padding:22px }
    .input-pill{ border-radius:999px; padding:12px 16px; box-shadow: inset 0 1px 0 rgba(0,0,0,0.02); }
    .input-icon { width:38px; text-align:center; color:var(--brand-secondary); }
    .btn-cta{ background:var(--brand-primary); color:#fff; border:none; border-radius:999px; padding:10px 18px; font-weight:700 }
    .btn-cta:hover{ background:#e65b48 }
    .muted-small{ color:#6c757d; font-size:.9rem }
    .help-row{ display:flex; justify-content:space-between; align-items:center; margin-top:8px }
    .login-footer{ padding:12px 22px; background:#fafafb; text-align:center; font-size:.85rem; color:#666 }
    @media (max-width:420px){ .login-card{ width:92%; } }
</style>

<div class="center-wrap auth-page">
    <div class="login-card">
        <div class="login-top">
            <div>
                <h2>{{ strtoupper(config('app.name','Plataforma')) }}</h2>
                <p class="muted-small" style="opacity:.9; margin-top:6px">Impulsa ideas. Invierte con confianza.</p>
            </div>
        </div>

        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3 input-group align-items-center input-pill">
                    <span class="input-group-text bg-transparent border-0 input-icon"><i class="bi bi-person"></i></span>
                    <input id="email" type="email" class="form-control border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email o usuario">
                </div>
                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

                <div class="mb-2 input-group align-items-center input-pill">
                    <span class="input-group-text bg-transparent border-0 input-icon"><i class="bi bi-lock"></i></span>
                    <input id="password" type="password" class="form-control border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                </div>
                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

                <div class="help-row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label ms-2 muted-small" for="remember">Recuérdame</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="muted-small">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-cta">Entrar</button>
                </div>

                <div class="text-center mt-3 muted-small">¿Aún no tienes cuenta? <a href="{{ route('register') }}" style="color:var(--brand-secondary); font-weight:600">Regístrate</a></div>
            </form>
        </div>

        <div class="login-footer">
            <div>Plataforma segura · Transparencia en metas · Comunidad comprometida</div>
        </div>
    </div>
</div>

@endsection
