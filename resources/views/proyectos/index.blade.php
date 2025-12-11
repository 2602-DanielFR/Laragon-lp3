@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-principal to-secundario rounded-xl shadow-xl p-8 md:p-12 mb-12 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Explora Proyectos</h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-2xl">Descubre iniciativas increíbles que están cambiando el mundo y sé parte de ellas.</p>
            </div>
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
        </div>

        <!-- Search & Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form action="{{ route('proyectos.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
                <!-- Search -->
                <div class="flex-1">
                    <label for="buscar" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-principal focus:border-principal sm:text-sm" 
                               placeholder="Título o descripción...">
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="w-full md:w-1/4">
                    <label for="categoria" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                    <select id="categoria" name="categoria" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-principal focus:border-principal sm:text-sm rounded-md">
                        <option value="">Todas</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Order -->
                <div class="w-full md:w-1/4">
                    <label for="orden" class="block text-sm font-medium text-gray-700 mb-1">Ordenar por</label>
                    <select id="orden" name="orden" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-principal focus:border-principal sm:text-sm rounded-md">
                        <option value="reciente" {{ request('orden') == 'reciente' ? 'selected' : '' }}>Más Recientes</option>
                        <option value="antiguo" {{ request('orden') == 'antiguo' ? 'selected' : '' }}>Más Antiguos</option>
                        <option value="mas_donaciones" {{ request('orden') == 'mas_donaciones' ? 'selected' : '' }}>Más Apoyados</option>
                        <option value="cercanos_meta" {{ request('orden') == 'cercanos_meta' ? 'selected' : '' }}>Cerca de la Meta</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="md:flex-shrink-0">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-principal hover:bg-principal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal transition-colors">
                        Filtrar
                    </button>
                </div>
                
                @if(request()->has('buscar') || request()->has('categoria') || request()->has('orden'))
                    <div class="md:flex-shrink-0">
                        <a href="{{ route('proyectos.index') }}" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Limpiar
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Projects Grid -->
        @if($proyectos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($proyectos as $proyecto)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                        <!-- Image -->
                        <div class="relative h-48 bg-gray-200">
                            @if($proyecto->imagen)
                                <img src="{{ $proyecto->imagen_url }}" alt="{{ $proyecto->titulo }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full bg-gradient-to-br from-blue-100 to-indigo-100 text-indigo-300">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="bg-white bg-opacity-90 backdrop-filter backdrop-blur-sm text-gray-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ $proyecto->categoria->nombre }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <div class="h-8 w-8 rounded-full bg-principal text-white flex items-center justify-center text-xs font-bold mr-2">
                                        {{ strtoupper(substr($proyecto->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm text-gray-600 truncate">{{ $proyecto->user->name }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-principal transition-colors">
                                    <a href="{{ route('proyectos.show', $proyecto->id) }}">{{ $proyecto->titulo }}</a>
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $proyecto->descripcion_corta }}
                                </p>
                            </div>

                            <!-- Progress -->
                            <div class="mt-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-semibold text-gray-900">S/ {{ number_format($proyecto->monto_actual, 2) }}</span>
                                    <span class="text-gray-500">{{ round($proyecto->porcentaje_alcanzado) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-principal h-2 rounded-full" style="width: {{ min($proyecto->porcentaje_alcanzado, 100) }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-2">
                                    <span>{{ $proyecto->contador_donantes }} donantes</span>
                                    <span>Meta: S/ {{ number_format($proyecto->objetivo_recaudacion, 0) }}</span>
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="mt-6 pt-4 border-t border-gray-100">
                                <a href="{{ route('proyectos.show', $proyecto->id) }}" class="block w-full text-center px-4 py-2 bg-white border border-principal text-principal font-semibold rounded-lg hover:bg-principal hover:text-white transition-colors duration-300">
                                    Ver Proyecto
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $proyectos->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No se encontraron proyectos</h3>
                <p class="mt-2 text-gray-500">Intenta ajustar tus filtros o búsqueda para encontrar lo que buscas.</p>
                <div class="mt-6">
                    <a href="{{ route('proyectos.index') }}" class="text-principal hover:text-principal-dark font-medium">
                        Limpiar todos los filtros
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection