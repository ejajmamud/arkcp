<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Career Test Portal') }}</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    

    {{-- <script href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> --}}
    <script src="{{asset('admin/js/Chart.min.js')}}"></script>
    <script href="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('admin/js/jquery-3.3.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/js/scripts.js') }}" defer></script>


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="app">

        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </form>
                {{-- <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('admin/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1" />
                            <div class="d-sm-none d-lg-inline-block">Hi, Shankar</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in</div>

                            <a href="features-settings.html" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Settings </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Logout </a>
                        </div>
                    </li>
                </ul> --}}
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
            </nav>
            <div class="main-sidebar" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                <aside id="sidebar-wrapper">
                  <div class="sidebar-brand">
                    <a href="{{url('/admin/dashboard')}}">
                        <img src="{{ asset('storage/blogassets/b5QflUyk6jY3BxALpiZb28gVsJ24tr20Q4VltaGa.jpg') }}" alt="Career Indicator" style="height: auto;margin-top: 8px;max-width: 100%;padding: 10px;">
                    </a>
                  </div>
                  <div class="sidebar-brand sidebar-brand-sm">
                    <a href="https://ooisolutions.asia/admin/dashboard">CT</a>
                  </div>
                  <ul class="sidebar-menu">
                      <li class="menu-header">Dashboard</li>

                  <li  class="{{ Request::is('admin/dashboard') ? 'nav-item active' : '' }}">
                        <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

                    </li>

                    <li class="{{ Request::is('admin/users') ? 'nav-item active' : '' }}">
                      <a class="nav-link" href="{{route('users')}}"><i class="fas fa-users"></i> <span>Students</span></a>
                    </li>
                    <li class="{{ Request::is('admin/payments') ? 'nav-item active' : '' }}">
                      <a class="nav-link beep beep-sidebar" href="{{route('payments')}}"><i class="fas fa-coins"></i> <span>Payments</span></a>
                    </li>
                    <li class="{{ Request::is('admin/questions') ? 'nav-item active' : '' }}">
                      <a class="nav-link" href="{{route('questions')}}"><i class="fas fa-file-alt"></i> <span>Questions</span></a>
                    </li>
                    <li class="{{ Request::is('admin/occupations') ? 'nav-item active' : '' }}">
                      <a class="nav-link" href="{{route('occupations')}}"><i class="fas fa-file-alt"></i> <span>Occupations</span></a>
                    </li>
                    <li class="{{ Request::is('admin/reports') ? 'nav-item active' : '' }}">
                      <a class="nav-link" href="{{route('reports', 0)}}"><i class="fas fa-file-alt"></i> <span>Reports</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i><span>CMS Options</span></a>
                        <ul class="dropdown-menu">
                          <li class="{{ Request::is('admin/cmshome') ? 'nav-item active' : '' }}"><a class="nav-link" href="{{route('cmshome')}}">Home Page</a></li>
                          <li class="{{ Request::is('admin/blogposts') ? 'nav-item active' : '' }}"><a class="nav-link" href="{{route('blogposts')}}">Blog Posts</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('admin/settings') ? 'nav-item active' : '' }}">
                      <a class="nav-link" href="{{route('settings')}}"><i class="fas fa-sliders-h"></i> <span>Settings</span></a>
                    </li>

                    @can('is-user')
                    <li>
                        <a class="nav-link beep beep-sidebar" href="{{route('userdashboard')}}"><i class="fas fa-coins"></i> <span>Dashboard</span></a>
                      </li>
                    <li>
                        <a class="nav-link beep beep-sidebar" href="{{route('test')}}"><i class="fas fa-coins"></i> <span>Take test</span></a>
                      </li>
                    <li>
                        <a class="nav-link beep beep-sidebar" href="{{route('settings')}}"><i class="fas fa-coins"></i> <span>My test</span></a>
                      </li>
                    @endcan
                  </ul>


                </aside>
              </div>
            <main class="py-4">
                @yield('admincontent')
            </main>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
            <script href="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    </body>

    </html>
