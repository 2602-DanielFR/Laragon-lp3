@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Administrativo</h1>
                <p class="mt-2 text-sm text-gray-600">Bienvenido, {{ Auth::user()->name }}. Aquí tienes un resumen de la plataforma.</p>
            </div>
            <a href="{{ route('admin.proyectos.index', ['estado' => \App\Models\Proyecto::STATUS_PENDING]) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                <i class="fas fa-hourglass-half mr-2"></i>Ver Proyectos Pendientes
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Proyectos</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalProyectos }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-project-diagram text-blue-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Proyectos Pendientes</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $proyectosPendientes }}</p>
                </div>
                <div class="p-3 bg-orange-100 rounded-full">
                    <i class="fas fa-clock text-orange-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Proyectos Activos</p>
                    <p class="text-3xl font-bold text-green-600">{{ $proyectosActivos }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Usuarios</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalUsers }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-users text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Quick Actions / Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('admin.proyectos.index') }}" class="group block bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-100 rounded-full group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-list-alt text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Gestionar Proyectos</h3>
                        <p class="text-sm text-gray-600">Revisa, aprueba o rechaza los proyectos enviados por emprendedores.</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.categorias.index') }}" class="group block bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-100 rounded-full group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-tags text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">Gestionar Categorías</h3>
                        <p class="text-sm text-gray-600">Administra las categorías para organizar mejor los proyectos.</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="group block bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-purple-100 rounded-full group-hover:bg-purple-200 transition-colors">
                        <i class="fas fa-users-cog text-purple-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Gestionar Usuarios</h3>
                        <p class="text-sm text-gray-600">Controla roles, permisos y la actividad de los usuarios.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
