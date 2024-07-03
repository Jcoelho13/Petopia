<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        @include('layouts.admin_styles')

        <!-- Scripts -->
        <script src="{{ asset('js/topbar.js') }}" defer></script>
        @include('layouts.admin_js')
    </head>
    <body>
        <header>
            @if (Auth::check())
            <a class="store_logo" href="{{ url('/admin') }}"><img src="{{URL::asset('/image/logo.png')}}" alt="Petopia Store Logo"><h1> Petopia Store</h1></a>
            <a class="to_hide" href="{{ url('/about-us') }}">About Us</a>
            <a class="to_hide" href="{{ url('/products') }}">Products</a>
            <a class="to_hide" href="{{ url('/features') }}">Features</a>
            <a class="to_hide" href="{{ url('/faq') }}">FAQ</a>
            <a class="to_hide" href="{{ url('/admin') }}">Admin Dashboard</a>
            <a class="authentication to_hide" href="{{ url('/logout') }}"> Logout </a>
            <div class="to_show" id="menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="menu hidden" id="side-menu">
                <div class="to_show" id="menu2">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <a class="side-menu-link" href="{{ url('/about-us') }}">About Us</a>
                <a class="side-menu-link" href="{{ url('/products') }}">Products</a>
                <a class="side-menu-link" href="{{ url('/features') }}">Features</a>
                <a class="side-menu-link" href="{{ url('/faq') }}">FAQ</a>
                <a class="side-menu-link" href="{{ url('/admin') }}">Admin Dashboard</a>
                <a class="authentication side-menu-link" href="{{ url('/logout') }}"> Logout </a>
            </div>
            @endif
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="moss-green-bg b footer">
            &copy; {{ date('Y') }} Petopia Store
        </footer>
    </body>
</html>