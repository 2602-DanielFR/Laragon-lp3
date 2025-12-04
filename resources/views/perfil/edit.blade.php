@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Editar Perfil
                </h2>
            </div>
        </div>

        @if(session('status'))
            <div class="rounded-md bg-green-50 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Información Personal</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Actualiza tu información pública y detalles de contacto.
                        </p>
                        <div class="mt-4 flex justify-center md:justify-start">
                             <img id="profilePreview" src="{{ old('foto_perfil', optional($profile)->foto_perfil) ? old('foto_perfil', optional($profile)->foto_perfil) : asset('images/profile-placeholder.png') }}" alt="Foto de perfil" class="h-32 w-32 object-cover rounded-lg border border-gray-200 shadow-sm">
                        </div>
                        <div class="mt-4 text-center md:text-left">
                             <a href="{{ route('perfil.show', $user->id) }}" class="text-sm font-medium text-principal hover:text-principal-dark">
                                Ver cómo ven otros tu perfil &rarr;
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="POST" action="{{ route('perfil.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name" class="mt-1 focus:ring-principal focus:border-principal block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="foto_perfil" class="block text-sm font-medium text-gray-700">URL de Foto de Perfil</label>
                                        <input type="text" name="foto_perfil" id="foto_perfil" value="{{ old('foto_perfil', optional($profile)->foto_perfil) }}" class="mt-1 focus:ring-principal focus:border-principal block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-2 text-sm text-gray-500">Pega la URL directa de tu imagen.</p>
                                        @error('foto_perfil') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="biografia_breve" class="block text-sm font-medium text-gray-700">Biografía Breve</label>
                                        <div class="mt-1">
                                            <textarea id="biografia_breve" name="biografia_breve" rows="3" class="shadow-sm focus:ring-principal focus:border-principal mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('biografia_breve', optional($profile)->biografia_breve) }}</textarea>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">Cuéntanos un poco sobre ti.</p>
                                        @error('biografia_breve') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="enlaces_redes" class="block text-sm font-medium text-gray-700">Enlaces de Redes (JSON Array)</label>
                                        <input type="text" name="enlaces_redes" id="enlaces_redes" value="{{ old('enlaces_redes', optional($profile)->enlaces_redes ? json_encode(optional($profile)->enlaces_redes) : '') }}" class="mt-1 focus:ring-principal focus:border-principal block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-2 text-sm text-gray-500">Ejemplo: ["https://twitter.com/usuario", "https://linkedin.com/in/usuario"]</p>
                                        @error('enlaces_redes') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Role Specific Fields --}}
                                    @if($user->role === 'Donante')
                                        <div class="col-span-6">
                                            <h4 class="text-md font-medium text-gray-900 mt-4 mb-2 border-b pb-2">Datos de Donante</h4>
                                        </div>
                                        
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', optional($profile)->telefono) }}" class="mt-1 focus:ring-principal focus:border-principal block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('telefono') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                        </div>

                                        <div class="col-span-6">
                                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', optional($profile)->direccion) }}" class="mt-1 focus:ring-principal focus:border-principal block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('direccion') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                        </div>

                                    @elseif($user->role === 'Emprendedor')
                                        <div class="col-span-6">
                                            <h4 class="text-md font-medium text-gray-900 mt-4 mb-2 border-b pb-2">Datos de Emprendedor</h4>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="organizacion" class="block text-sm font-medium text-gray-700">Organización / Empresa</label>
                                            <input type="text" name="organizacion" id="organizacion" value="{{ old('organizacion', optional($profile)->organizacion) }}" class="mt-1 focus:ring-principal focus:border-principal block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('organizacion') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                        </div>

                                        <div class="col-span-6">
                                            <label for="descripcion_personal" class="block text-sm font-medium text-gray-700">Descripción Personal / Misión</label>
                                            <div class="mt-1">
                                                <textarea id="descripcion_personal" name="descripcion_personal" rows="4" class="shadow-sm focus:ring-principal focus:border-principal mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('descripcion_personal', optional($profile)->descripcion_personal) }}</textarea>
                                            </div>
                                            @error('descripcion_personal') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-principal hover:bg-principal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('foto_perfil');
        var preview = document.getElementById('profilePreview');
        if (!input || !preview) return;
        input.addEventListener('input', function () {
            var val = input.value.trim();
            if (val) {
                preview.src = val;
            } else {
                preview.src = '{{ asset('images/profile-placeholder.png') }}';
            }
        });
    });
</script>
@endpush

