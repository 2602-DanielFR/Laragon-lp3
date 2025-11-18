@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5 text-center">
                    <h1 class="mb-3">Bienvenido a {{ config('app.name', 'Laravel') }}, {{ Auth::user()->name }}!</h1>
                    <p class="lead text-muted mb-4">Tu dashboard central. Desde aquí puedes gestionar tus actividades.</p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mt-5">
                        {{-- Common Action --}}
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Explorar Proyectos</h5>
                                    <p class="card-text">Descubre y apoya nuevas iniciativas.</p>
                                    <a href="{{ route('proyectos.index') }}" class="btn btn-primary">Explorar</a>
                                </div>
                            </div>
                        </div>

                        {{-- Role-specific Actions --}}
                        @if(Auth::user()->role == 'Emprendedor')
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Gestionar Mis Proyectos</h5>
                                    <p class="card-text">Crea, edita y sigue el progreso de tus campañas.</p>
                                    <a href="{{ route('emprendedor.dashboard') }}" class="btn btn-success">Ir a mi Dashboard</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->role == 'Donante')
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Ver Mis Donaciones</h5>
                                    <p class="card-text">Revisa tu historial de contribuciones.</p>
                                    <a href="{{ route('donante.donaciones.index') }}" class="btn btn-info text-white">Ver Historial</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->role == 'Admin')
                        <div class="col-md-4">
                            <div class="card h-100 bg-dark text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Administración</h5>
                                    <p class="card-text">Gestiona usuarios, proyectos y categorías.</p>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Acceder</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection