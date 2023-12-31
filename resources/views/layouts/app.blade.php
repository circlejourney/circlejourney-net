<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- OpenGraph -->
        @hasSection("html_title")
            <title>{{ config('app.name', 'Laravel') }} || @yield("html_title")</title>
            <meta property="og:title" content="{{ config('app.name', 'Laravel') }} || @yield("html_title")" />
            <meta property="og:description" content="@yield("html_title") on Circlejourney's homepage." />
        @else
            <title>{{ config('app.name', 'Laravel') }}</title>
            <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
            <meta property="og:description" content="Circlejourney's homepage." />
        @endif

        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->full() }}" />
        <meta property="og:image" content="/images/logosmall.png" />


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&family=Fira+Code&family=Rubik&family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/77ce6977ef.js" crossorigin="anonymous"></script>


        <!-- Scripts -->
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/app.js?v={{ filemtime("js/app.js") }}"></script>
        @stack("head")

    </head>
    <body>
        @yield("body")
    </body>
</html>
