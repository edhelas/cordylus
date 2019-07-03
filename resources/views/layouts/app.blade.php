<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="/manifest.json"/>

    <link rel="shortcut icon" href="img/favicon.ico" />
    <link rel="icon" type="image/png" href="img/48.png" sizes="48x48">
    <link rel="icon" type="image/png" href="img/96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="img/128.png" sizes="128x128">
    <link rel="icon" type="image/png" href="img/256.png" sizes="256x256">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="Fetish Photography" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/utils.js') }}" defer></script>
</head>
<body>
    <header>
        <h1>
            <a href="@if (url()->current() == url(route('welcome')))/@else{{route('shootings.gallery')}}@endif">
                {{ config('app.name', 'Laravel') }}
            </a>
        </h1>
        <h2>@yield('subtitle', 'Fetish photography')</h2>
        @yield('subsubtitle')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>Since 2018 | <a href="{{route('about')}}">About Us</a> | All models appearing on this website are 18 years of age or older </footer>
</body>
</html>
