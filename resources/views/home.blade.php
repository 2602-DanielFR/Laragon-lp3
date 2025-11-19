@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-green-600 via-teal-600 to-blue-600 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative container mx-auto px-4 py-20 md:py-32">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Transforma Ideas en Impacto Real
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-95">
                Conectamos proyectos sociales y ambientales con personas que quieren hacer la diferencia
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-green-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                    Crear Proyecto
                </a>
                <a href="#proyectos" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-green-600 transition">
                    Explorar Causas
                </a>
            </div>
        </div>
    </div>
    <!-- Wave decoration -->
    <div class="absolute bottom-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6">
                <div class="text-4xl md:text-5xl font-bold text-green-600 mb-2">1,245</div>
                <div class="text-gray-600 text-lg">Proyectos Activos</div>
            </div>
            <div class="p-6">
                <div class="text-4xl md:text-5xl font-bold text-teal-600 mb-2">$2.5M</div>
                <div class="text-gray-600 text-lg">Recaudados</div>
            </div>
            <div class="p-6">
                <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">15,680</div>
                <div class="text-gray-600 text-lg">Donantes</div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works -->
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">¿Cómo Funciona?</h2>
        <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto">
            En tres simples pasos puedes crear tu proyecto o apoyar causas que importan
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">1. Crea tu Proyecto</h3>
                <p class="text-gray-600">Comparte tu visión, establece tu meta y cuenta tu historia de impacto</p>
            </div>
            
            <!-- Step 2 -->
            <div class="text-center">
                <div class="bg-teal-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">2. Conecta con Donantes</h3>
                <p class="text-gray-600">Llega a personas que comparten tu pasión por el cambio social</p>
            </div>
            
            <!-- Step 3 -->
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">3. Genera Impacto</h3>
                <p class="text-gray-600">Recibe fondos, comparte actualizaciones y transforma tu comunidad</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Projects -->
<div id="proyectos" class="bg-white py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Proyectos Destacados</h2>
        <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto">
            Descubre iniciativas increíbles que están cambiando el mundo
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Project Card 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gradient-to-br from-green-400 to-green-600"></div>
                <div class="p-6">
                    <div class="text-sm text-green-600 font-semibold mb-2">MEDIO AMBIENTE</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Reforestación Amazónica</h3>
                    <p class="text-gray-600 mb-4 text-sm">Plantando 10,000 árboles para recuperar el pulmón del planeta</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">$12,450 recaudados</span>
                            <span class="font-semibold text-gray-800">62%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 62%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">235 donantes</span>
                        <a href="#" class="text-green-600 font-semibold hover:text-green-700">Ver más →</a>
                    </div>
                </div>
            </div>
            
            <!-- Project Card 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gradient-to-br from-teal-400 to-teal-600"></div>
                <div class="p-6">
                    <div class="text-sm text-teal-600 font-semibold mb-2">EDUCACIÓN</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Biblioteca Comunitaria</h3>
                    <p class="text-gray-600 mb-4 text-sm">Construyendo un espacio de aprendizaje para 500 niños</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">$8,900 recaudados</span>
                            <span class="font-semibold text-gray-800">89%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-teal-600 h-2 rounded-full" style="width: 89%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">187 donantes</span>
                        <a href="#" class="text-teal-600 font-semibold hover:text-teal-700">Ver más →</a>
                    </div>
                </div>
            </div>
            
            <!-- Project Card 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600"></div>
                <div class="p-6">
                    <div class="text-sm text-blue-600 font-semibold mb-2">SALUD</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Agua Potable Rural</h3>
                    <p class="text-gray-600 mb-4 text-sm">Sistema de agua limpia para 3 comunidades rurales</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">$15,200 recaudados</span>
                            <span class="font-semibold text-gray-800">76%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 76%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">312 donantes</span>
                        <a href="#" class="text-blue-600 font-semibold hover:text-blue-700">Ver más →</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="inline-block bg-gray-800 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-700 transition">
                Ver Todos los Proyectos
            </a>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="bg-gradient-to-br from-gray-800 to-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">¿Por Qué Elegirnos?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <div class="text-center">
                <div class="text-4xl mb-4">🔒</div>
                <h3 class="text-lg font-bold mb-2">100% Seguro</h3>
                <p class="text-gray-300 text-sm">Transacciones protegidas y transparentes</p>
            </div>
            
            <div class="text-center">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="text-lg font-bold mb-2">Transparencia Total</h3>
                <p class="text-gray-300 text-sm">Seguimiento en tiempo real de cada donación</p>
            </div>
            
            <div class="text-center">
                <div class="text-4xl mb-4">💚</div>
                <h3 class="text-lg font-bold mb-2">Sin Fines de Lucro</h3>
                <p class="text-gray-300 text-sm">Enfocados en el impacto social y ambiental</p>
            </div>
            
            <div class="text-center">
                <div class="text-4xl mb-4">🤝</div>
                <h3 class="text-lg font-bold mb-2">Comunidad Activa</h3>
                <p class="text-gray-300 text-sm">Miles de personas comprometidas con el cambio</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-green-500 to-teal-500 py-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            ¿Listo para Hacer la Diferencia?
        </h2>
        <p class="text-xl text-white opacity-90 mb-8 max-w-2xl mx-auto">
            Únete a nuestra comunidad y comienza a crear el cambio que quieres ver en el mundo
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white text-green-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                Comenzar Ahora
            </a>
            <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-green-600 transition">
                Contactar
            </a>
        </div>
    </div>
</div>
@endsection