@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Donar al Proyecto: Título del Proyecto</h1>
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="monto" class="form-label">Monto a Donar (€)</label>
            <input type="number" class="form-control" id="monto" name="monto">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="anonimo" name="anonimo">
            <label class="form-check-label" for="anonimo">
                Hacer donación anónima
            </label>
        </div>
        {{-- Payment gateway integration fields would go here --}}
        <p>Integración con pasarela de pago (Stripe, PayPal, etc.)</p>
        <button type="submit" class="btn btn-primary">Confirmar Donación</button>
    </form>
</div>
@endsection
