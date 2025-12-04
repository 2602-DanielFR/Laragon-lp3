@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <!-- Card Principal -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header con gradiente -->
            <div class="bg-gradient-to-r from-principal to-orange-600 px-6 py-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="h-14 w-14 bg-white rounded-lg flex items-center justify-center">
                        <svg class="h-8 w-8 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">{{ config('app.name') }}</h1>
                <p class="text-orange-100 text-sm">Verifica tu correo electrónico</p>
            </div>

            <!-- Contenido -->
            <div class="p-8">
                @if (session('resent'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <div class="flex">
                        <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-green-700 font-medium text-sm">¡Hemos reenviado el enlace!</p>
                            <p class="text-green-600 text-xs mt-1">Se ha enviado un nuevo enlace de verificación a tu correo.</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Icon -->
                <div class="text-center mb-6">
                    <svg class="h-16 w-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Verifica tu correo electrónico</h3>
                <p class="text-gray-600 text-sm text-center mb-6">
                    Hemos enviado un enlace de verificación a tu dirección de correo. 
                    Por favor, haz clic en el enlace para activar tu cuenta.
                </p>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
                    <p class="text-sm text-blue-900">
                        <span class="font-semibold">📧 Pasos:</span>
                    </p>
                    <ol class="mt-2 text-sm text-blue-800 space-y-1 ml-4 list-decimal">
                        <li>Abre tu correo electrónico</li>
                        <li>Busca el email de {{ config('app.name') }}</li>
                        <li>Haz clic en el enlace de verificación</li>
                        <li>¡Tu cuenta estará lista para usar!</li>
                    </ol>
                </div>

                <p class="text-gray-600 text-sm text-center mb-6">
                    ¿No recibiste el correo?
                </p>

                <!-- Resend Form -->
                <form method="POST" action="{{ route('verification.resend') }}" class="mb-4">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-principal to-orange-600 hover:from-orange-600 hover:to-principal text-white font-bold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reenviar Correo de Verificación
                        </div>
                    </button>
                </form>

                <!-- Back to Login -->
                <a href="{{ route('login') }}" 
                   class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 rounded-lg transition-colors">
                    Volver a Iniciar Sesión
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
