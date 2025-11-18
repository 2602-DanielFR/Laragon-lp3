@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="#" method="POST">
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
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
</div>
@endsection
