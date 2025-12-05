@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <a href="{{ route('admin.proyectos.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-2 block">
                    ← Volver a Proyectos
                </a>
                <h1 class="text-3xl font-bold text-gray-900">{{ $proyecto->titulo }}</h1>
                <p class="mt-2 text-gray-600">Estado: 
                    @if($proyecto->estado === 'pendiente_revision')
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded">⏳ Pendiente de Revisión</span>
                    @elseif($proyecto->estado === 'activo')
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded">✅ Activo</span>
                    @elseif($proyecto->estado === 'rechazado')
                        <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded">❌ Rechazado</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <p class="text-green-700 font-medium">✅ {{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <p class="text-red-700 font-medium">❌ {{ session('error') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Información del Emprendedor -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Información del Emprendedor</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nombre</p>
                            <p class="text-lg text-gray-900">{{ $proyecto->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Email</p>
                            <p class="text-gray-900">{{ $proyecto->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Teléfono</p>
                            <p class="text-gray-900">{{ $proyecto->user->phone ?? 'No registrado' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detalles del Proyecto -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Detalles del Proyecto</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Descripción</p>
                            <p class="text-gray-900 mt-1">{{ $proyecto->descripcion }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Categoría</p>
                                <p class="text-gray-900 mt-1">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded">
                                        {{ $proyecto->categoria->nombre ?? 'Sin categoría' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Meta de Recaudación</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">${{ number_format($proyecto->objetivo, 2) }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Fecha de Vencimiento</p>
                                <p class="text-gray-900 mt-1">{{ $proyecto->fecha_vencimiento ? $proyecto->fecha_vencimiento->format('d/m/Y') : 'No definida' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Creado</p>
                                <p class="text-gray-900 mt-1">{{ $proyecto->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Motivo de Rechazo (si aplica) -->
                @if($proyecto->estado === 'rechazado' && $proyecto->razon_rechazo)
                <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-bold text-red-900 mb-2">Motivo del Rechazo</h3>
                    <p class="text-red-800">{{ $proyecto->razon_rechazo }}</p>
                </div>
                @endif
            </div>

            <!-- Sidebar - Acciones -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Acciones</h2>

                    @if($proyecto->estado === 'pendiente_revision')
                        <!-- Botón Aprobar -->
                        <form action="{{ route('admin.proyectos.aprobar', $proyecto->id) }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Aprobar Proyecto
                            </button>
                        </form>

                        <!-- Botón Rechazar -->
                        <button type="button" class="w-full px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition flex items-center justify-center gap-2" data-toggle="modal" data-target="#modalRechazar">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Rechazar Proyecto
                        </button>
                    @elseif($proyecto->estado === 'rechazado')
                        <!-- Botón Revertir -->
                        <form action="{{ route('admin.proyectos.revertir', $proyecto->id) }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white font-semibold transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7 7 0 0111.601 2.566 1 1 0 11-1.947.34A5 5 0 005.09 5.1V3a1 1 0 01-1-1zm12 15a1 1 0 00-1-1v-2.101a7 7 0 01-11.601-2.566 1 1 0 11 1.947-.34A5 5 0 0014.91 14.9V17a1 1 0 001 1z" clip-rule="evenodd"/>
                                </svg>
                                Revertir a Pendiente
                            </button>
                        </form>
                    @elseif($proyecto->estado === 'activo')
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-green-800 font-medium">✅ Este proyecto está activo</p>
                            <p class="text-sm text-green-700 mt-2">Los usuarios pueden verlo y realizar donaciones.</p>
                        </div>
                    @endif

                    <!-- Estadísticas -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-sm font-bold text-gray-900 mb-4">Estadísticas</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-600">Donaciones</p>
                                <p class="text-lg font-bold text-gray-900">{{ $proyecto->donaciones->count() ?? 0 }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Monto Recaudado</p>
                                <p class="text-lg font-bold text-gray-900">${{ number_format($proyecto->donaciones->sum('monto') ?? 0, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Progreso</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                    @php
                                        $porcentaje = $proyecto->objetivo > 0 ? (($proyecto->donaciones->sum('monto') ?? 0) / $proyecto->objetivo) * 100 : 0;
                                    @endphp
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min($porcentaje, 100) }}%"></div>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">{{ round($porcentaje, 1) }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Rechazar -->
<div class="modal fade" id="modalRechazar" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.proyectos.rechazar', $proyecto->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rechazar Proyecto</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="razon_rechazo" class="form-label">Motivo del Rechazo *</label>
                        <textarea class="form-control @error('razon_rechazo') is-invalid @enderror" 
                                  id="razon_rechazo" name="razon_rechazo" rows="4"
                                  placeholder="Explica el motivo del rechazo..."
                                  required></textarea>
                        @error('razon_rechazo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Rechazar Proyecto</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
