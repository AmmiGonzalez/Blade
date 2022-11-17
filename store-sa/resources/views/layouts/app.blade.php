<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Store SA') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="Navbar principalNavbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex flex-col align-items-center justify-content-center" href="{{ url('/') }}">
                    <i class="store-logo fa-brands fa-shopify"></i>
                    {{ __('Store online') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="searchContainer">
                        <input class="form-control me-2" type="search" placeholder="Buscar algún producto" aria-label="Search">
                        <button class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-row align-items-center justify-content-center" href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket mx-2"></i>
                                        {{ __('Iniciar sesión') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-row align-items-center justify-content-center" href="{{ route('register') }}">
                                        <i class="fa-solid fa-user-plus mx-2"></i>
                                        {{ __('Registrarse') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item mx-2">
                                <a class="nav-link d-flex flex-row align-items-center justify-content-center" href="{{ route('home') }}">
                                    <i class="fa-solid fa-basket-shopping mx-2"></i>
                                    {{ __('Carrito') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown mx-2">
                                <a id="n1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user-astronaut mx-2"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="n1">
                                    @if (Auth::user()->IDRol == 2 || Auth::user()->IDRol == 3)
                                        <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('home') }}">
                                            <i class="fa-solid fa-gauge-high"></i>
                                            {{ __('Dashboard') }}
                                        </a>
                                    @endif
                                    @if(Auth::user()->IDRol == 1)
                                        <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('home') }}">
                                            <i class="fa-solid fa-print"></i>
                                            {{ __('Cotización') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item d-flex align-items-center justify-content-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                        {{ __('Cerrar sesión') }}
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
        <nav class="Navbar secondaryNavbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-2">
                            <a class="nav-link d-flex flex-row align-items-center justify-content-center" href="{{ route('ver.productos') }}"> <i class="fa-solid fa-boxes-stacked mx-2"></i> {{ __('Productos') }} </a>
                        </li>
                        {{-- <li class="nav-item mx-2">
                            <a class="nav-link d-flex flex-row align-items-center justify-content-center" href="{{ route('home') }}"><i class="fa-solid fa-headphones-simple mx-2"></i> {{ __('Audio') }} </a>
                        </li> --}}
                        <li class="nav-item dropdown-center mx-2">
                            <a id="dd1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa-solid fa-microchip mx-1"></i> {{ __("Tecnología") }} </a>
                            <div class="dropdown-menu" aria-labelledby="dd1">
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-laptop"></i> <p>{{ __('Laptops') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-computer"></i> <p>{{ __('Computadoras y Accesorios') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-mobile-screen"></i> <p>{{ __('Celulares y accesorios') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-print"></i> <p>{{ __('Impresoras, escáneres y suministros') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-hard-drive"></i> <p>{{ __('Almacenamiento externo') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-clock"></i> <p>{{ __('Smartwatch\'s y bandas inteligentes') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-car-battery"></i> <p>{{ __('UPS\'s') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-ethernet"></i> <p>{{ __('Cables y adaptadores para computadoras') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-display"></i> <p>{{ __('Monitores para computadora') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-computer-mouse"></i> <p>{{ __('Mouse\'s') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-network-wired"></i> <p>{{ __('Redes y conexión inalámbrica') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-floppy-disk"></i> <p>{{ __('Software') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-keyboard"></i> <p>{{ __('Teclados') }}</p> </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown-center mx-2">
                            <a id="dd2" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-photo-film mx-1"></i>
                                {{ __("TV y video") }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dd2">
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-tv"></i> <p>{{ __('Televisores') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-headphones-simple"></i> <p>{{ __('Audífonos') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-volume-high"></i> <p>{{ __('Bocinas Bluetooth') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-car-on"></i> <p>{{ __('Auido para carro') }}</p> </a>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown-center mx-2">
                            <a id="dd4" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-gamepad mx-1"></i>
                                {{ __("Gaming") }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dd4">
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-microchip"></i> <p>{{ __('Procesadores') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-server"></i> <p>{{ __('Unidades de estado sólido (SSD)') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-headset"></i> <p>{{ __('Audífonos') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-suitcase-rolling"></i> <p>{{ __('Cases de computadora') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-gamepad"></i> <p>{{ __('Controles para PC') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-snowflake"></i> <p>{{ __('Enfriamiento líquido') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-car-battery"></i> <p>{{ __('Fuentes de poder certificadas') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-mouse"></i> <p>{{ __('Mouse\'s') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-hand"></i> <p>{{ __('Mousepads') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-chess-board"></i> <p>{{ __('Placas madre') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-desktop"></i> <p>{{ __('Monitores') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-keyboard"></i> <p>{{ __('Teclados') }}</p> </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('login') }}"> <i class="fa-solid fa-photo-video"></i> <p>{{ __('Tarjetas de video') }}</p> </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="SearchNavbar navbar navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="searchContainer">
                    <input class="form-control me-2" type="search" placeholder="Buscar algún producto" aria-label="Search">
                    <button class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
                </div>
            </div>
        </nav>

        <main class="app py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
