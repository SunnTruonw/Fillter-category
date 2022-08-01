<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="vi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="abstract" content="@yield('abstract')" />
    <meta name="ROBOTS" content="Metaflow" />
    <meta name="ROBOTS" content="noindex, nofollow, all" />
    <meta name="AUTHOR" content="@yield('title')" />
    <meta name="revisit-after" content="1 days" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:alt" content="@yield('image')" />

    <meta property="og:url" content="{{ makeLink('home') }}" />
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <link rel="canonical" href="{{ makeLink('home') }}" />
    <link rel="shortcut icon" href="{{URL::to('/favicon.ico')}}" />
    <script type="text/javascript" src="{{ asset('lib/jquery/jquery-3.2.1.min.js') }} "></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-4.5.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('font/fontawesome-5.13.1/css/all.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('lib/wow/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/lightbox-plus/css/lightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
     {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}"> --}}

     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" /> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/auth.css') }}">

    @yield('css')
</head>

<body class="template-search">
    <div class="wrapper home">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    {{-- @if (Auth::guard('admin')->check())
                                    {{ Auth::guard('admin')->user()->name }}
                                    @else --}}
                                    {{-- @if(Auth::guard('web')->check())
                                    {{ Auth::guard()->user()->name }}
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    {{-- @if (Auth::guard('admin')->check())
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                     </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none"> --}}
                                    {{-- @if(Auth::guard('web')->check())
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                     </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @endif
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <!-- Navbar -->
        @include('frontend.partials.header')
        <!-- /.navbar -->

        @yield('content')

        @include('frontend.partials.footer')


    </div>
    <script type="text/javascript" src="{{ asset('lib/lightbox-plus/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('lib/bootstrap-4.5.3-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/slick-1.8.1/js/slick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{asset('lib/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('lib/components/js/Cart.js') }}"></script>
    <script src="{{ asset('lib/components/js/Compare.js') }}"></script>
    <script>
        new WOW().init();
        $(function() {
            $(document).on('click','.pt_icon_right',function(){
                event.preventDefault();
                $(this).parent('a').parent('li').children("ul").slideToggle();
                $(this).parent('a').parent('li').toggleClass('active');
            });
            $(document).on('click','.btn-sb-toogle',function(){
                $(this).parents('.box-list-fill').find('.fill-list-item').slideToggle();
                $(this).toggleClass('active');
            });
        })
    </script>

    <script>
            
        $(document).on('click','.checkmark',function(){
            let urlImage = $(this).attr('data-url');
            
            $(this).parents('.product-grid__thumbnail').find('.big-image').attr('src', urlImage);
            $(this).parents('.product-grid__thumbnail').find('.checkmark').removeClass('active');
            $(this).addClass('active');
        })

    </script>
    
    @yield('js')

</body>
</html>
