@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>
    <table class="table">
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
                <td>Admin</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    <form action="#" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Bloquear</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
