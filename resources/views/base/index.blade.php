<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('base.assets.styles')
    @yield('styles')
</head>
<body class="materialdesign">
    @yield('app')
    @include('base.assets.scripts')
    @yield('scripts')
</body>
</html>
