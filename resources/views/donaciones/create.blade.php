@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Realizar Donación</h2>
                    <p class="mt-2 text-gray-600">Estás apoyando al proyecto: <span class="font-semibold text-principal">{{ $proyecto->titulo }}</span></p>
                </div>

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('donaciones.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

                    <div class="mb-6">
                        <label for="monto" class="block text-sm font-medium text-gray-700 mb-2">Monto a Donar (S/)</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">S/</span>
                            </div>
                            <input type="number" name="monto" id="monto" class="focus:ring-principal focus:border-principal block w-full pl-8 pr-12 sm:text-lg border-gray-300 rounded-md py-3" placeholder="0.00" min="1" step="0.01" required>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Monto mínimo: S/ 1.00</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Método de Pago</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border rounded-lg cursor-pointer hover:border-principal transition-colors bg-gray-50">
                                <input type="radio" name="metodo_pago" value="tarjeta" class="h-4 w-4 text-principal focus:ring-principal border-gray-300" checked>
                                <span class="ml-3 block text-sm font-medium text-gray-700">Tarjeta de Crédito / Débito</span>
                            </label>
                            <label class="relative flex items-center p-4 border rounded-lg cursor-pointer hover:border-principal transition-colors bg-gray-50">
                                <input type="radio" name="metodo_pago" value="paypal" class="h-4 w-4 text-principal focus:ring-principal border-gray-300">
                                <span class="ml-3 block text-sm font-medium text-gray-700">PayPal</span>
                            </label>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 italic">* Esta es una simulación. No se realizará ningún cargo real.</p>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-principal hover:bg-principal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal transition-colors">
                            Confirmar Donación
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Tu donación es segura y directa para el emprendedor.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection