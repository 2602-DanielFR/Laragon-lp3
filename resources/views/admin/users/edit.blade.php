@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Editar Usuario</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
</div>
<div class="card admin-card mb-4">
    <div class="card-body">
    <form action="#" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" value="Admin User">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="admin@example.com" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select class="form-select" name="role">
                <option value="Admin" selected>Admin</option>
                <option value="Donante">Donante</option>
                <option value="Emprendedor">Emprendedor</option>
            </select>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary px-4">Actualizar Usuario</button>
        </div>
    </form>
    </div>
</div>
@endsection
