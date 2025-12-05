@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Página de Exploración de Proyectos -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Explorar Proyectos</h1>
        <p class="text-gray-300">Descubre y apoya iniciativas sociales y ambientales que generan impacto</p>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="bg-gray-800 rounded-lg p-6 mb-8">
        <form method="GET" action="{{ route('proyectos.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Búsqueda -->
            <div>
                <label for="buscar" class="block text-sm font-medium text-gray-300 mb-2">Buscar</label>
                <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}"
                    placeholder="Buscar proyectos..."
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Categoría -->
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-300 mb-2">Categoría</label>
                <select name="categoria" id="categoria" class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ordenamiento -->
            <div>
                <label for="orden" class="block text-sm font-medium text-gray-300 mb-2">Ordenar por</label>
                <select name="orden" id="orden" class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500">
                    <option value="reciente" {{ request('orden', 'reciente') == 'reciente' ? 'selected' : '' }}>Más Recientes</option>
                    <option value="antiguo" {{ request('orden') == 'antiguo' ? 'selected' : '' }}>Más Antiguos</option>
                    <option value="mas_donaciones" {{ request('orden') == 'mas_donaciones' ? 'selected' : '' }}>Más Donaciones</option>
                    <option value="cercanos_meta" {{ request('orden') == 'cercanos_meta' ? 'selected' : '' }}>Cercanos a Meta</option>
                </select>
            </div>

            <!-- Botón Buscar -->
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Proyectos Grid -->
    @if ($proyectos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach ($proyectos as $proyecto)
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:shadow-2xl transition transform hover:scale-105">
                    <!-- Imagen del proyecto -->
                    <div class="relative h-48 bg-gray-700 overflow-hidden">
                        @if ($proyecto->imagen)
                            <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif

                        <!-- Badge de categoría -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $proyecto->categoria->nombre }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="p-4">
                        <!-- Título -->
                        <h3 class="text-lg font-bold text-white mb-2 truncate">{{ $proyecto->titulo }}</h3>

                        <!-- Descripción corta -->
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $proyecto->descripcion_corta ?? $proyecto->descripcion }}</p>

                        <!-- Emprendedor -->
                        <div class="flex items-center mb-4">
                            <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center text-white text-xs font-bold mr-2">
                                {{ strtoupper(substr($proyecto->user->name, 0, 1)) }}
                            </div>
                            <span class="text-sm text-gray-400">{{ $proyecto->user->name }}</span>
                        </div>

                        <!-- Progreso -->
                        <div class="mb-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-400">
                                    ${{ number_format($proyecto->monto_actual, 2) }} / ${{ number_format($proyecto->objetivo_recaudacion, 2) }}
                                </span>
                                <span class="text-xs font-semibold text-blue-400">{{ round($proyecto->porcentaje_alcanzado) }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full"
                                    style="width: {{ min($proyecto->porcentaje_alcanzado, 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Estadísticas -->
                        <div class="grid grid-cols-2 gap-2 mb-4 text-xs text-gray-400">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-1"></i>
                                <span>{{ $proyecto->contador_donantes }} Donantes</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-hourglass-half mr-1"></i>
                                <span>{{ $proyecto->diasRestantes() }} días</span>
                            </div>
                        </div>

                        <!-- Botón Ver Proyecto -->
                        <a href="{{ route('proyectos.show', $proyecto->id) }}"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg text-center transition">
                            Ver Proyecto
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="flex justify-center">
            {{ $proyectos->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-search text-6xl text-gray-600 mb-4"></i>
            <h3 class="text-2xl font-bold text-white mb-2">No hay proyectos disponibles</h3>
            <p class="text-gray-400">Intenta con otros filtros o categorías</p>
        </div>
    @endif
</div>
@endsection
        <div>
            {{-- Placeholder for filters (keep logic unchanged) --}}
            <button class="btn btn-sm btn-outline-secondary">Filtros</button>
        </div>
    </div>

    <div class="row gy-4">
        @forelse($projects ?? [] as $project)
            <div class="col-sm-6 col-md-4">
                <div class="card h-100 shadow-sm project-card">
                    <img src="{{ asset('images/project-placeholder.jpg') }}" class="card-img-top" alt="{{ $project->titulo ?? 'Proyecto' }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $project->titulo ?? 'Título del Proyecto' }}</h5>
                        <p class="card-text text-muted small mb-2">{{ $project->descripcion ? Str::limit($project->descripcion, 120) : 'Breve descripción del proyecto.' }}</p>
                        <div class="mt-auto">
                            <p class="mb-2 small">Meta: <strong>S/{{ number_format($project->meta ?? 0, 2) }}</strong></p>
                            <a href="#" class="btn btn-sm btn-primary-brand">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No hay proyectos disponibles todavía.</div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .btn-primary-brand{ background: #f96854; color: #fff; border: none; }
    .btn-primary-brand:hover{ background: #e65b48; color:#fff; }
    .project-card img{ height:160px; object-fit:cover; }
    .card { border-radius: .6rem; }
</style>
@endsection
