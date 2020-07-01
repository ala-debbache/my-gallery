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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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

        <main class="py-4">
            @auth
                <div class="container">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <div class="row">
                        <div class="col col-md-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('users.index')}}">All users</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('categories.index')}}">All categories</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('tags.index')}}">All tags</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('posts.index')}}">All posts</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('trashed.index')}}">Trashed posts</a>
                                </li>
                            </ul>
                            <ul class="list-group mt-3">
                                <li class="list-group-item">
                                    <a href="{{route('categories.create')}}">Create categories</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('tags.create')}}">Create tags</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('posts.create')}}">Create posts</a>
                                </li>
                            </ul>
                            <ul class="list-group mt-3">
                                <li class="list-group-item">
                                    <a href="{{route('user.edit')}}">Edit profile</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col col-md-9">
                            <div class="container">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    @yield('content')
                </div>
            @endauth
            
        </main>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    @yield('scripts')
</body>
</html>
