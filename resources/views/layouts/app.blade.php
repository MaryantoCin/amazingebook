<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Amazing E-Book</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Amazing E-Book
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item d-flex">
                            <a class="nav-link" href="{{ route('set_locale', 'en') }}">
                                <img class="country" src="{{ asset('image/us.svg') }}" alt="EN">
                            </a>
                            <a class="nav-link" href="{{ route('set_locale', 'id') }}">
                                <img class="country" src="{{ asset('image/id.svg') }}" alt="ID">
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @auth
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                <div class="container d-flex justify-content-center">
                    <div class="navbar-nav">
                        <div class="nav-item d-flex justify-content-center">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                            <a class="nav-link" href="{{ route('show_cart') }}">{{ __('Cart') }}</a>
                            <a class="nav-link" href="{{ route('show_profile') }}">{{ __('Profile') }}</a>
                            @if (Auth::user()->role->desc == 'Admin')
                                <a class="nav-link"
                                    href="{{ route('show_account') }}">{{ __('Account Maintenance') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        @endauth
        <main class="py-4">
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">&copy; Amazing E-book 2022</span>
            </div>
        </footer>
    </div>
</body>

</html>
