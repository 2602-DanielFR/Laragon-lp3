@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Editar Proyecto</h1>
        <p class="text-gray-300">Actualiza la información de tu proyecto</p>
    </div>

    <!-- Formulario -->
    <div class="bg-gray-800 rounded-lg p-8">
        @if ($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded-lg mb-6">
                <h4 class="font-bold mb-2">Errores en el formulario:</h4>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Sección 1: Información Básica -->
            <div class="mb-8 pb-8 border-b border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-6">Información Básica</h3>

                <!-- Título -->
                <div class="mb-6">
                    <label for="titulo" class="block text-sm font-semibold text-gray-300 mb-2">Título del Proyecto *</label>
                    <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $proyecto->titulo) }}"
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('titulo') border-red-500 @enderror"
                        placeholder="Ej: Reforestación del Bosque Amazónico"
                        required>
                    @error('titulo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Descripción Corta -->
                <div class="mb-6">
                    <label for="descripcion_corta" class="block text-sm font-semibold text-gray-300 mb-2">Descripción Breve (Máx. 500 caracteres) *</label>
                    <textarea id="descripcion_corta" name="descripcion_corta" rows="3"
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('descripcion_corta') border-red-500 @enderror"
                        placeholder="Un resumen atractivo de tu proyecto que aparecerá en la lista"
                        maxlength="500"
                        required>{{ old('descripcion_corta', $proyecto->descripcion_corta) }}</textarea>
                    @error('descripcion_corta') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    <p class="text-gray-400 text-sm mt-1">Este texto aparecerá en la tarjeta del proyecto</p>
                </div>

                <!-- Categoría -->
                <div class="mb-6">
                    <label for="categoria_id" class="block text-sm font-semibold text-gray-300 mb-2">Categoría *</label>
                    <select id="categoria_id" name="categoria_id"
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 @error('categoria_id') border-red-500 @enderror"
                        required>
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $proyecto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Sección 2: Descripción Detallada -->
            <div class="mb-8 pb-8 border-b border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-6">Descripción Detallada</h3>

                <div class="mb-6">
                    <label for="descripcion" class="block text-sm font-semibold text-gray-300 mb-2">Descripción Completa del Proyecto (Mínimo 50 caracteres) *</label>
                    <textarea id="descripcion" name="descripcion" rows="10"
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('descripcion') border-red-500 @enderror"
                        placeholder="Describe detalladamente:&#10;1. El problema que abordas&#10;2. Tu solución propuesta&#10;3. Cómo usarás los fondos&#10;4. Impacto esperado"
                        required>{{ old('descripcion', $proyecto->descripcion) }}</textarea>
                    @error('descripcion') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    <p class="text-gray-400 text-sm mt-1">Sé claro y detallado. Los donantes querrán entender exactamente qué harás con su dinero.</p>
                </div>
            </div>

            <!-- Sección 3: Metas Financieras -->
            <div class="mb-8 pb-8 border-b border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-6">Metas Financieras</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Meta de Recaudación -->
                    <div>
                        <label for="objetivo_recaudacion" class="block text-sm font-semibold text-gray-300 mb-2">Meta de Recaudación ($) *</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-400">$</span>
                            <input type="number" id="objetivo_recaudacion" name="objetivo_recaudacion" value="{{ old('objetivo_recaudacion', $proyecto->objetivo_recaudacion) }}"
                                class="w-full pl-8 pr-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('objetivo_recaudacion') border-red-500 @enderror"
                                placeholder="0.00"
                                min="100"
                                step="0.01"
                                required>
                        </div>
                        @error('objetivo_recaudacion') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        <p class="text-gray-400 text-sm mt-1">Mínimo: $100</p>
                    </div>

                    <!-- Fecha Final -->
                    <div>
                        <label for="fecha_fin" class="block text-sm font-semibold text-gray-300 mb-2">Fecha de Término *</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $proyecto->fecha_fin->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 @error('fecha_fin') border-red-500 @enderror"
                            required>
                        @error('fecha_fin') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        <p class="text-gray-400 text-sm mt-1">Debe ser posterior a hoy</p>
                    </div>
                </div>
            </div>

            <!-- Sección 4: Imágenes -->
            <div class="mb-8 pb-8 border-b border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-6">Imágenes</h3>

                <!-- Imagen Principal -->
                <div class="mb-6">
                    <label for="imagen" class="block text-sm font-semibold text-gray-300 mb-2">Imagen Principal</label>
                    @if ($proyecto->imagen)
                        <div class="mb-3">
                            <p class="text-sm text-gray-400 mb-2">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}" class="max-h-32 rounded-lg">
                        </div>
                    @endif
                    <div class="relative border-2 border-dashed border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition"
                        ondrop="handleDrop(event, 'imagen')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden" onchange="previewImage(this, 'imagenPreview')">
                        <label for="imagen" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3 block"></i>
                            <p class="text-gray-300 font-semibold">Arrastra una imagen aquí o haz clic para cambiar</p>
                            <p class="text-gray-400 text-sm">Formatos: JPEG, PNG, GIF (Máx: 2MB)</p>
                        </label>
                    </div>
                    <div id="imagenPreview" class="mt-4 hidden">
                        <img id="imagenPreviewImg" src="" alt="Preview" class="max-h-48 rounded-lg">
                    </div>
                    @error('imagen') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Imagen Banner -->
                <div class="mb-6">
                    <label for="imagen_banner" class="block text-sm font-semibold text-gray-300 mb-2">Imagen Banner (Encabezado)</label>
                    @if ($proyecto->imagen_banner)
                        <div class="mb-3">
                            <p class="text-sm text-gray-400 mb-2">Banner actual:</p>
                            <img src="{{ asset('storage/' . $proyecto->imagen_banner) }}" alt="{{ $proyecto->titulo }}" class="max-h-32 w-full rounded-lg object-cover">
                        </div>
                    @endif
                    <div class="relative border-2 border-dashed border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition"
                        ondrop="handleDrop(event, 'imagen_banner')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                        <input type="file" id="imagen_banner" name="imagen_banner" accept="image/*" class="hidden" onchange="previewImage(this, 'bannerPreview')">
                        <label for="imagen_banner" class="cursor-pointer">
                            <i class="fas fa-image text-3xl text-gray-400 mb-3 block"></i>
                            <p class="text-gray-300 font-semibold">Arrastra una imagen aquí o haz clic para cambiar</p>
                            <p class="text-gray-400 text-sm">Recomendado: 1920x600px - Formatos: JPEG, PNG, GIF</p>
                        </label>
                    </div>
                    <div id="bannerPreview" class="mt-4 hidden">
                        <img id="bannerPreviewImg" src="" alt="Preview" class="w-full max-h-64 rounded-lg object-cover">
                    </div>
                    @error('imagen_banner') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Información del Proyecto (Solo lectura) -->
            <div class="mb-8 pb-8 border-b border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-6">Estado Actual del Proyecto</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-700 rounded-lg p-4">
                        <p class="text-gray-400 text-sm">Estado</p>
                        <p class="text-white font-bold">{{ $proyecto->getEstadoLegible() }}</p>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <p class="text-gray-400 text-sm">Creado el</p>
                        <p class="text-white font-bold">{{ $proyecto->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <p class="text-gray-400 text-sm">Recaudado</p>
                        <p class="text-white font-bold">${{ number_format($proyecto->monto_actual, 2) }}</p>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <p class="text-gray-400 text-sm">Donantes</p>
                        <p class="text-white font-bold">{{ $proyecto->contador_donantes }}</p>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('emprendedor.dashboard') }}"
                    class="px-6 py-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-white font-semibold transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                    <i class="fas fa-save mr-2"></i>Guardar Cambios
                </button>
            </div>
        </form>
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
                        <label for="meta" class="form-label">Meta de Financiamiento (S/)</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text currency-prefix">S/</span>
                            <input type="number" class="form-control form-control-lg" id="meta" name="meta" value="1000" min="0" step="0.01">
                        </div>
                        @error('meta') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fecha_limite" class="form-label">Fecha Límite</label>
                        <input type="date" class="form-control form-control-lg" id="fecha_limite" name="fecha_limite" value="2026-01-01">
                        @error('fecha_limite') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-select form-select-lg" id="categoria" name="categoria">
                            {{-- Options for categories --}}
                            <option value="1" selected>Tecnología</option>
                            <option value="2">Arte</option>
                        </select>
                        @error('categoria') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-brand">Actualizar Borrador</button>
                        <button type="submit" name="enviar_revision" value="1" class="btn btn-outline-secondary">Enviar a Revisión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-left{
        background: linear-gradient(180deg, #052d49 0%, #044056 100%);
        color: #ffffff;
    }
    .btn-primary-brand{ background: #f96854; color: #fff; border: none; }
    .btn-primary-brand:hover{ background: #e65b48; color:#fff; }
    .btn-outline-secondary{ border: 1px solid #052d49; color: #052d49; background: transparent; }
    .btn-outline-secondary:hover{ background: rgba(5,45,73,0.06); }
    .currency-prefix{ background: #f96854; color: #fff; border: none; }
</style>
@endsection
