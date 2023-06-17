<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-41VLYNFZ5Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-41VLYNFZ5Q');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (isset($tags))
        <meta name="keyword" content="{{ $tags->implode('name', ', ') }}">
    @endif
    @if (isset($description))
        <meta name="description" content="{{ $description }}">
    @endif

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <title>{{ $title ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

    @livewireScripts

    @vite(['resources/sass/app.sass', 'resources/js/app.js'])

    @livewireStyles

    <meta name="google-site-verification" content="2ZseLlPEz2jQX_FTIz1UkNzLEpovoPTGEdn0S4YgbzE" />
</head>

<body class="flex flex-col min-h-screen bg-neutral-900 scrollbar-thin scrollbar">
    <header id="header">
        @include('components.header')
    </header>
    <main class="flex-1">
        <div class="mx-1 mt-20 sm:mx-3 sm:mt-24">
            @yield('content')
        </div>
        @livewire('components.toast', ['status' => ($status = 'success'), 'message' => ($message = 'update successful')])
    </main>
    <footer id="footer" data-turbo-permanent>
        @include('components.footer')
    </footer>
</body>

</html>
