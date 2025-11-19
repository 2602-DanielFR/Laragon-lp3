@extends('layouts.app')

@section('content')
<div class="container py-4">
    <style>
        /* Small palette styles local to this view */
        .btn-login { background: #f96854; border-color: #f96854; color: #fff; }
        .profile-card { border-radius: .6rem; border:1px solid rgba(0,0,0,0.04); }
        .profile-thumb { width:120px; height:120px; object-fit:cover; border-radius:8px; }
        .muted-small { color:#6c757d; font-size:.95rem; }
    </style>

    <h3 class="mb-3">Editar perfil</h3>

    @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-3">
            <div class="profile-card p-3 text-center">
                <img id="profilePreview" src="{{ old('foto_perfil', optional($profile)->foto_perfil) ? old('foto_perfil', optional($profile)->foto_perfil) : asset('images/profile-placeholder.png') }}" alt="Foto" class="profile-thumb mb-3">
                <h5 class="mb-1">{{ $user->name }}</h5>
                <div class="muted-small mb-2">{{ $user->role }}</div>
                <p class="small text-muted">{{ Str::limit(old('biografia_breve', optional($profile)->biografia_breve ?? ''), 120) }}</p>
                <a href="{{ url('/perfil/'.$user->id) }}" class="btn btn-outline-secondary btn-sm">Ver perfil</a>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="{{ route('perfil.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="card profile-card p-3 mb-3">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto de perfil (URL)</label>
                        <input id="foto_perfil" type="text" name="foto_perfil" class="form-control @error('foto_perfil') is-invalid @enderror" value="{{ old('foto_perfil', optional($profile)->foto_perfil) }}">
                        @error('foto_perfil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="form-text text-muted">Pega la URL directa de la imagen. Se mostrará una vista previa arriba.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Biografía breve</label>
                        <textarea name="biografia_breve" class="form-control @error('biografia_breve') is-invalid @enderror" rows="4">{{ old('biografia_breve', optional($profile)->biografia_breve) }}</textarea>
                        @error('biografia_breve') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Enlaces de redes (JSON array)</label>
                        <input type="text" name="enlaces_redes" class="form-control @error('enlaces_redes') is-invalid @enderror" value="{{ old('enlaces_redes', optional($profile)->enlaces_redes ? json_encode(optional($profile)->enlaces_redes) : '') }}">
                        <small class="form-text text-muted">Ej: ["https://twitter.com/tu","https://github.com/tu"]</small>
                        @error('enlaces_redes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Role-specific fields (logic preserved) --}}
                    @if($user->role === 'Donante')
                    <h5 class="mt-3">Datos Donante</h5>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', optional($profile)->direccion) }}">
                        @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', optional($profile)->telefono) }}">
                        @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @elseif($user->role === 'Emprendedor')
                    <h5 class="mt-3">Datos Emprendedor</h5>
                    <div class="mb-3">
                        <label class="form-label">Organización</label>
                        <input type="text" name="organizacion" class="form-control @error('organizacion') is-invalid @enderror" value="{{ old('organizacion', optional($profile)->organizacion) }}">
                        @error('organizacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción personal</label>
                        <textarea name="descripcion_personal" class="form-control @error('descripcion_personal') is-invalid @enderror" rows="4">{{ old('descripcion_personal', optional($profile)->descripcion_personal) }}</textarea>
                        @error('descripcion_personal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-login">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // Preview image URL when the foto_perfil field changes
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('foto_perfil');
        var preview = document.getElementById('profilePreview');
        if (!input || !preview) return;
        input.addEventListener('input', function () {
            var val = input.value.trim();
            if (val) {
                preview.src = val;
            } else {
                preview.src = '{{ asset('images/profile-placeholder.png') }}';
            }
        });
    });
</script>
@endpush

@endsection