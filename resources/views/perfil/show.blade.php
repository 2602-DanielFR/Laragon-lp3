@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Perfil de {{ $user->name }}</h3>

    <div class="mb-3">
        <strong>Rol:</strong> {{ $user->role ?? '—' }}
    </div>

    <div class="mb-3">
        <strong>Foto:</strong>
        @if(optional($profile)->foto_perfil)
        <div><img src="{{ optional($profile)->foto_perfil }}" alt="Foto de perfil" style="max-width:200px"></div>
        @else
        <div>No hay foto</div>
        @endif
    </div>

    <div class="mb-3">
        <strong>Biografía breve:</strong>
        <div>{{ optional($profile)->biografia_breve ?? '—' }}</div>
    </div>

    <div class="mb-3">
        <strong>Enlaces:</strong>
        @if(optional($profile)->enlaces_redes)
        <ul>
            @foreach(optional($profile)->enlaces_redes as $link)
            <li><a href="{{ $link }}" target="_blank" rel="noopener noreferrer">{{ $link }}</a></li>
            @endforeach
        </ul>
        @else
        <div>—</div>
        @endif
    </div>

    @if($user->role === 'Donante')
    <h5>Datos Donante</h5>
    <div><strong>Dirección:</strong> {{ optional($profile)->direccion ?? '—' }}</div>
    <div><strong>Teléfono:</strong> {{ optional($profile)->telefono ?? '—' }}</div>
    @elseif($user->role === 'Emprendedor')
    <h5>Datos Emprendedor</h5>
    <div><strong>Organización:</strong> {{ optional($profile)->organizacion ?? '—' }}</div>
    <div><strong>Descripción personal:</strong> {{ optional($profile)->descripcion_personal ?? '—' }}</div>
    @endif

    @can('update', $user)
    <div class="mt-3">
        <a href="{{ route('perfil.edit', $user->id) }}" class="btn btn-primary">Editar mi perfil</a>
    </div>
    @endcan
</div>
@endsection