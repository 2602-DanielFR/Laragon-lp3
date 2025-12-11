@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Encabezado -->
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Crear Nuevo Proyecto</h1>
        <p class="text-gray-600">Comparte tu iniciativa y genera impacto junto a nuestra comunidad</p>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-100">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                <h4 class="font-bold mb-2">Por favor corrige los siguientes errores:</h4>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proyectos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Sección 1: Información Básica -->
            <div class="mb-8 pb-8 border-b border-gray-200">
                <h3 class="text-xl font-bold text-secundario mb-6 flex items-center">
                    <span class="bg-principal-100 text-principal w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                    Información Básica
                </h3>

                <!-- Título -->
                <div class="mb-6">
                    <label for="titulo" class="block text-sm font-semibold text-gray-700 mb-2">Título del Proyecto <span class="text-red-500">*</span></label>
                    <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-principal focus:border-principal transition-colors @error('titulo') border-red-500 @enderror"
                        placeholder="Ej: Reforestación del Bosque Amazónico"
                        required>
                    @error('titulo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Descripción Corta -->
                <div class="mb-6">
                    <label for="descripcion_corta" class="block text-sm font-semibold text-gray-700 mb-2">Descripción Breve (Máx. 500 caracteres) <span class="text-red-500">*</span></label>
                    <textarea id="descripcion_corta" name="descripcion_corta" rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-principal focus:border-principal transition-colors @error('descripcion_corta') border-red-500 @enderror"
                        placeholder="Un resumen atractivo de tu proyecto que aparecerá en la lista"
                        maxlength="500"
                        required>{{ old('descripcion_corta') }}</textarea>
                    @error('descripcion_corta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-gray-500 text-xs mt-1">Este texto aparecerá en la tarjeta del proyecto</p>
                </div>

                <!-- Categoría -->
                <div class="mb-6">
                    <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-2">Categoría <span class="text-red-500">*</span></label>
                    <select id="categoria_id" name="categoria_id"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-principal focus:border-principal transition-colors bg-white @error('categoria_id') border-red-500 @enderror"
                        required>
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Sección 2: Descripción Detallada -->
            <div class="mb-8 pb-8 border-b border-gray-200">
                <h3 class="text-xl font-bold text-secundario mb-6 flex items-center">
                    <span class="bg-principal-100 text-principal w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                    Descripción Detallada
                </h3>

                <div class="mb-6">
                    <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">Descripción Completa del Proyecto (Mínimo 50 caracteres) <span class="text-red-500">*</span></label>
                    <textarea id="descripcion" name="descripcion" rows="10"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-principal focus:border-principal transition-colors @error('descripcion') border-red-500 @enderror"
                        placeholder="Describe detalladamente:&#10;1. El problema que abordas&#10;2. Tu solución propuesta&#10;3. Cómo usarás los fondos&#10;4. Impacto esperado"
                        required>{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-gray-500 text-xs mt-1">Sé claro y detallado. Los donantes querrán entender exactamente qué harás con su dinero.</p>
                </div>
            </div>

            <!-- Sección 3: Metas Financieras -->
            <div class="mb-8 pb-8 border-b border-gray-200">
                <h3 class="text-xl font-bold text-secundario mb-6 flex items-center">
                    <span class="bg-principal-100 text-principal w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                    Metas Financieras
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Meta de Recaudación -->
                    <div>
                        <label for="objetivo_recaudacion" class="block text-sm font-semibold text-gray-700 mb-2">Meta de Recaudación (S/) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-500 font-semibold">S/</span>
                            <input type="number" id="objetivo_recaudacion" name="objetivo_recaudacion" value="{{ old('objetivo_recaudacion') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-principal focus:border-principal transition-colors @error('objetivo_recaudacion') border-red-500 @enderror"
                                placeholder="0.00"
                                min="100"
                                step="0.01"
                                required>
                        </div>
                        @error('objetivo_recaudacion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p class="text-gray-500 text-xs mt-1">Mínimo: S/ 100</p>
                    </div>

                    <!-- Fecha Final -->
                    <div>
                        <label for="fecha_fin" class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Término <span class="text-red-500">*</span></label>
                        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-principal focus:border-principal transition-colors @error('fecha_fin') border-red-500 @enderror"
                            required>
                        @error('fecha_fin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p class="text-gray-500 text-xs mt-1">Debe ser posterior a hoy</p>
                    </div>
                </div>
            </div>

            <!-- Sección 4: Imágenes -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-secundario mb-6 flex items-center">
                    <span class="bg-principal-100 text-principal w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">4</span>
                    Imágenes
                </h3>

                <!-- Imagen Principal -->
                <div class="mb-6">
                    <label for="imagen" class="block text-sm font-semibold text-gray-700 mb-2">Imagen Principal</label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-principal hover:bg-principal-50 transition-colors group"
                        ondrop="handleDrop(event, 'imagen')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden" onchange="previewImage(this, 'imagenPreview')">
                        <label for="imagen" class="cursor-pointer w-full h-full block">
                            <div class="text-gray-400 group-hover:text-principal transition-colors mb-2">
                                <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            </div>
                            <p class="text-gray-600 font-medium group-hover:text-principal">Haz clic para subir o arrastra tu imagen aquí</p>
                            <p class="text-gray-400 text-xs mt-1">Formatos: JPEG, PNG, GIF (Máx: 2MB)</p>
                        </label>
                    </div>
                    <div id="imagenPreview" class="mt-4 hidden relative rounded-lg overflow-hidden border border-gray-200 shadow-sm w-fit">
                        <img id="imagenPreviewImg" src="" alt="Preview" class="max-h-48 object-cover">
                    </div>
                    @error('imagen') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Imagen Banner -->
                <div class="mb-6">
                    <label for="imagen_banner" class="block text-sm font-semibold text-gray-700 mb-2">Imagen Banner (Encabezado)</label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-principal hover:bg-principal-50 transition-colors group"
                        ondrop="handleDrop(event, 'imagen_banner')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                        <input type="file" id="imagen_banner" name="imagen_banner" accept="image/*" class="hidden" onchange="previewImage(this, 'bannerPreview')">
                        <label for="imagen_banner" class="cursor-pointer w-full h-full block">
                            <div class="text-gray-400 group-hover:text-principal transition-colors mb-2">
                                <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-gray-600 font-medium group-hover:text-principal">Haz clic para subir o arrastra tu imagen aquí</p>
                            <p class="text-gray-400 text-xs mt-1">Recomendado: 1920x600px - Formatos: JPEG, PNG, GIF</p>
                        </label>
                    </div>
                    <div id="bannerPreview" class="mt-4 hidden relative rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                        <img id="bannerPreviewImg" src="" alt="Preview" class="w-full max-h-64 object-cover">
                    </div>
                    @error('imagen_banner') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('emprendedor.dashboard') }}"
                    class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit" name="save_draft" value="1"
                    class="px-6 py-2.5 rounded-lg bg-gray-500 hover:bg-gray-600 text-white font-semibold transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Guardar Borrador
                </button>
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-principal hover:bg-principal-dark text-white font-semibold transition-colors flex items-center shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    Enviar a Revisión
                </button>
            </div>
        </form>
    </div>

    <!-- Ayuda -->
    <div class="bg-blue-50 border border-blue-100 rounded-lg p-6 mt-8">
        <h4 class="text-blue-800 font-bold mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Consejos para un proyecto exitoso:
        </h4>
        <ul class="text-blue-700 text-sm space-y-2 list-disc list-inside ml-1">
            <li>Elige un título <strong>atractivo y descriptivo</strong>.</li>
            <li>Sé <strong>claro y honesto</strong> sobre el problema y tu solución.</li>
            <li>Define una meta <strong>realista y justificada</strong>.</li>
            <li>Usa imágenes de <strong>alta calidad</strong> que muestren tu proyecto.</li>
            <li>Explica detalladamente el <strong>uso de los fondos</strong>.</li>
        </ul>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            const img = document.getElementById(previewId + 'Img');
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function handleDrop(event, inputId) {
    event.preventDefault();
    event.stopPropagation();
    const files = event.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById(inputId).files = files;
        previewImage(document.getElementById(inputId), inputId + 'Preview');
    }
}
</script>
@endsection
