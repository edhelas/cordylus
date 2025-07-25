<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="/manifest.json"/>

    <link rel="shortcut icon" href="/img/favicon.ico" />
    <link rel="icon" type="image/png" href="/img/48.png" sizes="48x48">
    <link rel="icon" type="image/png" href="/img/96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/img/128.png" sizes="128x128">
    <link rel="icon" type="image/png" href="/img/256.png" sizes="256x256">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ MetaTag::get('title') }}</title>

    {!! MetaTag::tag('description', 'Fetish Photography') !!}

    {!! MetaTag::openGraph() !!}

    {!! MetaTag::twitterCard() !!}

    {{--Set default share picture after custom section pictures--}}
    {!! MetaTag::tag('image', asset('img/256.png')) !!}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}?2" rel="stylesheet">
    <script src="{{ asset('js/utils.js') }}" defer></script>
</head>
<body @if (isset($background))class="welcome" style="background-image: url('{{asset($background->path('sl', 'jpg'))}}');"@endif>
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
    <footer>
        Since 2018<br />
        <a href="{{ route('models.gallery') }}">Models</a>
        – <a href="{{ route('shootings.feed') }}">Feed</a>
        – <a href="{{ route('about') }}">About Us</a>
        – All models appearing on this website are 18 years of age or older
    </footer>
</body>
</html>
