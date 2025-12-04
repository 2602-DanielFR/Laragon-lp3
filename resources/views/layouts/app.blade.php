<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#052d49;">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('proyectos.*') ? 'active' : '' }}" href="{{ route('proyectos.index') }}">Explorar Proyectos</a>
                        </li>
                        @auth
                        @if(Auth::user()->role == 'Emprendedor')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('emprendedor.*') ? 'active' : '' }}" href="{{ route('emprendedor.dashboard') }}">Mi Dashboard</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'Donante')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('donante.*') ? 'active' : '' }}" href="{{ route('donante.donaciones.index') }}">Mis Donaciones</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                        @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item me-2">
                            <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-sm btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="user-initials">{{ strtoupper(substr(Auth::user()->name ?? '', 0, 1)) }}</span>
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('perfil.show', Auth::user()->id) }}">
                                    Mi Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <a href="{{ route('perfil.show', Auth::id()) }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Mi
                            Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Cerrar
                                Sesión</button>
                        </form>
                    </div>
                    @else
                    <div class="mt-3 px-2 space-y-1">
                        <a href="{{ route('login') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Login</a>
                        <a href="{{ route('register') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Registro</a>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="bg-secundario text-white py-6 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-400">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}.
                            Todos los derechos reservados.</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.117 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Alpine.js for Dropdown -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>

</html>