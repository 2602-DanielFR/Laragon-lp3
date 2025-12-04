<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Crowdfunding') }} - @yield('title', 'Inicio')</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Navbar Principal -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo / Brand -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="h-10 w-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center group-hover:shadow-lg transition-shadow">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
                    </a>
                </div>

                <!-- Nav Links (Desktop) -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-orange-500 font-medium transition-colors">
                        Inicio
                    </a>
                    <a href="{{ route('proyectos.index') }}"
                        class="text-gray-700 hover:text-orange-500 font-medium transition-colors">
                        Explorar Proyectos
                    </a>
                </div>

                <!-- Right Section (Desktop) -->
                <div class="hidden md:flex items-center gap-4">
                    @if(auth()->check())
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="h-8 w-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</span>
                            <svg class="h-4 w-4 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            class="absolute right-0 mt-0 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-2 border border-gray-100">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                <p class="text-xs font-semibold text-orange-500 mt-1">
                                    @if(auth()->user()->isAdmin())
                                    Administrador
                                    @elseif(auth()->user()->isDonante())
                                    Donante
                                    @else
                                    Emprendedor
                                    @endif
                                </p>
                            </div>

                            <!-- Role-Specific Links -->
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                Panel Admin
                            </a>
                            @elseif(auth()->user()->isDonante())
                            <a href="{{ route('donante.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                Mis Donaciones
                            </a>
                            @elseif(auth()->user()->isEmprendedor())
                            <a href="{{ route('emprendedor.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                Mis Proyectos
                            </a>
                            <a href="{{ route('proyectos.create') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                Crear Proyecto
                            </a>
                            @endif

                            <hr class="my-2">
                            <a href="{{ route('perfil.show') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Mi Perfil
                            </a>
                            <a href="{{ route('perfil.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Configuración
                            </a>
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <!-- Auth Buttons para no autenticados -->
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-gray-700 font-medium hover:text-orange-500 transition-colors">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:shadow-lg transition-all hover:scale-105">
                        Registrarse
                    </a>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center gap-2">
                    @if(auth()->check())
                    <div class="h-8 w-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    @endif
                    <button id="mobile-menu-btn"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-gray-200">
                <div class="pt-4 space-y-2">
                    <a href="{{ route('home') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Inicio</a>
                    <a href="{{ route('proyectos.index') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Explorar Proyectos</a>

                    @if(auth()->check())
                    <hr class="my-2">
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-2 text-orange-600 font-semibold hover:bg-orange-50 rounded">Panel
                        Admin</a>
                    @elseif(auth()->user()->isDonante())
                    <a href="{{ route('donante.dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Mis Donaciones</a>
                    @elseif(auth()->user()->isEmprendedor())
                    <a href="{{ route('emprendedor.dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Mis Proyectos</a>
                    @endif
                    <a href="{{ route('perfil.show') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Mi Perfil</a>
                    <hr class="my-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded">
                            Cerrar Sesión
                        </button>
                    </form>
                    @else
                    <hr class="my-2">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Iniciar Sesión</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-orange-600 font-medium hover:bg-orange-50 rounded">Registrarse</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="h-8 w-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-white font-bold">{{ config('app.name') }}</h3>
                    </div>
                    <p class="text-sm">Conectamos proyectos sociales con personas que quieren hacer la diferencia.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Enlaces</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}"
                                class="hover:text-orange-400 transition-colors">Inicio</a></li>
                        <li><a href="{{ route('proyectos.index') }}"
                                class="hover:text-orange-400 transition-colors">Proyectos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#"
                                class="hover:text-orange-400 transition-colors">Términos de Servicio</a></li>
                        <li><a href="#"
                                class="hover:text-orange-400 transition-colors">Política de Privacidad</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Contacto</h4>
                    <p class="text-sm">hello@crowdfunding.com</p>
                    <p class="text-sm text-gray-500">+1 234 567 8900</p>
                </div>
            </div>
            <hr class="border-gray-800 mb-8">
            <div class="text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>