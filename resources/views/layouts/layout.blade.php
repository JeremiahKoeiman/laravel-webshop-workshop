<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Sticky Footer Navbar Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('css/sticky-footer-navbar.css')}}" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Fixed navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                @hasanyrole('sales|admin')
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"
                        >
                            Admin
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('categories.index') }}" class="dropdown-item">Category Admin</a>
                            <a href="{{ route('products.index') }}" class="dropdown-item">Product Admin</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Something else here</a>
                        </div>
                    </li>
                @endhasanyrole
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">Product Test</a>
                </li>
            </ul>
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
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
    </div>
</footer>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
