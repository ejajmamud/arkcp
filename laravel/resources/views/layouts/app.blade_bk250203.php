<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$settings->title}}</title>
    <meta name="description" content="{{$settings->description}}">
    <link rel="icon" type="image/png" sizes="96x96"
          href="{{ asset('laravel/storage/blogassets/'.$settings->favicon ?? '') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Google Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Google Analytics -->
    <script>
        {{$settings->gacode}}
    </script>

    <!-- End Google Analytics -->
</head>
<body>
<!-- ======= Mobile Menu ======= -->
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<!-- ======= Header ======= -->
<div id="sticky-wrapper" class="sticky-wrapper is-sticky" style="height: 85px;">
    <header class="site-navbar js-sticky-header site-navbar-target is-sticky" role="banner">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-lg-3">
                        <a href="{{ url('/') }}" class="mb-0">
                            <h1 class="my-3 site-logo">
                                <img src="{{ asset('laravel/storage/blogassets/'.$settings->logo ?? '') }}"
                                     alt="Career Indicator" class="img-fluid">
                            </h1>
                        </a>
                        
                </div>

                <div class="col-12 col-md-9 d-none d-lg-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">What is it </a></li>
                            <li class="{{ (request()->is('pricing')) ? 'active' : '' }}"><a href="{{ route('pricing') }}" class="nav-link">Pricing</a></li>
                            <li class="{{ (request()->is('faqs')) ? 'active' : '' }}"><a href="{{ route('faqs') }}" class="nav-link">FAQs</a></li>

                            <!--  <li class="has-children">
                                <a href="blog.php" class="nav-link">Blog</a>
                                <ul class="dropdown">
                                  <li><a href="blog.php" class="nav-link">Blog</a></li>
                                  <li><a href="blog-single.php" class="nav-link">Blog Sigle</a></li>
                                </ul>
                              </li> -->

                            <li class="{{ (request()->is('contact')) ? 'active' : '' }}"><a href="{{ route('contact') }}" class="nav-link">Contact Us</a></li>
                            <li><a href="{{ route('registration.index') }}" class="btn btn-menu">FREE Career Test</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">

                    <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse"
                       data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>

            </div>
        </div>

    </header>
</div>
{{-- <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Career Test') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
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
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</div> --}}
<main id="app">
    @yield('content')
</main>
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-4 mb-md-0">
                <h3>About Career Preference</h3>
              <p>
                  Careerpreference.com is an initiative of Ark Publications; a career guidance resources publisher, organizers of higher education exhibitions & training, and trusted career consultants based in Kuala Lumpur Malaysia since 1984.
              </p>

            </div>
            <div class="col-md-7 ml-auto">
                <div class="row site-section pt-0">
                    <div class="col-md-4 col-6 mb-4 mb-md-0">
                        <h3>Quick Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}">What is it</a></li>
                            <li><a href="{{ route('pricing') }}">Pricing</a></li>
                            <li><a href="{{ route('faqs') }}">FAQs</a></li>
                            <!--<li><a href="{{ route('blog') }}">Blog</a></li>-->
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-6 mb-4 mb-md-0">
                        <h3>Information</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('terms-and-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ url('disclaimer') }}">Disclaimer</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h3>Follow Us</h3>
                        <p class="social">
                            <!--<a href="#"><span class="icofont-linkedin"></span></a>-->
                            <!--<a href="#"><span class="icofont-twitter"></span></a>-->
                            <a href="http://facebook.com/careerpreference" target="_blank"><span class="icofont-facebook"></span></a>

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center text-center mt-5 pt-4">
            <div class="col-md-7">
                <p class="copyright">&copy;2021 Copyright Ark Publications. All Rights Reserved</p>
            </div>
        </div>

    </div>
</footer>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Scripts -->
{{-- <script>
    setTimeout(function(){
        $.getScript( {{ asset('vendor/jquery/jquery.min.js') }}, function() {
            $.getScript( {{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}, function() {
                $.getScript( {{ asset('vendor/jquery.easing/jquery.easing.min.js') }}, function() {
                    $.getScript( {{ asset('vendor/php-email-form/validate.js') }}, function() {
                            $.getScript( {{ asset('vendor/owl.carousel/owl.carousel.min.js') }}, function() {
                                $.getScript( {{ asset('vendor/aos/aos.js') }}, function() {
                                    $.getScript( {{ asset('js/app.js') }}, function() {
                                        $.getScript( {{ asset('js/main.js') }}, function() {
        });
        });
        });
        });
        });
        });
        });
        });
    }),1000;
</script> --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('vendor/jquery.easing/jquery.easing.min.js') }}" defer></script>
<script src="{{ asset('vendor/php-email-form/validate.js') }}" defer></script>
<script src="{{ asset('vendor/aos/aos.js') }}" defer></script>
<script src="{{ asset('vendor/owl.carousel/owl.carousel.min.js') }}" defer></script>
<script src="{{ asset('vendor/jquery-sticky/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<div>

    @yield('script')
</div>

</body>

</html>
