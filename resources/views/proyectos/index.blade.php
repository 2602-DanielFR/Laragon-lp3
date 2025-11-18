@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Explorar Proyectos</h1>
    <p>Aquí se mostrarán todos los proyectos aprobados y activos.</p>
    {{-- Filters for search, category, order --}}
    <div class="row">
        {{-- Loop through projects --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Título del Proyecto</h5>
                    <p class="card-text">Breve descripción del proyecto.</p>
                    <p>Meta: €1000 / Recaudado: €250</p>
                    <a href="#" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
