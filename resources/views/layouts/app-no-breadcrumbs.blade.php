@php
    use App\Models\Notifications\Notification;
    use Illuminate\Support\Facades\Auth;
        $unreadNotifications = Notification::with('notify')
            ->where('user_id', Auth::id())
            ->where('is_read', false)
            ->orderBy('date', 'desc')
            ->get();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.styles')
    <script src={{ url('js/app.js') }} defer></script>
    <script src="{{ asset('js/topbar.js') }}" defer></script>


</head>
<body>
    <header>
        @if (Auth::check())
            <a class="store_logo" href="{{ url('/admin') }}"><img src="{{URL::asset('/image/logo.png')}}" alt="Petopia Store Logo"><h1> Petopia Store</h1></a>
            <a class="to_hide" href="{{ url('/about-us') }}">About Us</a>
            <a class="to_hide" href="{{ url('/products') }}">Products</a>
            <a class="to_hide" href="{{ url('/features') }}">Features</a>
            <a class="to_hide" href="{{ url('/faq') }}">FAQ</a>
            <div class="dropdown">
                <button class="dropbtn header_a notification_circle">
                    <span class="white">Dashboard</span>
                    @if(count($unreadNotifications) > 0)
                        <span class="unread-indicator"></span>
                    @endif
                </button>
                <div class="dropdown-content">
                    <a href="{{ url('/profile') }}">Profile</a>
                    <a href="{{ url('/notifications') }}" class="notification_circle">
                        Notifications
                        @if(count($unreadNotifications) > 0)
                            <span class="unread-indicator"></span>
                        @endif
                    </a>
                    <a href="{{ url('/wishlist') }}">Wishlist</a>
                    <a href="{{ url('/cart') }}">Cart</a>
                </div>
            </div>
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
                <a class="authentication side-menu-link" href="{{ url('/logout') }}"> Logout </a>
            </div>
        @else
            <a class="store_logo" href="{{ url('/admin') }}"><img src="{{URL::asset('/image/logo.png')}}" alt="Petopia Store Logo"><h1> Petopia Store</h1></a>
            <a class="to_hide" href="{{ url('/about-us') }}">About Us</a>
            <a class="to_hide" href="{{ url('/products') }}">Products</a>
            <a class="to_hide" href="{{ url('/features') }}">Features</a>
            <a class="to_hide" href="{{ url('/faq') }}">FAQ</a>
            <a class="to_hide" href="{{ url('/cart') }}">Cart</a>
            @if (Request::is('login'))
                <a class="button authentication" href="{{ url('/register') }}">Register</a>
            @else
                <a class="button authentication" href="{{ url('/login') }}">Login</a>
            @endif
        @endif
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="moss-green-bg b footer">
        &copy; {{ date('Y') }} Petopia Store
    </footer>
</body>
</body>
</html>