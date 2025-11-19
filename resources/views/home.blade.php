@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="p-5 rounded-4 mb-4 text-center" style="background: linear-gradient(135deg, #052d49 0%, #07375a 60%, #052d49 100%); color:#fff;">
                <h1 class="mb-2 fw-semibold">Hola {{ Auth::user()->name }}, bienvenido a {{ config('app.name', 'Laravel') }}</h1>
                <p class="mb-0 text-white-50">Gestiona todo desde un solo lugar. Empieza con una acción rápida.</p>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                        <div>Tu dashboard central. Desde aquí puedes gestionar tus actividades.</div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row g-4 mt-2 mt-md-4">
                        {{-- Common Action --}}
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold">Explorar Proyectos</h5>
                                    <p class="card-text flex-grow-1">Descubre y apoya nuevas iniciativas.</p>
                                    <a href="{{ route('proyectos.index') }}" class="btn btn-primary w-100">Explorar</a>
                                </div>
                            </div>
                        </div>

                        {{-- Role-specific Actions --}}
                        @if(Auth::user()->role == 'Emprendedor')
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold">Gestionar Mis Proyectos</h5>
                                    <p class="card-text flex-grow-1">Crea, edita y sigue el progreso de tus campañas.</p>
                                    <a href="{{ route('emprendedor.dashboard') }}" class="btn btn-secondary w-100">Ir a mi Dashboard</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->role == 'Donante')
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold">Ver Mis Donaciones</h5>
                                    <p class="card-text flex-grow-1">Revisa tu historial de contribuciones.</p>
                                    <a href="{{ route('donante.donaciones.index') }}" class="btn btn-primary w-100">Ver Historial</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->role == 'Admin')
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold">Panel de Administración</h5>
                                    <p class="card-text flex-grow-1">Gestiona usuarios, proyectos y categorías.</p>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100">Acceder</a>
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