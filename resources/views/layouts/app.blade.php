<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @vite('resources/css/app.css')
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
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="py-4 mt-auto" style="background:#052d49;">
            <div class="container text-center">
                <span class="text-white-50 small">&copy; {{ date('Y') }} {{ config('app.name','Laravel') }} · Principal #f96854 · Secundario #052d49</span>
            </div>
        </footer>
    </div>
</body>

</html>