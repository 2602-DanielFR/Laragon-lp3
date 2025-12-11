@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-3xl font-bold text-gray-900">Editar Perfil</h1>
            <p class="mt-2 text-gray-600">Actualiza tu información personal y pública.</p>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-md bg-green-50 p-4 border-l-4 border-green-500 shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <!-- Sidebar: Profile Picture Preview -->
                <div class="md:col-span-1 bg-gray-50 p-6 border-r border-gray-100">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tu Foto</h3>
                    <div class="flex flex-col items-center">
                        <div class="relative group">
                            <img id="profilePreview"
                                src="{{ optional($profile)->foto_perfil ? asset('storage/' . $profile->foto_perfil) : asset('images/profile-placeholder.png') }}"
                                alt="Foto de perfil"
                                class="h-40 w-40 object-cover rounded-full border-4 border-white shadow-md group-hover:opacity-75 transition-opacity">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">Vista
                                    Previa</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-center text-gray-500">
                            Esta foto será visible para todos los usuarios.
                        </p>
                    </div>
                </div>

                <!-- Main Form -->
                <div class="md:col-span-2 p-6 md:p-8">
                    <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Personal Info Section -->
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">Información
                                Básica</h3>
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre
                                        Completo</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3 bg-gray-50 text-gray-500 cursor-not-allowed"
                                        readonly>
                                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700">Cambiar Foto</label>
                                    <div class="mt-1 flex items-center">
                                        <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-principal-100 file:text-principal
                                            hover:file:bg-principal-200
                                            cursor-pointer focus:outline-none">
                                    </div>
                                    @error('foto_perfil') <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="biografia_breve"
                                        class="block text-sm font-medium text-gray-700">Biografía Breve</label>
                                    <textarea id="biografia_breve" name="biografia_breve" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm p-3"
                                        placeholder="Cuéntanos un poco sobre ti...">{{ old('biografia_breve', optional($profile)->biografia_breve) }}</textarea>
                                    @error('biografia_breve') <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Role Specific Section -->
                        @if($user->isDonante() || $user->isEmprendedor())
                        <div class="pt-4">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">
                                {{ $user->isDonante() ? 'Datos de Donante' : 'Datos de Emprendedor' }}
                            </h3>
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                @if($user->isDonante())
                                <div class="sm:col-span-3">
                                    <label for="telefono"
                                        class="block text-sm font-medium text-gray-700">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono"
                                        value="{{ old('telefono', optional($profile)->telefono) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="direccion"
                                        class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <input type="text" name="direccion" id="direccion"
                                        value="{{ old('direccion', optional($profile)->direccion) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                                </div>
                                @elseif($user->isEmprendedor())
                                <div class="sm:col-span-6">
                                    <label for="organizacion"
                                        class="block text-sm font-medium text-gray-700">Organización / Empresa</label>
                                    <input type="text" name="organizacion" id="organizacion"
                                        value="{{ old('organizacion', optional($profile)->organizacion) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="descripcion_personal"
                                        class="block text-sm font-medium text-gray-700">Misión / Visión</label>
                                    <textarea id="descripcion_personal" name="descripcion_personal" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm p-3">{{ old('descripcion_personal', optional($profile)->descripcion_personal) }}</textarea>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Social Links Section -->
                        <div class="pt-4">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">Redes Sociales
                            </h3>

                            <div id="social-links-container" class="space-y-3">
                                @foreach($user->socialLinks as $index => $link)
                                <div class="flex items-center gap-3 social-link-row p-3 bg-gray-50 rounded-lg border border-gray-200"
                                    id="link-row-{{ $index }}">
                                    <div class="w-1/3">
                                        <select name="social_links[{{ $index }}][platform]"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                                            @foreach(['Web', 'Twitter', 'Facebook', 'LinkedIn', 'Instagram', 'GitHub',
                                            'YouTube'] as $platform)
                                            <option value="{{ $platform }}" {{ $link->platform == $platform ? 'selected'
                                                : '' }}>{{ $platform }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <input type="url" name="social_links[{{ $index }}][url]"
                                            value="{{ $link->url }}" placeholder="https://..."
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                                    </div>
                                    <button type="button" onclick="removeRow('link-row-{{ $index }}')"
                                        class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors"
                                        title="Eliminar">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <button type="button" onclick="addSocialLink()"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal transition-colors">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Agregar Red Social
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-200 flex justify-end">
                            <button type="submit"
                                class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-principal hover:bg-principal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal transition-transform transform hover:scale-105">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Image Preview
    document.getElementById('foto_perfil').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Dynamic Social Links
    let linkCount = {{ $user->socialLinks->count() }};

    function addSocialLink() {
        const container = document.getElementById('social-links-container');
        const index = linkCount++;
        const rowId = `link-row-${index}`;
        
        const html = `
            <div class="flex items-center gap-3 social-link-row p-3 bg-gray-50 rounded-lg border border-gray-200" id="${rowId}">
                <div class="w-1/3">
                    <select name="social_links[${index}][platform]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                        <option value="Web">Sitio Web</option>
                        <option value="Twitter">Twitter / X</option>
                        <option value="Facebook">Facebook</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="Instagram">Instagram</option>
                        <option value="GitHub">GitHub</option>
                        <option value="YouTube">YouTube</option>
                    </select>
                </div>
                <div class="flex-1">
                    <input type="url" name="social_links[${index}][url]" placeholder="https://..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-principal focus:ring-principal sm:text-sm py-2 px-3">
                </div>
                <button type="button" onclick="removeRow('${rowId}')" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors" title="Eliminar">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeRow(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            row.remove();
        }
    }
</script>
@endsection