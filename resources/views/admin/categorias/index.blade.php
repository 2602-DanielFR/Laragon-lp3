@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Categorías</h1>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary mb-3">Crear Categoría</a>
    <table class="table">
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
                    <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    <form action="#" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
