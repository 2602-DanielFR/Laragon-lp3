@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Breadcrumb -->
    <nav class="mb-8 text-sm">
        <a href="{{ route('home') }}" class="text-blue-400 hover:text-blue-300">Inicio</a>
        <span class="text-gray-400 mx-2">/</span>
        <a href="{{ route('proyectos.index') }}" class="text-blue-400 hover:text-blue-300">Proyectos</a>
        <span class="text-gray-400 mx-2">/</span>
        <span class="text-gray-300">{{ $proyecto->titulo }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contenido Principal -->
        <div class="lg:col-span-2">
            <!-- Imagen Banner -->
            <div class="relative h-96 bg-gray-800 rounded-lg overflow-hidden mb-6">
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

                <!-- Badge de estado -->
                <div class="absolute top-4 left-4">
                    <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $proyecto->getEstadoLegible() }}
                    </span>
                </div>
            </div>

            <!-- Título y Categoría -->
            <div class="mb-6">
                <div class="flex items-center mb-2">
                    <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $proyecto->categoria->nombre }}
                    </span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">{{ $proyecto->titulo }}</h1>
                <p class="text-gray-400 text-lg">{{ $proyecto->descripcion_corta }}</p>
            </div>

            <!-- Info del Emprendedor -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-lg font-bold mr-4">
                            {{ strtoupper(substr($proyecto->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">{{ $proyecto->user->name }}</h4>
                            <p class="text-gray-400 text-sm">
                                @if ($proyecto->user->emprendedor)
                                    {{ $proyecto->user->emprendedor->organizacion }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('perfil.show', $proyecto->user->id) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                        Ver Perfil
                    </a>
                </div>
            </div>

            <!-- Descripción Completa -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-white mb-4">Sobre este proyecto</h3>
                <div class="text-gray-300 leading-relaxed">
                    {{ $proyecto->descripcion }}
                </div>
            </div>

            <!-- Actualizaciones -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-2xl font-bold text-white mb-4">
                    <i class="fas fa-bell mr-2"></i>Actualizaciones
                </h3>

                @if ($actualizaciones->count() > 0)
                    <div class="space-y-6">
                        @foreach ($actualizaciones as $actualizacion)
                            <div class="border-l-4 border-blue-600 pl-4">
                                <h4 class="text-lg font-semibold text-white mb-2">{{ $actualizacion->titulo }}</h4>
                                <p class="text-gray-400 text-sm mb-2">
                                    {{ $actualizacion->created_at->format('d \d\e F \d\e Y - H:i') }}
                                </p>
                                <p class="text-gray-300 mb-2">{{ $actualizacion->contenido }}</p>
                                @if ($actualizacion->imagen)
                                    <img src="{{ asset('storage/' . $actualizacion->imagen) }}"
                                        alt="{{ $actualizacion->titulo }}"
                                        class="rounded-lg mt-3 max-h-64 object-cover">
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación de actualizaciones -->
                    <div class="mt-6">
                        {{ $actualizaciones->links() }}
                    </div>
                @else
                    <p class="text-gray-400">No hay actualizaciones disponibles aún.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar Derecha -->
        <div class="lg:col-span-1">
            <!-- Card de Recaudación -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg p-6 mb-6 sticky top-6">
                <!-- Meta -->
                <div class="mb-6">
                    <p class="text-blue-200 text-sm mb-1">Meta de recaudación</p>
                    <h3 class="text-4xl font-bold text-white">
                        ${{ number_format($proyecto->monto_actual, 2) }}
                    </h3>
                    <p class="text-blue-200 text-sm">de ${{ number_format($proyecto->objetivo_recaudacion, 2) }}</p>
                </div>

                <!-- Progreso -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-blue-200 text-sm">Progreso</span>
                        <span class="text-white font-bold">{{ round($proyecto->porcentaje_alcanzado) }}%</span>
                    </div>
                    <div class="w-full bg-blue-400 bg-opacity-30 rounded-full h-3">
                        <div class="bg-white h-3 rounded-full transition-all duration-500"
                            style="width: {{ min($proyecto->porcentaje_alcanzado, 100) }}%"></div>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-blue-500">
                    <div>
                        <p class="text-blue-200 text-xs">Donantes</p>
                        <p class="text-white text-2xl font-bold">{{ $proyecto->contador_donantes }}</p>
                    </div>
                    <div>
                        <p class="text-blue-200 text-xs">Donaciones</p>
                        <p class="text-white text-2xl font-bold">{{ $proyecto->contador_donaciones }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-blue-200 text-xs">Tiempo restante</p>
                        <p class="text-white text-xl font-bold">
                            @if ($proyecto->diasRestantes() > 0)
                                {{ $proyecto->diasRestantes() }} días
                            @else
                                <span class="text-red-300">Finalizado</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Botón Donar -->
                @if ($proyecto->puedeRecibirDonaciones())
                    <a href="{{ route('donaciones.create', $proyecto->id) }}"
                        class="w-full bg-white text-blue-600 font-bold py-3 px-4 rounded-lg hover:bg-gray-100 transition text-center">
                        <i class="fas fa-heart mr-2"></i>Donar Ahora
                    </a>
                @else
                    <button disabled
                        class="w-full bg-gray-400 text-gray-700 font-bold py-3 px-4 rounded-lg text-center cursor-not-allowed opacity-50">
                        Proyecto Finalizado
                    </button>
                @endif

                <!-- Botón Compartir -->
                <div class="mt-4 flex gap-2">
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($proyecto->titulo . ' ' . route('proyectos.show', $proyecto->id)) }}"
                        target="_blank"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded text-center text-sm transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('proyectos.show', $proyecto->id)) }}"
                        target="_blank"
                        class="flex-1 bg-blue-700 hover:bg-blue-800 text-white py-2 px-3 rounded text-center text-sm transition">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ route('proyectos.show', $proyecto->id) }}')"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white py-2 px-3 rounded text-center text-sm transition">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>

            <!-- Estado del Proyecto -->
            <div class="bg-gray-800 rounded-lg p-4">
                <h4 class="text-white font-bold mb-3">Estado del Proyecto</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Estado:</span>
                        <span class="text-white font-semibold">{{ $proyecto->getEstadoLegible() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Creado:</span>
                        <span class="text-white">{{ $proyecto->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Finaliza:</span>
                        <span class="text-white">{{ $proyecto->fecha_fin->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Meta faltante:</span>
                        <span class="text-white">${{ number_format($proyecto->montoFaltante(), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Edición (Solo para propietario) -->
    @if (auth()->check() && auth()->id() === $proyecto->user_id)
        <div class="mt-8 flex gap-4 justify-center">
            <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-edit mr-2"></i>Editar Proyecto
            </a>
            @if ($proyecto->estado === 'draft')
                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" class="inline"
                    onsubmit="return confirm('¿Estás seguro?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                        <i class="fas fa-trash mr-2"></i>Eliminar
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>

<style>
    .btn-primary-brand{ background: #f96854; color: #fff; border: none; }
    .btn-primary-brand:hover{ background: #e65b48; color:#fff; }
    .card { border-radius: .6rem; }
    .progress-bar{ transition: width .6s ease; }
</style>
@endsection
