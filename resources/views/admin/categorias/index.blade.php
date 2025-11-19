@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Categorías</h1>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Nueva Categoría</a>
</div>
<div class="table-responsive table-admin mb-4">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through categories --}}
            <tr>
                <td>1</td>
                <td>Tecnología</td>
                <td>
                    <div class="action-group">
                    <a href="#" class="btn btn-sm btn-secondary">Editar</a>
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
