<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/677fcbda09.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Shopping') }}
            </a>
            @auth()
                <a class="navbar-brand" id="basket-link" href="{{ route('basket.show') }}">
                    <div class="d-none d-sm-block d-md-block">
                        <i class="fas fa-shopping-basket mr-1"></i>Basket
                        <small id="basketItemsCount">({{ $basketItems ?? 0 }})</small>
                    </div>
                    <div class="d-block d-sm-none d-md-none d-lg-none">
                        <i class="fas fa-shopping-basket mr-1"></i>
                        <small id="basketItemsCount">({{ $basketItems ?? 0 }})</small>
                    </div>
                </a>
                <a class="navbar-brand" href="{{ route('order.history') }}">
                    <div class="d-none d-sm-block d-md-block">
                        <i class="fas fa-history mr-1"></i>Orders
                    </div>
                    <div class="d-block d-sm-none d-md-none d-lg-none">
                        <i class="fas fa-history mr-1"></i>
                    </div>
                </a>
            @endauth
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script>
    let basket = {!! json_encode(session()->get('basket')) !!};
    let body = 'body';
    window.addEventListener('load', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @auth()
        basketStore.set(basket, true);
        $(body).on('click', '.buy-product', function () {
            let id = basketStore.getId(this);
            let quantity = basketStore.getQuantity(this);
            if (id && quantity) {
                storeToBasket({id: id, quantity: quantity}, this, "POST", "add");
            }
        });
        $(body).on('click', '.update-product', function () {
            let id = basketStore.getId(this);
            let quantity = basketStore.getQuantity(this);
            if (id && quantity) {
                storeToBasket({id: id, quantity: quantity}, this, "PUT", "update");
            }
        });
        $(body).on('click', '.remove-product', function () {
            let id = basketStore.getId(this);
            if (id) {
                removeFromBasket({id: id}, this);
            }
        });
        $(body).on('click', '#buy-button', function (event) {
            event.preventDefault();
            basketStore.reset();
            window.location.href = $(this).data("href");
        });
        @else
        $(body).on('click', '.buy-product', function () {
            window.location.href = "{{ route("login") }}";
        });
        @endauth
    });
</script>
</body>
</html>
