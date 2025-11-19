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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* Paleta: principal #f96854, secundario #052d49 */
        .brand-primary { background: #f96854; color: #fff !important; border-color: #f96854; }
        .brand-secondary { background: #052d49; color: #fff !important; }
        .navbar-custom { background: #ffffff; }
        .navbar-brand .brand-badge { background: #052d49; color: #fff; padding: .2rem .6rem; border-radius: .35rem; font-weight:700; }
        .nav-link:hover { color: #f96854 !important; }
        .user-initials { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:#052d49; color:#fff; font-weight:700; margin-right:.5rem; }
        .dropdown-menu { min-width: 200px; border-radius:.5rem; }
        @media (max-width:767px) {
            .navbar-brand .brand-text { display:none; }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <span class="brand-badge me-2">{{ strtoupper(substr(config('app.name', 'Laravel'),0,2)) }}</span>
                    <span class="brand-text">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('proyectos.index') }}">Explorar Proyectos</a>
                        </li>
                        @auth
                        @if(Auth::user()->role == 'Emprendedor')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emprendedor.dashboard') }}">Mi Dashboard</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'Donante')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donante.donaciones.index') }}">Mis Donaciones</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                        @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="user-initials">{{ strtoupper(substr(Auth::user()->name ?? '', 0, 1)) }}</span>
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
    </div>
</body>

</html>