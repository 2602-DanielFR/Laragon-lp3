@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8 border border-gray-100">
            <div class="h-40 bg-gradient-to-r from-secundario to-principal"></div>
            <div class="px-6 py-6 sm:px-8 relative">
                <div class="-mt-20 flex flex-col sm:flex-row items-center sm:items-end mb-6">
                    <img class="h-36 w-36 rounded-full ring-4 ring-white object-cover bg-white shadow-md mb-4 sm:mb-0 sm:mr-6" 
                         src="{{ optional($profile)->foto_perfil ? asset('storage/' . $profile->foto_perfil) : asset('images/profile-placeholder.png') }}" 
                         alt="{{ $user->name }}">
                    
                    <div class="text-center sm:text-left flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ $user->name }}</h1>
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 text-sm text-gray-600">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $user->role === 'Donante' ? 'bg-green-100 text-green-800' : ($user->role === 'Emprendedor' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                {{ $user->role ?? 'Usuario' }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Miembro desde {{ $user->created_at->format('d M, Y') }}
                            </span>
                        </div>
                    </div>

                    @if(Auth::id() === $user->id)
                    <div class="mt-6 sm:mt-0">
                        <a href="{{ route('perfil.edit') }}" class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal transition-colors">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Editar Perfil
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Left Column: About & Role Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Bio -->
                <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-secundario mb-4 pb-2 border-b border-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Sobre mí
                    </h3>
                    <div class="prose prose-blue text-gray-600 leading-relaxed">
                        <p>{{ optional($profile)->biografia_breve ?? 'Este usuario no ha añadido una biografía aún.' }}</p>
                    </div>
                </div>

                <!-- Role Specific Details -->
                @if($user->role === 'Emprendedor')
                <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-secundario mb-4 pb-2 border-b border-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-6 0H3m0 0h6m6 0v-6m0 6v6"></path></svg>
                        Detalles de Emprendedor
                    </h3>
                    <dl class="grid grid-cols-1 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Organización / Empresa</dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ optional($profile)->organizacion ?? 'No especificado' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Misión / Descripción Personal</dt>
                            <dd class="mt-1 text-base text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-100">{{ optional($profile)->descripcion_personal ?? 'No especificado' }}</dd>
                        </div>
                    </dl>
                </div>
                @elseif($user->role === 'Donante')
                <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-secundario mb-4 pb-2 border-b border-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Información de Donante
                    </h3>
                    <dl class="grid grid-cols-1 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Ubicación</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ optional($profile)->direccion ?? 'No especificado' }}</dd>
                        </div>
                        @if(Auth::id() === $user->id)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Teléfono (Privado)</dt>
                            <dd class="mt-1 text-lg text-gray-900 font-mono bg-gray-50 inline-block px-2 py-1 rounded">{{ optional($profile)->telefono ?? 'No especificado' }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
                @endif
            </div>

            <!-- Right Column: Contact & Social -->
            <div class="space-y-8">
                <!-- Contact Info -->
                <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
                    <h3 class="text-lg font-bold text-secundario mb-4 pb-2 border-b border-gray-100">Conectar</h3>
                    
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-500 mb-1">Email de contacto</p>
                        <a href="mailto:{{ $user->email }}" class="flex items-center text-principal hover:text-principal-dark transition-colors font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $user->email }}
                        </a>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-3">Redes Sociales</p>
                        @if($user->socialLinks->count() > 0)
                            <div class="flex flex-col space-y-3">
                                @foreach($user->socialLinks as $link)
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="flex items-center p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-principal transition-all group">
                                        <div class="bg-gray-100 p-2 rounded-full mr-3 group-hover:bg-principal-100 transition-colors">
                                            <svg class="h-5 w-5 group-hover:text-principal" fill="currentColor" viewBox="0 0 24 24">
                                                @if(strtolower($link->platform) == 'twitter')
                                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                                @elseif(strtolower($link->platform) == 'facebook')
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                @elseif(strtolower($link->platform) == 'linkedin')
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                @elseif(strtolower($link->platform) == 'instagram')
                                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                                @elseif(strtolower($link->platform) == 'github')
                                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                                @elseif(strtolower($link->platform) == 'youtube')
                                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                @else
                                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.492 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                                @endif
                                            </svg>
                                            <span class="font-medium">{{ $link->platform }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">No hay enlaces de redes sociales.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection