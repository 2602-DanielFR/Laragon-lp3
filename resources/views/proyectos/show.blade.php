@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                        <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <a href="{{ route('proyectos.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Proyectos</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <span class="ml-4 text-sm font-medium text-gray-500 truncate max-w-xs">{{ $proyecto->titulo }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Project Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Project Hero -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="relative h-96">
                        @if($proyecto->imagen_banner)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $proyecto->imagen_banner) }}" alt="{{ $proyecto->titulo }}">
                        @elseif($proyecto->imagen)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}">
                        @else
                            <div class="w-full h-full bg-gradient-to-r from-gray-200 to-gray-300 flex items-center justify-center">
                                <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-gray-800 shadow-md">
                                {{ $proyecto->categoria->nombre }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">{{ $proyecto->titulo }}</h1>
                        <p class="text-lg text-gray-500 mb-6">{{ $proyecto->descripcion_corta }}</p>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-full bg-principal text-white flex items-center justify-center text-xl font-bold">
                                    {{ strtoupper(substr($proyecto->user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900">Organizado por {{ $proyecto->user->name }}</h3>
                                <p class="text-sm text-gray-500">
                                    @if($proyecto->user->emprendedor)
                                        {{ $proyecto->user->emprendedor->organizacion ?? 'Emprendedor Independiente' }}
                                    @else
                                        Emprendedor
                                    @endif
                                </p>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ route('perfil.show', $proyecto->user->id) }}" class="text-principal hover:text-principal-dark font-medium text-sm">
                                    Ver Perfil &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div x-data="{ activeTab: 'description' }">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="activeTab = 'description'" 
                                    :class="{'border-principal text-principal': activeTab === 'description', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'description'}"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Historia
                            </button>
                            <button @click="activeTab = 'updates'" 
                                    :class="{'border-principal text-principal': activeTab === 'updates', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'updates'}"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Actualizaciones
                                <span class="bg-gray-100 text-gray-900 ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                    {{ $actualizaciones->count() }}
                                </span>
                            </button>
                        </nav>
                    </div>

                    <!-- Description Tab -->
                    <div x-show="activeTab === 'description'" class="py-6">
                        <div class="prose prose-blue max-w-none text-gray-600">
                            {!! nl2br(e($proyecto->descripcion)) !!}
                        </div>
                    </div>

                    <!-- Updates Tab -->
                    <div x-show="activeTab === 'updates'" class="py-6" style="display: none;">
                        @if($actualizaciones->count() > 0)
                            <ul class="space-y-8">
                                @foreach($actualizaciones as $actualizacion)
                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <div class="h-8 w-8 rounded-full bg-principal flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1 py-0">
                                                    <div class="text-sm leading-8 text-gray-500">
                                                        <span class="mr-1.5 font-medium text-gray-900">{{ $actualizacion->titulo }}</span>
                                                        <span class="whitespace-nowrap">{{ $actualizacion->created_at->format('d M Y') }}</span>
                                                    </div>
                                                    <div class="mt-2 text-gray-700">
                                                        <p>{{ $actualizacion->contenido }}</p>
                                                        @if($actualizacion->imagen)
                                                            <img src="{{ asset('storage/' . $actualizacion->imagen) }}" alt="Update Image" class="mt-4 rounded-lg shadow-sm max-h-64">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-12">
                                <p class="text-gray-500">Aún no hay actualizaciones publicadas.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Donation Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-6">
                    <!-- Progress Card -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-principal">
                        <div class="p-6">
                            <div class="flex justify-between items-baseline mb-2">
                                <span class="text-3xl font-extrabold text-gray-900">S/ {{ number_format($proyecto->monto_actual, 2) }}</span>
                                <span class="text-sm font-medium text-gray-500">de S/ {{ number_format($proyecto->objetivo_recaudacion, 2) }}</span>
                            </div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                                <div class="bg-principal h-3 rounded-full transition-all duration-500 ease-out" 
                                     style="width: {{ $proyecto->porcentaje_alcanzado }}%"></div>
                            </div>
                            
                            <div class="flex justify-between text-sm font-medium text-gray-500 mb-6">
                                <span>{{ round($proyecto->porcentaje_alcanzado) }}% financiado</span>
                                <span>{{ $proyecto->diasRestantes() }} días restantes</span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <span class="block text-2xl font-bold text-gray-900">{{ $proyecto->contador_donantes }}</span>
                                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Donantes</span>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <span class="block text-2xl font-bold text-gray-900">{{ $proyecto->contador_donaciones }}</span>
                                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Donaciones</span>
                                </div>
                            </div>

                            @if($proyecto->puedeRecibirDonaciones())
                                <a href="{{ route('donaciones.create', $proyecto->id) }}" 
                                   class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-white bg-principal hover:bg-principal-dark md:py-4 md:text-xl md:px-10 transition-colors shadow-lg transform hover:-translate-y-0.5">
                                    Donar Ahora
                                </a>
                            @else
                                <button disabled class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-gray-500 bg-gray-200 cursor-not-allowed">
                                    Proyecto Finalizado
                                </button>
                            @endif
                        </div>
                        <div class="bg-gray-50 px-6 py-4">
                            <p class="text-xs text-gray-500 text-center">
                                Todas las donaciones están protegidas y van directamente al desarrollo del proyecto.
                            </p>
                        </div>
                    </div>

                    <!-- Share Card -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Comparte este proyecto</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="h-5 w-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                Twitter
                            </a>
                        </div>
                    </div>

                    @if(auth()->check() && auth()->id() === $proyecto->user_id)
                        @if(in_array($proyecto->estado, ['draft', 'pendiente_revision', 'rechazado']))
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                            <h4 class="text-sm font-bold text-yellow-800 mb-2">Administrar Proyecto</h4>
                            <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700">
                                Editar Información
                            </a>
                        </div>
                        @else
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <h4 class="text-sm font-bold text-gray-700 mb-2">Proyecto {{ $proyecto->getEstadoLegible() }}</h4>
                            <p class="text-xs text-gray-500">No se puede editar la información mientras el proyecto está en este estado.</p>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection