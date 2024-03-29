<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <title>Panel Kodlooper</title>
        <!-- Favicon -->
        <!--<link href="/images/fav.png" rel="icon" type="image/png">-->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        
        <style>
        .newPageStyle{
            width:45%!important;margin-left:1%;margin:0 auto
        }

        @media only screen and (max-width:959px) { 
            .newPageStyle{
            width:100%!important;margin-left:1%;margin:0 auto
            }
        }
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        <div id="app"> 
            @auth()
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @include('layouts.navbars.sidebar')
            @endauth
            
            <div class="main-content">
                @include('layouts.navbars.navbar')
                @yield('content')
            </div>

            @guest()
                @include('layouts.footers.guest')
            @endguest
        </div>   
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="/js/app.js?{{ \Carbon\Carbon::now()->format('H:i:s') }}"></script>
        <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>

        <script>iFrameResize({},'#paytriframe');</script>

    </body>
</html>