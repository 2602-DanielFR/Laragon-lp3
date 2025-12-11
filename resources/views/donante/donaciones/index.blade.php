@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-principal">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Mis Donaciones</h1>
                        <p class="mt-1 text-gray-600">Historial de tu impacto positivo en la comunidad.</p>
                    </div>
                    <div class="hidden sm:block">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Total Donado: S/ {{ number_format($donations->sum('monto'), 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            @if($donations->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($donations as $donacion)
                        <li>
                            <div class="block hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-principal truncate">
                                            {{ $donacion->proyecto->titulo }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Completada
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                </svg>
                                                S/ {{ number_format($donacion->monto, 2) }}
                                            </p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                                </svg>
                                                Ref: {{ $donacion->referencia }}
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p>
                                                {{ $donacion->created_at->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('proyectos.show', $donacion->proyecto_id) }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                            Ver Proyecto &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $donations->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes donaciones</h3>
                    <p class="mt-1 text-sm text-gray-500">¡Apoya tu primer proyecto hoy mismo!</p>
                    <div class="mt-6">
                        <a href="{{ route('proyectos.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-principal hover:bg-principal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Explorar Proyectos
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection