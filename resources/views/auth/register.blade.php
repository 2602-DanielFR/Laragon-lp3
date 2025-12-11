@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <!-- Card Principal -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header con gradiente -->
            <div class="bg-gradient-to-r from-principal to-orange-600 px-6 py-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="h-14 w-14 bg-white rounded-lg flex items-center justify-center">
                        <svg class="h-8 w-8 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">{{ config('app.name') }}</h1>
                <p class="text-orange-100 text-sm">Crea una cuenta para empezar</p>
            </div>

            <!-- Formulario -->
            <div class="p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre Completo
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name') }}"
                                   required
                                   autocomplete="name"
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-principal focus:ring-2 focus:ring-principal focus:ring-opacity-20 transition-all @error('name') border-red-500 @enderror"
                                   placeholder="Tu nombre completo">
                        </div>
                        @error('name')
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.27-1.27l-2.903 2.903a.997.997 0 11-1.414-1.414l2.903-2.903a1 1 0 10-1.414-1.414l-2.903 2.903a.997.997 0 111.414 1.414l2.903-2.903a1 1 0 11-1.27 1.27z"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

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
                                   autocomplete="new-password"
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-principal focus:ring-2 focus:ring-principal focus:ring-opacity-20 transition-all @error('password') border-red-500 @enderror"
                                   placeholder="Mínimo 8 caracteres">
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

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password-confirm" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password-confirm"
                                   required
                                   autocomplete="new-password"
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-principal focus:ring-2 focus:ring-principal focus:ring-opacity-20 transition-all"
                                   placeholder="Repite tu contraseña">
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            ¿Cuál es tu rol?
                        </label>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 border-2 border-gray-200 rounded-lg hover:border-principal hover:bg-principal hover:bg-opacity-5 transition-all cursor-pointer" 
                                 onclick="document.getElementById('role_donante').checked = true">
                                <input type="radio" 
                                       id="role_donante"
                                       name="role" 
                                       value="Donante"
                                       {{ old('role') == 'Donante' ? 'checked' : '' }}
                                       class="h-4 w-4 text-principal">
                                <div class="ml-3 flex-1">
                                    <label for="role_donante" class="font-medium text-gray-900 cursor-pointer">
                                        Donante
                                    </label>
                                    <p class="text-xs text-gray-600">Financia proyectos que te interesan</p>
                                </div>
                                <svg class="h-5 w-5 text-principal opacity-0" id="icon_donante" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>

                            <div class="flex items-center p-3 border-2 border-gray-200 rounded-lg hover:border-principal hover:bg-principal hover:bg-opacity-5 transition-all cursor-pointer"
                                 onclick="document.getElementById('role_emprendedor').checked = true">
                                <input type="radio" 
                                       id="role_emprendedor"
                                       name="role" 
                                       value="Emprendedor"
                                       {{ old('role') == 'Emprendedor' ? 'checked' : '' }}
                                       class="h-4 w-4 text-principal">
                                <div class="ml-3 flex-1">
                                    <label for="role_emprendedor" class="font-medium text-gray-900 cursor-pointer">
                                        Emprendedor
                                    </label>
                                    <p class="text-xs text-gray-600">Publica proyectos para obtener financiamiento</p>
                                </div>
                                <svg class="h-5 w-5 text-principal opacity-0" id="icon_emprendedor" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @error('role')
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.27-1.27l-2.903 2.903a.997.997 0 11-1.414-1.414l2.903-2.903a1 1 0 10-1.414-1.414l-2.903 2.903a.997.997 0 111.414 1.414l2.903-2.903a1 1 0 11-1.27 1.27z"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @error('terms')
                    <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.27-1.27l-2.903 2.903a.997.997 0 11-1.414-1.414l2.903-2.903a1 1 0 10-1.414-1.414l-2.903 2.903a.997.997 0 111.414 1.414l2.903-2.903a1 1 0 11-1.27 1.27z"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-principal to-orange-600 hover:from-orange-600 hover:to-principal text-white font-bold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl mt-6">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Crear Cuenta
                        </div>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative mt-6 mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-600">¿Ya tienes cuenta?</span>
                    </div>
                </div>

                <!-- Login Link -->
                <a href="{{ route('login') }}" 
                   class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 rounded-lg transition-colors">
                    Inicia Sesión Aquí
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Script para actualizar los iconos del rol -->
<script>
    const rolInputs = document.querySelectorAll('input[name="role"]');
    
    rolInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Remover opacidad de todos los iconos
            document.getElementById('icon_donante').classList.add('opacity-0');
            document.getElementById('icon_emprendedor').classList.add('opacity-0');
            
            // Agregar opacidad al icono seleccionado
            if (this.value === 'donante') {
                document.getElementById('icon_donante').classList.remove('opacity-0');
            } else if (this.value === 'emprendedor') {
                document.getElementById('icon_emprendedor').classList.remove('opacity-0');
            }
        });
    });

    // Ejecutar al cargar si hay un rol seleccionado
    window.addEventListener('load', function() {
        const selectedRole = document.querySelector('input[name="role"]:checked');
        if (selectedRole) {
            selectedRole.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection