@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <!-- Card Principal -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header con gradiente -->
            <div class="bg-gradient-to-r from-secundario to-blue-900 px-6 py-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="h-14 w-14 bg-white rounded-lg flex items-center justify-center">
                        <svg class="h-8 w-8 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">{{ config('app.name') }}</h1>
                <p class="text-gray-200 text-sm">Confirma tu contraseña para continuar</p>
            </div>

            <!-- Contenido -->
            <div class="p-8">
                <p class="text-gray-600 text-sm mb-6">
                    Por seguridad, confirma tu contraseña antes de continuar con esta acción sensible.
                </p>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   required
                                   autocomplete="current-password"
                                   autofocus
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-principal focus:ring-2 focus:ring-principal focus:ring-opacity-20 transition-all @error('password') border-red-500 @enderror"
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-principal to-orange-600 hover:from-orange-600 hover:to-principal text-white font-bold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Confirmar Contraseña
                        </div>
                    </button>
                </form>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                <div class="mt-6 text-center">
                    <a href="{{ route('password.request') }}" 
                       class="text-sm font-medium text-principal hover:text-orange-600 transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
