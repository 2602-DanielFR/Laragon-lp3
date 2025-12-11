@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-6 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Panel de Control</h1>
                    <p class="text-blue-100">Gestiona tus proyectos y monitorea el progreso.</p>
                </div>
                <a href="{{ route('proyectos.create') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-100 transition">
                    <i class="fas fa-plus mr-2"></i>Nuevo Proyecto
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm mb-1">Proyectos Activos</div>
                <div class="text-3xl font-bold text-green-600">{{ $proyectosActivos->count() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm mb-1">En Revisión</div>
                <div class="text-3xl font-bold text-yellow-600">{{ $proyectosPendientes->count() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm mb-1">Borradores</div>
                <div class="text-3xl font-bold text-gray-600">{{ $proyectosBorradores->count() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm mb-1">Total Recaudado</div>
                <div class="text-3xl font-bold text-blue-600">S/{{ number_format($proyectosActivos->sum('monto_actual'), 2) }}</div>
            </div>
        </div>

        <!-- Projects Lists -->
        <div class="space-y-8">
            
            <!-- Active Projects -->
            @if($proyectosActivos->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                    <h3 class="text-lg font-bold text-green-800">🚀 Proyectos Activos</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($proyectosActivos as $proyecto)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $proyecto->imagen ? asset('storage/'.$proyecto->imagen) : asset('images/project-placeholder.jpg') }}" class="w-16 h-16 rounded object-cover mr-4">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">
                                        <a href="{{ route('proyectos.show', $proyecto->id) }}" class="hover:text-blue-600">{{ $proyecto->titulo }}</a>
                                    </h4>
                                    <div class="text-sm text-gray-500 mt-1">
                                        <span class="mr-4"><i class="fas fa-bullseye mr-1"></i>Meta: S/{{ number_format($proyecto->objetivo_recaudacion, 2) }}</span>
                                        <span><i class="fas fa-calendar mr-1"></i>Fin: {{ $proyecto->fecha_fin->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900">S/{{ number_format($proyecto->monto_actual, 2) }}</div>
                                <div class="text-sm text-gray-500">{{ $proyecto->porcentaje_alcanzado }}% financiado</div>
                            </div>
                        </div>
                        <div class="mt-4 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ min($proyecto->porcentaje_alcanzado, 100) }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Pending Projects -->
            @if($proyectosPendientes->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-yellow-50">
                    <h3 class="text-lg font-bold text-yellow-800">⏳ Pendientes de Revisión</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($proyectosPendientes as $proyecto)
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">{{ $proyecto->titulo }}</h4>
                            <p class="text-sm text-gray-500">Enviado el {{ $proyecto->created_at->format('d/m/Y') }}</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">En espera</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Rejected Projects -->
            @if($proyectosRechazados->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-bold text-red-800">❌ Proyectos Rechazados (Requieren Acción)</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($proyectosRechazados as $proyecto)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">{{ $proyecto->titulo }}</h4>
                                <div class="mt-2 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 text-sm">
                                    <strong>Motivo:</strong> {{ $proyecto->razon_rechazo ?? 'No especificado' }}
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">Corregir y Reenviar</a>
                                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este proyecto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-300 transition">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Drafts -->
            @if($proyectosBorradores->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">📝 Borradores</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($proyectosBorradores as $proyecto)
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">{{ $proyecto->titulo }}</h4>
                            <p class="text-sm text-gray-500">Última edición: {{ $proyecto->updated_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Editar</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar borrador?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($proyectosActivos->isEmpty() && $proyectosPendientes->isEmpty() && $proyectosBorradores->isEmpty() && $proyectosRechazados->isEmpty())
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Aún no tienes proyectos</h3>
                    <p class="text-gray-500 mb-6">Comienza tu viaje de emprendimiento hoy mismo.</p>
                    <a href="{{ route('proyectos.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition">Crear Primer Proyecto</a>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection