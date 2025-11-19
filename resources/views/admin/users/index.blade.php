@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Usuarios</h1>
    <span class="badge bg-primary">Gestión</span>
</div>
<div class="table-responsive table-admin mb-4">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through users --}}
            <tr>
                <td>1</td>
                <td>Admin User</td>
                <td>admin@example.com</td>
                <td><span class="badge badge-role" data-role="Admin">Admin</span></td>
                <td>
                    <div class="action-group">
                    <a href="#" class="btn btn-sm btn-secondary">Editar</a>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Bloquear</button>
                    </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
