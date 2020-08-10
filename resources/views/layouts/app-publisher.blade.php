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

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body class="bg-gray-300 overflow-y-hidden">
    <div id="app">
        {{-- <nav-bar></nav-bar> --}}
        <nav class="flex bg-white text-aa-dark shadow-md sticky justify-between px-6 h-16">
            <div class="flex items-center">
                <button class="md:hidden mr-2" aria-label="Open Menu" onclick="drawer()">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <img src="/img/afrilogo.small.png" alt="Logo" class="h-auto w-16" />
                <b class="h-100 font-bold text-2xl italic">Pub</b>
            </div>
            <div>
                <button class="bg-transparent text-gray-700 text-xl rounded-full px-3 py-2 mt-2 hover:bg-gray-300">
                    <b>
                        @if (Auth::user()->currency === 'USD')
                            $
                        @else
                            &#8358;
                        @endif
                        {{ number_format(Auth::user()->publisher_earning, 2) }}
                    </b>
                </button>
                <a href="">
                    <button class="sm:hidden bg-transparent rounded-full px-3 py-2 hover:bg-gray-300">
                        <i class="fa fa-cog"></i>
                    </button>
                </a>
                {{-- <b class="text-aa-dark text-center items-center p-3">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </b> --}}
            </div>
        </nav>

        <div class="flex h-screen">
            <div class="bg-aa-dark w-0 md:w-1/5 invisible md:visible overflow-auto text-dark-200 p-0 md:p-4">

                <br />
                <br />
                <br />
                <br />
            </div>
            <!-- Scroll wrapper -->
            <div class="flex-1 flex overflow-hidden">
                <!-- Scrollable container -->
                <div class="w-full md:w-4/5 p-3 flex-1 overflow-y-scroll">
                    @yield('content')
                    <br />
                    <br />
                    <br />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
