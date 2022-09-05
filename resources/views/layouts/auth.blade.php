<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-white sticky-sm-top">
            <div class="container">

                <!-- Navbar Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Mental Health Application
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('professional.profile.view') }}">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>  
        </nav>

        <div class="cointainer-fluid bg-white">
            <div class="container">
                <!-- header title -->
                <h1>Welcome Back Professional</h1>

                <!-- header nav -->
                <ul class="nav">

                    <!-- Event page -->
                    <li class="nav-item">
                        <a class="nav-link active ps-0" aria-current="page" href="{{route('professional.event.view')}}">Event</a>
                    </li>
                    <!-- Appointment page -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('professional.appointment.view')}}">Appointment</a>
                    </li>
                    <!-- home page -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('professional.home')}}">Dashboard</a>
                    </li>
                    <!-- content page -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('professional.content.view')}}">Content</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Transaction</a>
                    </li>

                    @if(auth()->user()->is_admin == 1)

                    <li class="nav-item">
                        <a class="nav-link link-danger" href="{{route('administrator.content.view')}}">Administrator</a>
                    </li>
                           
                    @endif
                    
                </ul>
            </div>
        </div>

        <!-- main content -->
        <main>
            @yield('content')
        </main>

        <footer>
            <div class="cointainer">
                <div style="height:10vh">

                </div>
            </div>
        </footer>
    </div>
</body>
</html>
