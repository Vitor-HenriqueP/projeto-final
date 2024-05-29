<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Meta tags, title, stylesheets, etc. -->
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Conteúdo dinâmico -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Scripts -->
    @yield('scripts')
</body>

</html>
