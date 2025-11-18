@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="Tecnología">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
