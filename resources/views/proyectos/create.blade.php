@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Proyecto</h1>
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título del Proyecto</label>
            <input type="text" class="form-control" id="titulo" name="titulo">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="meta" class="form-label">Meta de Financiamiento (€)</label>
            <input type="number" class="form-control" id="meta" name="meta">
        </div>
        <div class="mb-3">
            <label for="fecha_limite" class="form-label">Fecha Límite</label>
            <input type="date" class="form-control" id="fecha_limite" name="fecha_limite">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select class="form-select" id="categoria" name="categoria">
                {{-- Options for categories --}}
                <option value="1">Tecnología</option>
                <option value="2">Arte</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Borrador</button>
        <button type="submit" name="enviar_revision" value="1" class="btn btn-secondary">Enviar a Revisión</button>
    </form>
</div>
@endsection
