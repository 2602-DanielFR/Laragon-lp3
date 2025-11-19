<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Admin - @yield('title','Dashboard')</title>
    @vite(['resources/sass/admin.scss','resources/js/app.js'])
</head>
<body class="admin-body">
<nav class="navbar navbar-expand-lg navbar-dark navbar-admin">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.proyectos.*') ? 'active' : '' }}" href="{{ route('admin.proyectos.index') }}">Proyectos</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}" href="{{ route('admin.categorias.index') }}">Categorías</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Usuarios</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white small">{{ Auth::user()->name ?? 'Usuario' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-primary">Salir</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container admin-wrapper">
    @yield('content')
</main>
<footer class="footer-admin text-center">
    <div class="container">
        <span>&copy; {{ date('Y') }} Panel Administrativo. Colores: Principal #f96854 · Secundario #052d49</span>
    </div>
</footer>
</body>
</html>