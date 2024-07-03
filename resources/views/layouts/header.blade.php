@php
    use App\Models\Notifications\Notification;
    use Illuminate\Support\Facades\Auth;
        $unreadNotifications = Notification::with('notify')
            ->where('user_id', Auth::id())
            ->where('is_read', false)
            ->orderBy('date', 'desc')
            ->get();
@endphp

<header>
    <h1><a href="{{ url('/home') }}"><img src="{{URL::asset('/image/logo.png')}}" alt="Petopia Store Logo"> Petopia
            Store</a></h1>
    @if (Auth::check())
        <a class="button header_a" href="{{ url('/about-us') }}">About Us</a>
        <a class="button header_a" href="{{ url('/products') }}">Products</a>
        <a class="button header_a" href="{{ url('/features') }}">Features</a>
        <a class="button header_a" href="{{ url('/faq') }}">FAQ</a>
        <div class="dropdown">
            <button class="dropbtn header_a notification_circle">
                Dashboard
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
        <a class="button authentication" href="{{ url('/logout') }}"> Logout </a>
    @elseif (!Auth::check())
        <a class="button header_a" href="{{ url('/about-us') }}">About Us</a>
        <a class="button header_a" href="{{ url('/products') }}">Products</a>
        <a class="button header_a" href="{{ url('/features') }}">Features</a>
        <a class="button header_a" href="{{ url('/faq') }}">FAQ</a>
        <a class="button header_a" href="{{ url('/cart') }}">Cart</a>
        @if (Request::is('login'))
            <a class="button authentication" href="{{ url('/register') }}">Register</a>
        @else
            <a class="button authentication" href="{{ url('/login') }}">Login</a>
        @endif
    @endif
</header>