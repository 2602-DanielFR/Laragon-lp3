@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Historial de Donaciones</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Proyecto</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through donations --}}
            <tr>
                <td>2025-11-18</td>
                <td><a href="#">Mi Gran Proyecto</a></td>
                <td>€50.00</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
