@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center justify-content-center p-4 home-left">
                        <div class="text-center text-white">
                            <h2 class="mb-2">Hola, {{ Auth::user()->name }}!</h2>
                            <p class="small mb-0">Bienvenido a {{ config('app.name', 'Laravel') }}</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <p class="lead text-muted mb-3">Tu dashboard central. Desde aquí puedes gestionar tus actividades.</p>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="row mt-4">
                                {{-- Common Action --}}
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">Explorar Proyectos</h5>
                                            <p class="card-text text-muted">Descubre y apoya nuevas iniciativas.</p>
                                            <a href="{{ route('proyectos.index') }}" class="btn btn-primary-brand mt-auto">Explorar</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Role-specific Actions --}}
                                @if(Auth::user()->role == 'Emprendedor')
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">Gestionar Mis Proyectos</h5>
                                            <p class="card-text text-muted">Crea, edita y sigue el progreso de tus campañas.</p>
                                            <a href="{{ route('emprendedor.dashboard') }}" class="btn btn-outline-secondary-brand mt-auto">Ir a mi Dashboard</a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(Auth::user()->role == 'Donante')
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">Ver Mis Donaciones</h5>
                                            <p class="card-text text-muted">Revisa tu historial de contribuciones.</p>
                                            <a href="{{ route('donante.donaciones.index') }}" class="btn btn-outline-secondary-brand mt-auto">Ver Historial</a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(Auth::user()->role == 'Admin')
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">Panel de Administración</h5>
                                            <p class="card-text text-muted">Gestiona usuarios, proyectos y categorías.</p>
                                            <a href="{{ route('admin.dashboard') }}" class="btn btn-admin mt-auto">Acceder</a>
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
    </div>
</div>
<style>
    .home-left{ background: linear-gradient(180deg,#052d49 0%, #044056 100%); }
    .btn-primary-brand{ background: #f96854; color: #fff; border: none; }
    .btn-primary-brand:hover{ background: #e65b48; }
    .btn-outline-secondary-brand{ border: 1px solid #052d49; color: #052d49; background: transparent; }
    .btn-outline-secondary-brand:hover{ background: rgba(5,45,73,0.06); }
    .btn-admin{ background: #052d49; color: #fff; border: none; }
    .btn-admin:hover{ background: #043242; }
</style>
@endsection