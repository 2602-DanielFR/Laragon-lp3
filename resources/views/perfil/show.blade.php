@extends('layouts.app')

@section('content')
<style>
    /* Paleta: principal #f96854, secundario #052d49 */
    .profile-hero { background: linear-gradient(90deg, rgba(5,45,73,0.95), rgba(249,104,84,0.95)); color: #fff; padding: 1.25rem; border-radius: .6rem; }
    .profile-card { border: 1px solid rgba(0,0,0,0.04); border-radius: .6rem; padding: 1rem; }
    .profile-thumb-lg { width:160px; height:160px; object-fit:cover; border-radius:.5rem; }
    .role-badge { background:#052d49; color:#fff; padding:.25rem .5rem; border-radius:.4rem; font-weight:600; }
    .btn-login { background: #f96854; border-color: #f96854; color: #fff; }
    .muted { color:#6c757d; }
    .social-list a { color:#052d49; text-decoration:none; }
    .social-list a:hover { color:#f96854; }
</style>

<div class="container py-4">
    <div class="profile-hero mb-4 d-flex align-items-center gap-3">
        <img src="{{ optional($profile)->foto_perfil ?? asset('images/profile-placeholder.png') }}" alt="{{ $user->name }}" class="profile-thumb-lg">
        <div>
            <h2 class="mb-1">{{ $user->name }}</h2>
            <div class="mb-2"><span class="role-badge">{{ $user->role ?? '—' }}</span></div>
            <div class="muted">{{ optional($profile)->biografia_breve ? Str::limit(optional($profile)->biografia_breve, 200) : 'Aún no hay biografía.' }}</div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="profile-card mb-3">
                <h5 class="mb-3">Información</h5>

                <div class="mb-3">
                    <strong class="d-block mb-1">Enlaces</strong>
                    @if(optional($profile)->enlaces_redes)
                    <div class="social-list">
                        @foreach(optional($profile)->enlaces_redes as $link)
                            <div><a href="{{ $link }}" target="_blank" rel="noopener noreferrer">{{ $link }}</a></div>
                        @endforeach
                    </div>
                    @else
                    <div class="muted">—</div>
                    @endif
                </div>

                @if($user->role === 'Donante')
                    <h6 class="mb-2">Datos Donante</h6>
                    <div class="mb-2"><strong>Dirección:</strong> <span class="muted">{{ optional($profile)->direccion ?? '—' }}</span></div>
                    <div class="mb-2"><strong>Teléfono:</strong> <span class="muted">{{ optional($profile)->telefono ?? '—' }}</span></div>
                @elseif($user->role === 'Emprendedor')
                    <h6 class="mb-2">Datos Emprendedor</h6>
                    <div class="mb-2"><strong>Organización:</strong> <span class="muted">{{ optional($profile)->organizacion ?? '—' }}</span></div>
                    <div class="mb-2"><strong>Descripción personal:</strong> <div class="muted">{{ optional($profile)->descripcion_personal ?? '—' }}</div></div>
                @endif
            </div>

            @can('update', $user)
            <div class="d-flex gap-2">
                <a href="{{ route('perfil.edit', $user->id) }}" class="btn btn-login">Editar mi perfil</a>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Volver al inicio</a>
            </div>
            @endcan
        </div>

        <div class="col-lg-4">
            <div class="profile-card mb-3">
                <h6 class="mb-2">Resumen</h6>
                <div class="mb-2"><strong>Miembro desde:</strong> <div class="muted">{{ $user->created_at->format('Y-m-d') ?? '—' }}</div></div>
                <div class="mb-2"><strong>Email:</strong> <div class="muted">{{ $user->email }}</div></div>
            </div>
        </div>
    </div>
</div>
@endsection