@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar perfil</h3>

    @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('perfil.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Shared profile fields --}}
        <div class="mb-3">
            <label class="form-label">Foto de perfil (URL)</label>
            <input type="text" name="foto_perfil" class="form-control @error('foto_perfil') is-invalid @enderror"
                value="{{ old('foto_perfil', optional($profile)->foto_perfil) }}">
            @error('foto_perfil') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Biografía breve</label>
            <textarea name="biografia_breve" class="form-control @error('biografia_breve') is-invalid @enderror"
                rows="4">{{ old('biografia_breve', optional($profile)->biografia_breve) }}</textarea>
            @error('biografia_breve') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Enlaces de redes (JSON array)</label>
            <input type="text" name="enlaces_redes" class="form-control @error('enlaces_redes') is-invalid @enderror"
                value="{{ old('enlaces_redes', optional($profile)->enlaces_redes ? json_encode(optional($profile)->enlaces_redes) : '') }}">
            <small class="form-text text-muted">Ej: ["https://twitter.com/tu","https://github.com/tu"]</small>
            @error('enlaces_redes') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Role-specific fields --}}
        @if($user->role === 'Donante')
        <h5>Datos Donante</h5>
        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                value="{{ old('direccion', optional($profile)->direccion) }}">
            @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono', optional($profile)->telefono) }}">
            @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        @elseif($user->role === 'Emprendedor')
        <h5>Datos Emprendedor</h5>
        <div class="mb-3">
            <label class="form-label">Organización</label>
            <input type="text" name="organizacion" class="form-control @error('organizacion') is-invalid @enderror"
                value="{{ old('organizacion', optional($profile)->organizacion) }}">
            @error('organizacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción personal</label>
            <textarea name="descripcion_personal"
                class="form-control @error('descripcion_personal') is-invalid @enderror"
                rows="4">{{ old('descripcion_personal', optional($profile)->descripcion_personal) }}</textarea>
            @error('descripcion_personal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection