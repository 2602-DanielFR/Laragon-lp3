@extends('layouts.app')

@section('content')
<div class="container py-4">
    <style>
        /* Paleta: principal #f96854, secundario #052d49 */
        .brand-btn { background: #f96854; border-color:#f96854; color:#fff; }
        .brand-accent { color:#052d49; }
        .card-rounded { border-radius:.6rem; }
        .form-help { color:#6c757d; font-size:.9rem; }
    </style>

    <div class="card card-rounded shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Crear Nuevo Proyecto</h3>
                <small class="text-muted">Completa los datos para publicar tu proyecto</small>
            </div>

            <form action="{{ route('proyectos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del Proyecto</label>
                    <input type="text" class="form-control form-control-lg @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}">
                    @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="6">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-help mt-1">Es recomendable describir el proyecto en 3-5 párrafos claros: problema, solución y uso de los fondos.</div>
                </div>

                <div class="row gx-3">
                    <div class="col-md-6 mb-3">
                        <label for="meta" class="form-label">Meta de Financiamiento (S/)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/</span>
                            <input type="number" min="1" step="0.01" class="form-control @error('meta') is-invalid @enderror" id="meta" name="meta" value="{{ old('meta') }}">
                        </div>
                        @error('meta') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_limite" class="form-label">Fecha Límite</label>
                        <input type="date" class="form-control @error('fecha_limite') is-invalid @enderror" id="fecha_limite" name="fecha_limite" value="{{ old('fecha_limite') }}">
                        @error('fecha_limite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-select @error('categoria') is-invalid @enderror" id="categoria" name="categoria">
                        {{-- Options for categories --}}
                        <option value="1" {{ old('categoria')==1 ? 'selected' : '' }}>Tecnología</option>
                        <option value="2" {{ old('categoria')==2 ? 'selected' : '' }}>Arte</option>
                    </select>
                    @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn brand-btn">Guardar Borrador</button>
                    <button type="submit" name="enviar_revision" value="1" class="btn btn-outline-secondary">Enviar a Revisión</button>
                    <a href="{{ url()->previous() }}" class="btn btn-link">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
