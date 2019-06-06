<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/utils.js') }}" defer></script>
</head>
<body>
    <header>
        <h1><a href="/">{{ config('app.name', 'Laravel') }}</a></h1>
        <h2>@yield('subtitle', 'Fetish photography')</h2>
        @yield('subsubtitle')
    </header>
    <main>
        @yield('content')
    </main>
    <footer> Since 2018 | All models appearing on this website are 18 years of age or older </footer>
</body>
</html>
