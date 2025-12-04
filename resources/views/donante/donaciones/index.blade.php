@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">¡Hola, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-blue-100 text-lg">Gracias por apoyar proyectos que generan impacto</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">D</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Total Donado</p>
                        <p class="text-2xl font-bold text-gray-900">S/{{ number_format(collect($donations ?? [])->sum('amount'),2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Donaciones</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($donations ?? []) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Proyectos Apoyados</p>
                        <p class="text-2xl font-bold text-gray-900">{{ collect($donations ?? [])->pluck('project.id')->unique()->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Última Donación</p>
                        <p class="text-2xl font-bold text-gray-900">@if(count($donations ?? []) > 0) {{ optional(collect($donations)->first())->created_at->diffForHumans() }} @else - @endif</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones Rápidas</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('proyectos.index') }}" 
                           class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">Explorar Proyectos</p>
                                <p class="text-sm text-gray-500">Encuentra nuevas causas para apoyar</p>
                            </div>
                        </a>

                        <a href="#" 
                           class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors group">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">Ver Recibos</p>
                                <p class="text-sm text-gray-500">Descarga tus comprobantes</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- My Donations / Recent -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Mis Donaciones</h3>
                            <a href="{{ route('proyectos.index') }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                Donar de Nuevo
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($donations ?? [] as $donation)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-pink-500 rounded-lg flex items-center justify-center">
                                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr(optional($donation->project)->title ?? 'PR',0,2)) }}</span>
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-medium text-gray-900">{{ optional($donation->project)->title ?? 'Proyecto' }}</h4>
                                                    <p class="text-sm text-gray-500">Donado {{ $donation->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-600 mt-2 text-sm">{{ optional($donation->project)->short_description ?? '' }}</p>
                                            <div class="mt-4">
                                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                                    <span>S/{{ number_format($donation->amount,2) }} donado</span>
                                                    <span>{{ optional($donation->project)->status ?? 'Activo' }}</span>
                                                </div>
                                                <div class="bg-gray-200 rounded-full h-2">
                                                    @php
                                                        $progress = optional($donation->project)->meta ? intval((optional($donation->project)->recaudado ?? 0) / (optional($donation->project)->meta ?: 1) * 100) : 0;
                                                        $progress = max(0, min(100, $progress));
                                                    @endphp
                                                    <div class="bg-gradient-to-r from-indigo-500 to-pink-500 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-2 ml-4">
                                            <a href="{{ route('proyectos.show', optional($donation->project)->id) }}" class="text-gray-400 hover:text-gray-600">Ver</a>
                                            <a href="{{ route('donaciones.create', optional($donation->project)->id) }}" class="text-gray-400 hover:text-gray-600">Donar</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                                    </svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-900">No has realizado donaciones aún</h3>
                                    <p class="mt-1 text-gray-500">Explora proyectos y realiza tu primera contribución para empezar a generar impacto.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('proyectos.index') }}" 
                                           class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                            Explorar Proyectos
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actividad Reciente</h3>
                    <div class="space-y-4">
                        @foreach(collect($donations ?? [])->take(3) as $d)
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">Donación de S/{{ number_format($d->amount,2) }}</p>
                                    <p class="text-xs text-gray-500">Para "{{ optional($d->project)->title }}" - {{ $d->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tips & Resources -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Consejos para Donantes</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-medium text-blue-900 mb-2">💡 Sigue proyectos</h4>
                            <p class="text-sm text-blue-800">Sigue proyectos que te interesen para recibir actualizaciones y reportes.</p>
                        </div>

                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-medium text-green-900 mb-2">🔒 Revisa la información</h4>
                            <p class="text-sm text-green-800">Verifica la descripción y uso de fondos antes de donar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
