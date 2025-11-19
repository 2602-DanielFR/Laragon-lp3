@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Realizar Donación</h1>
            <p class="text-gray-600">Tu contribución hace la diferencia</p>
        </div>

        <!-- Project Info Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-6 0H3m0 0h6m6 0v-6m0 6v6"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Título del Proyecto</h2>
                    <p class="text-gray-600">Por Nombre del Emprendedor</p>
                    <div class="flex items-center mt-2">
                        <div class="bg-gray-200 rounded-full h-2 w-32 mr-3">
                            <div class="bg-gradient-to-r from-green-500 to-blue-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <span class="text-sm text-gray-600">65% completado</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="#" method="POST" class="space-y-6">
                @csrf
                
                <!-- Amount Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Selecciona un monto</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                        <button type="button" class="amount-btn border-2 border-gray-200 rounded-lg p-3 text-center hover:border-blue-500 focus:border-blue-500 transition-colors" data-amount="25">
                            <div class="text-lg font-semibold text-gray-900">€25</div>
                        </button>
                        <button type="button" class="amount-btn border-2 border-gray-200 rounded-lg p-3 text-center hover:border-blue-500 focus:border-blue-500 transition-colors" data-amount="50">
                            <div class="text-lg font-semibold text-gray-900">€50</div>
                        </button>
                        <button type="button" class="amount-btn border-2 border-gray-200 rounded-lg p-3 text-center hover:border-blue-500 focus:border-blue-500 transition-colors" data-amount="100">
                            <div class="text-lg font-semibold text-gray-900">€100</div>
                        </button>
                        <button type="button" class="amount-btn border-2 border-gray-200 rounded-lg p-3 text-center hover:border-blue-500 focus:border-blue-500 transition-colors" data-amount="custom">
                            <div class="text-lg font-semibold text-gray-900">Otro</div>
                        </button>
                    </div>
                    
                    <div class="relative">
                        <label for="monto" class="block text-sm font-medium text-gray-700 mb-2">Monto personalizado (€)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">€</span>
                            <input type="number" 
                                   class="w-full pl-8 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   id="monto" 
                                   name="monto" 
                                   min="1" 
                                   step="0.01"
                                   placeholder="0.00">
                        </div>
                    </div>
                </div>

                <!-- Anonymous Donation -->
                <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                    <input type="checkbox" 
                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                           id="anonimo" 
                           name="anonimo">
                    <label for="anonimo" class="text-sm text-gray-700">
                        <span class="font-medium">Donación anónima</span>
                        <p class="text-gray-500">Tu nombre no aparecerá públicamente</p>
                    </label>
                </div>

                <!-- Payment Method -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Método de pago</label>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-blue-900">Pago seguro</p>
                                <p class="text-sm text-blue-700">Procesado por Stripe/PayPal - Datos protegidos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>Confirmar Donación</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Info -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                🔒 Todas las transacciones están protegidas con encriptación SSL
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountBtns = document.querySelectorAll('.amount-btn');
    const customInput = document.getElementById('monto');
    
    amountBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            amountBtns.forEach(b => {
                b.classList.remove('border-blue-500', 'bg-blue-50');
                b.classList.add('border-gray-200');
            });
            
            // Add active class to clicked button
            this.classList.remove('border-gray-200');
            this.classList.add('border-blue-500', 'bg-blue-50');
            
            // Set input value
            const amount = this.dataset.amount;
            if (amount !== 'custom') {
                customInput.value = amount;
            } else {
                customInput.focus();
            }
        });
    });
});
</script>
@endsection
