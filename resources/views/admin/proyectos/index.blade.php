@extends('admin.layouts.app')

@section('content')
<div class="admin-title-bar">
    <h1>Revisión de Proyectos</h1>
    <span class="badge bg-secondary">Pendientes</span>
</div>
<p class="text-white-50 mb-3">Listado de proyectos esperando acción. Revisa detalles y aprueba o rechaza.</p>
<div class="table-responsive table-admin mb-4">
    <table class="table table-hover align-middle mb-0">
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
                    <a href="#" class="btn btn-sm btn-primary">Revisar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
