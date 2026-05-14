{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nikitos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body>
    @include('partials.header')

    @yield('content')   {{-- acá se inyecta el contenido de cada página --}}

    @include('partials.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>