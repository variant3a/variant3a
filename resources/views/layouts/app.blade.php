<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (isset($tags))
        <meta name="keyword" content="{{ $tags->implode('name', ', ') }}">
    @endif

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <title>{{ $title ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @livewireScripts
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <meta name="google-site-verification" content="2ZseLlPEz2jQX_FTIz1UkNzLEpovoPTGEdn0S4YgbzE" />
</head>

<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-zinc-800">
    <header id="header" data-turbo-permanent>
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
    <script data-turbo-eval="false" defer>
        // Switch Theme Script

        const savedTheme = localStorage.theme
        const scheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        const theme = savedTheme ?? scheme

        if (theme === 'dark') {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        window.changeTheme = () => {
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.remove('dark')
                localStorage.theme = 'light'
            } else {
                document.documentElement.classList.add('dark')
                localStorage.theme = 'dark'
            }
        }
    </script>
</body>

</html>
