@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Título del Proyecto</h1>
    <div class="row">
        <div class="col-md-8">
            <p>Descripción completa del proyecto...</p>
            {{-- Tabs for Updates, Donors, etc. --}}
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>€250</h4>
                    <p>recaudados de una meta de €1000</p>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                    <p><strong>X</strong> donantes</p>
                    <a href="#" class="btn btn-success w-100">Donar a este proyecto</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
