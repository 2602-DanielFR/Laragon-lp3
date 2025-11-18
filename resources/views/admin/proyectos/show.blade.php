@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Revisión de Proyecto: Título del Proyecto</h1>
    {{-- Project details here --}}
    <p><strong>Emprendedor:</strong> Juan Emprendedor</p>
    <p><strong>Descripción:</strong> ...</p>
    <p><strong>Meta:</strong> €1000</p>

    <div class="mt-4">
        <form action="#" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Aprobar</button>
        </form>
        <form action="#" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Rechazar</button>
        </form>
    </div>
</div>
@endsection
