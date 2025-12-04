@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
            <div class="h-32 bg-gradient-to-r from-secundario to-principal"></div>
            <div class="px-4 py-5 sm:px-6 relative">
                <div class="-mt-16 sm:-mt-20 flex justify-center sm:justify-start mb-4">
                    <img class="h-32 w-32 rounded-full ring-4 ring-white object-cover bg-white" 
                         src="{{ optional($profile)->foto_perfil ?? asset('images/profile-placeholder.png') }}" 
                         alt="{{ $user->name }}">
                </div>
                <div class="text-center sm:text-left sm:flex sm:items-end sm:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <div class="mt-1 flex items-center justify-center sm:justify-start text-sm text-gray-500">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'Donante' ? 'bg-principal-100 text-principal-800' : ($user->role === 'Emprendedor' ? 'bg-secundario-100 text-secundario-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $user->role ?? 'Usuario' }}
                            </span>
                            <span class="mx-2">&middot;</span>
                            <span>Miembro desde {{ $user->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                    @if(Auth::id() === $user->id)
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('perfil.edit') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Editar Perfil
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Left Column: About & Contact -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Bio -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Sobre mí</h3>
                    <div class="prose prose-blue text-gray-600">
                        <p>{{ optional($profile)->biografia_breve ?? 'Este usuario no ha añadido una biografía aún.' }}</p>
                    </div>
                </div>

                <!-- Role Specific Details -->
                @if($user->role === 'Emprendedor')
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Detalles de Emprendedor</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Organización / Empresa</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ optional($profile)->organizacion ?? 'No especificado' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Misión / Descripción Personal</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ optional($profile)->descripcion_personal ?? 'No especificado' }}</dd>
                        </div>
                    </dl>
                </div>
                @elseif($user->role === 'Donante')
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Información de Donante</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Ubicación</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ optional($profile)->direccion ?? 'No especificado' }}</dd>
                        </div>
                        <!-- Only show phone to owner or admin potentially, usually private -->
                        @if(Auth::id() === $user->id)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Teléfono (Privado)</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ optional($profile)->telefono ?? 'No especificado' }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
                @endif
            </div>

            <!-- Right Column: Social & Stats -->
            <div class="space-y-6">
                <!-- Contact/Social -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Conectar</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <a href="mailto:{{ $user->email }}" class="text-sm text-principal hover:underline">{{ $user->email }}</a>
                        </div>
                        
                        @if(optional($profile)->enlaces_redes)
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Redes Sociales</p>
                                <div class="flex flex-col space-y-2">
                                    @foreach(optional($profile)->enlaces_redes as $link)
                                        <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="flex items-center text-sm text-gray-600 hover:text-principal transition-colors">
                                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.492 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                            </svg>
                                            {{ parse_url($link, PHP_URL_HOST) ?? 'Enlace' }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Stats Placeholder (optional) -->
                <!--
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Estadísticas</h3>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-secundario">12</div>
                            <div class="text-xs text-gray-500">Proyectos</div>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-principal">85%</div>
                            <div class="text-xs text-gray-500">Éxito</div>
                        </div>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
@endsection
