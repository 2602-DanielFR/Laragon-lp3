@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <a href="{{ route('admin.proyectos.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-2 block">
                    ← Volver a Proyectos
                </a>
                <h1 class="text-3xl font-bold text-gray-900">{{ $proyecto->titulo }}</h1>
                <p class="mt-2 text-gray-600">Estado: 
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $proyecto->getEstadoBadge() }} text-white">
                        {{ $proyecto->getEstadoLegible() }}
                    </span>
                    @if($proyecto->estado === \App\Models\Proyecto::STATUS_REJECTED && $proyecto->razon_rechazo)
                        <span class="ml-2 text-red-600 text-sm">({{ $proyecto->razon_rechazo }})</span>
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
                <!-- Imagen Banner -->
                <div class="relative h-64 bg-gray-800 rounded-lg overflow-hidden mb-6">
                    @if ($proyecto->imagen_banner)
                        <img src="{{ asset('storage/' . $proyecto->imagen_banner) }}" alt="{{ $proyecto->titulo }}"
                            class="w-full h-full object-cover">
                    @elseif ($proyecto->imagen)
                        <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500">
                            <i class="fas fa-image text-6xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Información del Emprendedor -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Información del Emprendedor</h2>
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user-circle text-gray-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-900">{{ $proyecto->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $proyecto->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detalles del Proyecto -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Detalles del Proyecto</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Título</p>
                            <p class="text-lg text-gray-900">{{ $proyecto->titulo }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Descripción Corta</p>
                            <p class="text-gray-900">{{ $proyecto->descripcion_corta }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Descripción Completa</p>
                            <p class="text-gray-900 mt-1">{{ $proyecto->descripcion }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Categoría</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded">
                                        {{ $proyecto->categoria->nombre ?? 'Sin categoría' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Meta de Recaudación</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">${{ number_format($proyecto->objetivo_recaudacion, 2) }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Fecha de Inicio</p>
                                <p class="text-gray-900 mt-1">{{ $proyecto->fecha_inicio ? $proyecto->fecha_inicio->format('d/m/Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Fecha de Término</p>
                                <p class="text-gray-900 mt-1">{{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('d/m/Y') : 'No definida' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historial de Donaciones -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Historial de Donaciones</h2>
                    
                    @if($proyecto->donaciones->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donante</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referencia</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($proyecto->donaciones as $donacion)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $donacion->user->name ?? 'Anónimo' }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $donacion->user->email ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-green-600">
                                                    S/ {{ number_format($donacion->monto, 2) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ $donacion->created_at->format('d/m/Y H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                                                {{ $donacion->referencia }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-500 italic">No hay donaciones registradas aún.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar - Acciones -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Acciones</h2>

                    @if($proyecto->estado === \App\Models\Proyecto::STATUS_PENDING)
                        <!-- Botón Aprobar -->
                        <form action="{{ route('admin.proyectos.aprobar', $proyecto->id) }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition flex items-center justify-center gap-2">
                                <i class="fas fa-check-circle w-5 h-5"></i>
                                Aprobar Proyecto
                            </button>
                        </form>

                        <!-- Botón Rechazar -->
                        <button type="button" class="w-full px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition flex items-center justify-center gap-2"
                                onclick="document.getElementById('rejectionModal').classList.remove('hidden')">
                            <i class="fas fa-times-circle w-5 h-5"></i>
                            Rechazar Proyecto
                        </button>
                    @elseif($proyecto->estado === \App\Models\Proyecto::STATUS_REJECTED)
                        <!-- Botón Revertir -->
                        <form action="{{ route('admin.proyectos.revertir', $proyecto->id) }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white font-semibold transition flex items-center justify-center gap-2">
                                <i class="fas fa-undo w-5 h-5"></i>
                                Revertir a Pendiente
                            </button>
                        </form>
                    @elseif($proyecto->estado === \App\Models\Proyecto::STATUS_ACTIVE)
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
                                <p class="text-lg font-bold text-gray-900">${{ number_format($proyecto->monto_actual, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Progreso</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                    @php
                                        $porcentaje = $proyecto->objetivo_recaudacion > 0 ? (($proyecto->monto_actual ?? 0) / $proyecto->objetivo_recaudacion) * 100 : 0;
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

<!-- Rejection Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Rechazar Proyecto</h3>
            <div class="mt-2 px-7 py-3">
                <form action="{{ route('admin.proyectos.rechazar', $proyecto->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="razon_rechazo" class="block text-sm font-medium text-gray-700">Motivo del Rechazo *</label>
                        <textarea name="razon_rechazo" id="razon_rechazo" rows="4" 
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                  placeholder="Explica por qué se rechaza este proyecto..." required></textarea>
                        @error('razon_rechazo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="items-center px-4 py-3">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Confirmar Rechazo
                        </button>
                        <button type="button" onclick="document.getElementById('rejectionModal').classList.add('hidden')"
                                class="mt-3 px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection