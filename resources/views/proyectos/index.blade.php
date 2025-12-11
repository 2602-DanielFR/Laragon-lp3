@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-indigo-700 to-pink-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">Explora Proyectos y Haz Impacto</h1>
                        <p class="text-indigo-100">Conecta con causas sociales y ambientales que necesitan tu apoyo.</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats & Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-sm text-gray-500">Proyectos Activos</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($projects ?? []) }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-sm text-gray-500">Total Recaudado</p>
                    <p class="text-2xl font-bold text-gray-900">S/{{ number_format(collect($projects ?? [])->sum('recaudado'),2) }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-sm text-gray-500">Donaciones</p>
                    <p class="text-2xl font-bold text-gray-900">{{ collect($projects ?? [])->sum(function($p){ return $p->donantes_count ?? 0; }) }}</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('proyectos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">Crear Proyecto</a>
                <a href="#filters" class="border border-gray-200 px-3 py-2 rounded-lg text-sm">Filtros</a>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="mb-6 bg-white rounded-lg shadow p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <input type="text" placeholder="Buscar por título o descripción" class="border rounded-lg px-3 py-2 w-full md:w-96">
                <select class="border rounded-lg px-3 py-2">
                    <option value="">Todas las categorías</option>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('proyectos.index') }}" class="text-sm text-gray-600">Limpiar</a>
                <a href="#" class="bg-indigo-600 text-white px-3 py-2 rounded-lg text-sm">Aplicar</a>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects ?? [] as $project)
                @php
                    $meta = $project->meta ?? 0;
                    $raised = $project->recaudado ?? ($project->recaudo ?? 0) ;
                    $pct = $meta > 0 ? min(100, round(($raised / $meta) * 100)) : 0;
                @endphp
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow flex flex-col">
                    <img src="{{ $project->imagen_url ?? asset('images/project-placeholder.jpg') }}" alt="{{ $project->titulo ?? 'Proyecto' }}" class="w-full h-44 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $project->titulo ?? 'Título del Proyecto' }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $project->descripcion ? Str::limit($project->descripcion, 110) : 'Breve descripción del proyecto.' }}</p>
                        </div>

                        <div class="mt-4 mb-2">
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
                                <span>Meta: <strong>S/{{ number_format($meta,2) }}</strong></span>
                                <span>{{ $pct }}% alcanzado</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full bg-gradient-to-r from-indigo-500 to-pink-500" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <div class="text-sm text-gray-600">Recaudado: <strong>S/{{ number_format($raised ?? 0,2) }}</strong></div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('proyectos.show', $project->id) }}" class="text-sm text-gray-700 hover:text-indigo-600">Ver</a>
                                <a href="{{ route('donaciones.create', ['id' => $project->id]) }}" class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-sm">Donar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3">
                    <div class="bg-white rounded-lg p-6 text-center">
                        <h3 class="text-lg font-medium">No hay proyectos disponibles todavía</h3>
                        <p class="text-sm text-gray-500 mt-2">Vuelve más tarde o crea uno si eres emprendedor.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
