@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <a href="{{ route('emprendedor.dashboard') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Volver al Dashboard
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">🟢 Mis Proyectos Activos</h1>
                    <p class="mt-2 text-gray-600">Lista completa de proyectos que están recibiendo donaciones</p>
                </div>
                <a href="{{ route('proyectos.create') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nuevo Proyecto
                </a>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white rounded-lg shadow-md p-6">
                <div>
                    <p class="text-sm text-gray-500">Total de Proyectos Activos</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $proyectos->total() }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Dinero Recaudado Total</p>
                    <p class="text-2xl font-bold text-green-600">
                        ${{ number_format(
                            \App\Models\Proyecto::where('user_id', Auth::id())
                                ->where('estado', 'activo')
                                ->sum('monto_actual'),
                            2
                        ) }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Donantes Totales</p>
                    <p class="text-2xl font-bold text-purple-600">
                        {{ \App\Models\Donacion::whereIn('proyecto_id', 
                            \App\Models\Proyecto::where('user_id', Auth::id())
                                ->where('estado', 'activo')
                                ->pluck('id')
                        )->distinct('user_id')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        @if($proyectos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($proyectos as $proyecto)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Image -->
                        <div class="relative h-48 bg-gradient-to-br from-blue-400 to-purple-500">
                            @if($proyecto->imagen_banner)
                                <img src="{{ asset('storage/' . $proyecto->imagen_banner) }}" 
                                     alt="{{ $proyecto->titulo }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white opacity-30" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Activo
                            </div>

                            <!-- Progress Badge -->
                            <div class="absolute bottom-3 left-3 right-3">
                                <div class="bg-black bg-opacity-50 text-white px-3 py-2 rounded-lg">
                                    <div class="flex justify-between items-center mb-2 text-xs">
                                        <span>${{ number_format($proyecto->monto_actual, 2) }}</span>
                                        <span class="text-green-300 font-semibold">
                                            {{ round(($proyecto->monto_actual / $proyecto->objetivo_recaudacion) * 100, 1) }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-600 rounded-full h-1.5">
                                        <div class="bg-green-500 h-1.5 rounded-full" 
                                             style="width: {{ min(round(($proyecto->monto_actual / $proyecto->objetivo_recaudacion) * 100, 1), 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $proyecto->categoria->nombre ?? 'Sin categoría' }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    Actualizado hace {{ $proyecto->updated_at->diffInDays(now()) }} días
                                </span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ $proyecto->titulo }}
                            </h3>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                {{ $proyecto->descripcion_corta ?? $proyecto->descripcion }}
                            </p>

                            <!-- Stats -->
                            <div class="grid grid-cols-2 gap-3 mb-4 text-sm">
                                <div class="bg-gray-50 p-3 rounded">
                                    <p class="text-gray-500">Meta</p>
                                    <p class="font-semibold text-gray-900">${{ number_format($proyecto->objetivo_recaudacion, 2) }}</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <p class="text-gray-500">Donantes</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ \App\Models\Donacion::where('proyecto_id', $proyecto->id)->distinct('user_id')->count() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Progreso visualmente -->
                            <div class="mb-4">
                                <p class="text-xs text-gray-600 mb-1">Progreso</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" 
                                             style="width: {{ min(round(($proyecto->monto_actual / $proyecto->objetivo_recaudacion) * 100, 1), 100) }}%">
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-700">
                                        {{ round(($proyecto->monto_actual / $proyecto->objetivo_recaudacion) * 100, 1) }}%
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('proyectos.show', $proyecto->id) }}" 
                                   class="flex-1 text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors text-sm">
                                    Ver Proyecto
                                </a>
                                <a href="{{ route('proyectos.edit', $proyecto->id) }}" 
                                   class="flex-1 text-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 font-medium rounded-lg transition-colors text-sm">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($proyectos->hasPages())
                <div class="mt-8">
                    {{ $proyectos->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay proyectos activos</h3>
                <p class="text-gray-600 mb-6">Aún no tienes proyectos activos. Crea uno nuevo para que comience a recibir donaciones.</p>
                <a href="{{ route('proyectos.create') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    Crear Primer Proyecto
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
