<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="">

    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <title>{{ $title }} - Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @livewireScripts
    <script src="{{ mix('js/app.js') }}" data-turbolinks-eval="false" data-turbo-eval="false"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
</head>

<body class="bg-dark">
    <header id="header">
        @include('components.header')
    </header>
    <main>
        <div class="container-fluid mt-5 pt-5">
            @yield('content')
        </div>
    </main>
    <footer id="footer" data-turbolinks-permanent>
        @include('components.footer')
    </footer>
</body>

</html>
