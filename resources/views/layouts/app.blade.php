<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&family=Fira+Code&family=Rubik&family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/77ce6977ef.js" crossorigin="anonymous"></script>

        <title>{{ config('app.name', 'Laravel') }}
            @hasSection("html_title")
                || @yield("html_title")
            @endif
        </title>

        <!-- Scripts -->
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/app.js?v=3"></script>
        @stack("head")

    </head>
    <body class="font-sans antialiased">
        @yield("body")
    </body>
</html>
