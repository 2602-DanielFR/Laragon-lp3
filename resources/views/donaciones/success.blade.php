@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">¡Donación Exitosa!</h2>
            
            <p class="text-lg text-gray-600 mb-2">
                Has aportado <span class="font-bold text-green-600">S/ {{ number_format($donacion->monto, 2) }}</span>
            </p>
            
            <p class="text-gray-500 mb-8">
                al proyecto <span class="font-semibold text-gray-800">"{{ $donacion->proyecto->titulo }}"</span>
            </p>

            <div class="bg-gray-50 rounded-lg p-4 mb-8 text-left">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Detalles de la transacción</h4>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-xs font-medium text-gray-500">Referencia</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $donacion->referencia }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-xs font-medium text-gray-500">Fecha</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $donacion->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="space-y-3">
                <a href="{{ route('donante.donaciones.index') }}" 
                   class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-principal hover:bg-principal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal transition-colors">
                    Ver mi Historial
                </a>
                
                <a href="{{ route('proyectos.index') }}" 
                   class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Volver a Proyectos
                </a>
            </div>
        </div>
    </div>
</div>
@endsection