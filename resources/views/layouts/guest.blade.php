<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikitos</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body>
    @include('partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
