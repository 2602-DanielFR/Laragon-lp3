@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cola de Revisión de Proyectos</h1>
    <p>Aquí se listan los proyectos pendientes de aprobación.</p>
    <table class="table">
        <thead>
            <tr>
                <th>ID Proyecto</th>
                <th>Título</th>
                <th>Emprendedor</th>
                <th>Fecha de Envío</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through projects for review --}}
            <tr>
                <td>1</td>
                <td>Mi Gran Proyecto</td>
                <td>Juan Emprendedor</td>
                <td>2025-11-18</td>
                <td>
                    <a href="#" class="btn btn-sm btn-info">Revisar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
