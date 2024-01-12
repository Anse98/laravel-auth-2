<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="position-sticky start-0 end-0 top-0">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-azure m-0 p-0 bg-dark-grey border-bottom">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center py-0" href="{{ url('/') }}">
                        <div class="logo_laravel">
                            <img class="header-logo" src="{{Vite::asset('resources/img/header-logo.png')}}" alt="">
                        </div>
                        {{-- config('app.name', 'Laravel') --}}
                    </a>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link color-light-grey" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link color-light-grey" href="{{ route('register') }}"><b>{{ __('Register') }}</b></a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown d-flex align-items-center">
                                <a class="nav-link color-light-grey" href="{{route('admin.projects.index')}}"><b>Progetti</b></a>
                                <a class="nav-link color-light-grey" href="{{route('admin.project_types.index')}}"><b>Gestione Tipo di Progetto</b></a>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle color-light-grey" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <b>{{ Auth::user()->name }}</b> 
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right   bg-dark" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item color-light-grey" href="{{route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                                    <a class="dropdown-item color-light-grey" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                    <a class="dropdown-item color-light-grey" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        </header>
        

        <main class="bg-dark-grey">
            @yield('content')
        </main>
    </div>
</body>

</html>
