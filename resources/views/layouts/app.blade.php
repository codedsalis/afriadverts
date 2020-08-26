<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/ico">

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div id="app">
        {{-- <nav-bar></nav-bar> --}}
        <nav class="flex bg-white text-aa-dark shadow-md sticky justify-between">
            <div>
                <img src="{{ asset('img/afrilogo.small.png') }}" class="h-auto w-20" alt="logo" />
            </div>
            {{-- <div>
                <b class="text-aa-dark text-center items-center p-3">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </b>
            </div> --}}
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
