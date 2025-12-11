@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Usuarios
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar Usuario: {{ $user->name }}</h1>
            <p class="mt-2 text-sm text-gray-600">Modifica la información y el rol de este usuario</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Nombre completo">
                    @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full px-4 py-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none cursor-not-allowed"
                           readonly>
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rol -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Rol <span class="text-red-500">*</span>
                    </label>
                    <select name="role" id="role" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-500 @enderror"
                            required>
                        @foreach($roles as $role)
                        <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                        @endforeach
                    </select>
                    @error('role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection