@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.categorias.index') }}" 
               class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Categorías
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar Categoría</h1>
            <p class="mt-2 text-sm text-gray-600">Modifica los datos de la categoría</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Categoría <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nombre" 
                           id="nombre" 
                           value="{{ old('nombre', $categoria->nombre) }}"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('nombre') border-red-500 @enderror"
                           placeholder="Ej: Tecnología, Educación, Salud...">
                    @error('nombre')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea name="descripcion" 
                              id="descripcion" 
                              rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('descripcion') border-red-500 @enderror"
                              placeholder="Describe brevemente esta categoría...">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    @error('descripcion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">Máximo 1000 caracteres</p>
                </div>

                <!-- Info sobre proyectos asociados -->
                @if($categoria->proyectos()->count() > 0)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-yellow-800">
                                Esta categoría tiene {{ $categoria->proyectos()->count() }} proyecto(s) asociado(s)
                            </p>
                            <p class="mt-1 text-sm text-yellow-700">
                                Los cambios afectarán a todos los proyectos de esta categoría.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.categorias.index') }}" 
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

        <!-- Metadata -->
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-medium text-gray-900 mb-4">Información de la Categoría</h3>
            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Fecha de creación</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $categoria->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Última actualización</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $categoria->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Proyectos asociados</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $categoria->proyectos()->count() }} proyectos</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
