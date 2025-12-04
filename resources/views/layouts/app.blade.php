<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Financiamiento') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="bg-white">
    <div id="app">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo/Brand -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <div class="h-10 w-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 hidden sm:block">{{ config('app.name', 'Financiamiento') }}</span>
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('proyectos.index') }}" 
                           class="text-gray-700 hover:text-orange-500 font-medium transition-colors">
                            Explorar Proyectos
                        </a>
                        
                        @if(Auth::check() && Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" 
                           class="text-gray-700 hover:text-orange-500 font-medium transition-colors">
                            Panel Admin
                        </a>
                        @endif

                        @if(Auth::check() && Auth::user()->hasRole('emprendedor'))
                        <a href="{{ route('emprendedor.dashboard') }}" 
                           class="text-gray-700 hover:text-orange-500 font-medium transition-colors">
                            Mis Proyectos
                        </a>
                        @endif

                        @if(Auth::check() && Auth::user()->hasRole('donante'))
                        <a href="{{ route('donante.donaciones.index') }}" 
                           class="text-gray-700 hover:text-orange-500 font-medium transition-colors">
                            Mis Donaciones
                        </a>
                        @endif
                    </div>

                    <!-- Right Section -->
                    <div class="flex items-center gap-4">
                        @auth
                        <!-- User Dropdown -->
                        <div class="relative group hidden sm:block">
                            <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="h-8 w-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 w-48 mt-2 bg-white rounded-lg shadow-lg border border-gray-200 hidden group-hover:block z-50">
                                <a href="{{ route('perfil.show') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-orange-500 transition-colors border-b border-gray-100">
                                    Mi Perfil
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500 transition-colors">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <!-- Login/Register Buttons -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" 
                               class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-orange-500 transition-colors">
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" 
                               class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg hover:shadow-lg transition-all">
                                Registrarse
                            </a>
                        </div>
                        @endauth

                        <!-- Mobile Menu Button -->
                        <button id="mobile-menu-btn" type="button" 
                                class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-gray-200">
                    <div class="space-y-2 pt-4">
                        <a href="{{ route('proyectos.index') }}" 
                           class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-orange-500 font-medium transition-colors">
                            Explorar Proyectos
                        </a>
                        
                        @if(Auth::check() && Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" 
                           class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-orange-500 font-medium transition-colors">
                            Panel Admin
                        </a>
                        @endif

                        @if(Auth::check() && Auth::user()->hasRole('emprendedor'))
                        <a href="{{ route('emprendedor.dashboard') }}" 
                           class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-orange-500 font-medium transition-colors">
                            Mis Proyectos
                        </a>
                        @endif

                        @if(Auth::check() && Auth::user()->hasRole('donante'))
                        <a href="{{ route('donante.donaciones.index') }}" 
                           class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-orange-500 font-medium transition-colors">
                            Mis Donaciones
                        </a>
                        @endif

                        @guest
                        <div class="flex gap-2 pt-4 border-t border-gray-200">
                            <a href="{{ route('login') }}" 
                               class="flex-1 text-center px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:border-orange-500 hover:text-orange-500 transition-colors">
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" 
                               class="flex-1 text-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg hover:shadow-lg transition-all">
                                Registrarse
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <h3 class="text-white font-semibold mb-4">Sobre Nosotros</h3>
                        <p class="text-sm text-gray-400">Plataforma de financiamiento social para transformar ideas en impacto real.</p>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-4">Enlaces</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('proyectos.index') }}" class="text-gray-400 hover:text-orange-500">Proyectos</a></li>
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-orange-500">Inicio</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-4">Legal</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-400 hover:text-orange-500">Términos</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-orange-500">Privacidad</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-4">Contacto</h3>
                        <p class="text-sm text-gray-400">info@financiamientosocial.com</p>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 text-center">
                    <p class="text-sm">&copy; {{ date('Y') }} {{ config('app.name','Laravel') }} • Financiamiento Social</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>