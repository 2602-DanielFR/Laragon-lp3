@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Editar Categoría</h1>
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Volver</a>
</div>
<div class="card admin-card mb-4">
    <div class="card-body">
    <form action="#" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="Tecnología">
        </div>
        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary px-4">Actualizar</button>
        </div>
    </form>
    </div>
</div>
@endsection
