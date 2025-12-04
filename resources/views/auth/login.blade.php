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
                <p class="text-gray-200 text-sm">Accede con tu cuenta para continuar</p>
            </div>

            <!-- Formulario -->
            <div class="p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-principal focus:ring-2 focus:ring-principal focus:ring-opacity-20 transition-all @error('email') border-red-500 @enderror"
                                   placeholder="nombre@ejemplo.com">
                        </div>
                        @error('email')
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.27-1.27l-2.903 2.903a.997.997 0 11-1.414-1.414l2.903-2.903a1 1 0 10-1.414-1.414l-2.903 2.903a.997.997 0 111.414 1.414l2.903-2.903a1 1 0 11-1.27 1.27z"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

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
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-principal focus:ring-2 focus:ring-principal focus:ring-opacity-20 transition-all @error('password') border-red-500 @enderror"
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.27-1.27l-2.903 2.903a.997.997 0 11-1.414-1.414l2.903-2.903a1 1 0 10-1.414-1.414l-2.903 2.903a.997.997 0 111.414 1.414l2.903-2.903a1 1 0 11-1.27 1.27z"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}
                               class="h-4 w-4 text-principal bg-white border-gray-300 rounded focus:ring-principal cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                            Recuérdame en este dispositivo
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-principal to-orange-600 hover:from-orange-600 hover:to-principal text-white font-bold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Iniciar Sesión
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

                <!-- Divider -->
                <div class="relative mt-8 mb-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-600">¿No tienes cuenta?</span>
                    </div>
                </div>

                <!-- Register Link -->
                <a href="{{ route('register') }}" 
                   class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 rounded-lg transition-colors">
                    Crear una nueva cuenta
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
