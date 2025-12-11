@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Gestión de Proyectos</h1>
            <p class="mt-2 text-sm text-gray-600">Revisa y gestiona los proyectos de la plataforma</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <div class="flex">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="flex">
                <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Proyectos</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-layer-group text-blue-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pendientes</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $stats['pendiente_revision'] }}</p>
                </div>
                <div class="p-3 bg-orange-100 rounded-full">
                    <i class="fas fa-hourglass-half text-orange-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Activos</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['activos'] }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Rechazados</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['rechazados'] }}</p>
                </div>
                <div class="p-3 bg-red-100 rounded-full">
                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Completados</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['completados'] }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-trophy text-blue-600 text-2xl"></i>
                </div>
            </div>
             <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Borradores</p>
                    <p class="text-3xl font-bold text-gray-600">{{ $stats['borradores'] }}</p>
                </div>
                <div class="p-3 bg-gray-200 rounded-full">
                    <i class="fas fa-file-alt text-gray-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <form method="GET" action="{{ route('admin.proyectos.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" 
                                   value="{{ request('search') }}"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Buscar por título, descripción o emprendedor...">
                        </div>
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                        <select name="estado" id="estado" 
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Todos los estados</option>
                            <option value="{{ \App\Models\Proyecto::STATUS_PENDING }}" {{ request('estado') == \App\Models\Proyecto::STATUS_PENDING ? 'selected' : '' }}>Pendiente</option>
                            <option value="{{ \App\Models\Proyecto::STATUS_ACTIVE }}" {{ request('estado') == \App\Models\Proyecto::STATUS_ACTIVE ? 'selected' : '' }}>Activo</option>
                            <option value="{{ \App\Models\Proyecto::STATUS_REJECTED }}" {{ request('estado') == \App\Models\Proyecto::STATUS_REJECTED ? 'selected' : '' }}>Rechazado</option>
                            <option value="{{ \App\Models\Proyecto::STATUS_COMPLETED }}" {{ request('estado') == \App\Models\Proyecto::STATUS_COMPLETED ? 'selected' : '' }}>Completado</option>
                            <option value="{{ \App\Models\Proyecto::STATUS_DRAFT }}" {{ request('estado') == \App\Models\Proyecto::STATUS_DRAFT ? 'selected' : '' }}>Borrador</option>
                            <option value="{{ \App\Models\Proyecto::STATUS_CANCELLED }}" {{ request('estado') == \App\Models\Proyecto::STATUS_CANCELLED ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>

                    <!-- Categoría -->
                    <div>
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                        <select name="categoria_id" id="categoria_id" 
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.proyectos.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($proyectos as $proyecto)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <!-- Image -->
                <div class="relative h-48 bg-gradient-to-br from-blue-500 to-purple-600">
                    @if($proyecto->imagen)
                    <img src="{{ asset('storage/' . $proyecto->imagen) }}" 
                         alt="{{ $proyecto->titulo }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-200 text-gray-500">
                        <i class="fas fa-image text-5xl"></i>
                    </div>
                    @endif

                    <!-- Estado Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $proyecto->getEstadoBadge() }} text-white">
                            {{ $proyecto->getEstadoLegible() }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $proyecto->categoria->nombre }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $proyecto->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        {{ $proyecto->titulo }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                        {{ $proyecto->descripcion_corta ?? Str::limit($proyecto->descripcion, 100) }}
                    </p>

                    <!-- Emprendedor -->
                    <div class="flex items-center mb-4">
                        <div class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-circle text-gray-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $proyecto->user->name }}</p>
                        </div>
                    </div>

                    <!-- Meta -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Meta</span>
                            <span class="font-semibold text-gray-900">${{ number_format($proyecto->objetivo_recaudacion, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $proyecto->porcentaje_alcanzado }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ round($proyecto->porcentaje_alcanzado) }}% Alcanzado</p>
                    </div>

                    <!-- Actions -->
                    <a href="{{ route('admin.proyectos.show', $proyecto->id) }}" 
                       class="block w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Ver Detalles
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center bg-white rounded-lg shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No hay proyectos para mostrar</h3>
                <p class="mt-1 text-sm text-gray-500">No se encontraron proyectos con los filtros aplicados.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($proyectos->hasPages())
        <div class="mt-8">
            {{ $proyectos->links() }}
        </div>
        @endif
    </div>
</div>
@endsection