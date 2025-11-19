@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="row g-0">
            <div class="col-md-4 d-none d-md-flex align-items-center p-4 auth-left">
                <div>
                    <h3 class="mb-2">Editar Proyecto</h3>
                    <p class="small">Actualiza los datos del proyecto. No se cambia la lógica del backend — solo apariencia.</p>
                    <p class="text-muted small mb-0">Asegúrate de revisar la meta y la fecha límite antes de enviar a revisión.</p>
                </div>
            </div>
            <div class="col-md-8 p-4">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título del Proyecto</label>
                        <input type="text" class="form-control form-control-lg" id="titulo" name="titulo" value="Título de ejemplo">
                        @error('titulo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control form-control-lg" id="descripcion" name="descripcion" rows="5">Descripción de ejemplo.</textarea>
                        @error('descripcion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
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
