<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Admin - @yield('title','Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 border-b-4 border-orange-500 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white hidden sm:block">Panel Admin</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l-7-4m0 0l-2-1m2 1v-8m7-1l7-4"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.proyectos.index') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.proyectos.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Proyectos
                    </a>
                    <a href="{{ route('admin.categorias.index') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.categorias.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Categorías
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.646 4 4 0 010-8.646M9 9H5a4 4 0 014-4h6a4 4 0 014 4h-4m0 0v6a2 2 0 01-2 2h-4a2 2 0 01-2-2v-6m12-2h.01M9 17h.01"/>
                        </svg>
                        Usuarios
                    </a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center gap-4">
                    <!-- User Info -->
                    <div class="hidden sm:flex items-center gap-2">
                        <div class="h-9 w-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-sm">
                            <p class="text-white font-medium">{{ Auth::user()->name ?? 'Usuario' }}</p>
                            <p class="text-gray-400 text-xs">Administrador</p>
                        </div>
                    </div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium transition-colors">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Salir
                        </button>
                    </form>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" type="button" 
                            class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-gray-700">
                <div class="space-y-2 pt-4">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.proyectos.index') }}" 
                       class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.proyectos.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        Proyectos
                    </a>
                    <a href="{{ route('admin.categorias.index') }}" 
                       class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.categorias.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        Categorías
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.users.*') ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">
                        Usuarios
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-center py-6 border-t border-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-sm">&copy; {{ date('Y') }} Panel Administrativo • Financiamiento Social • Colores: Principal <span class="text-orange-500 font-semibold">#f96854</span> • Secundario <span class="text-blue-900 font-semibold">#052d49</span></p>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>