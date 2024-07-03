@if(Route::currentRouteName() == 'register' || Route::currentRouteName() == 'login')
    <link href="{{ url('css/login_register.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'home')
    <link href="{{ url('css/home.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'profile.show')
    <link href="{{ url('css/profile.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'products')
    <link href="{{ url('css/products.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'products.show')
    <link href="{{ url('css/product_show.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'products.search')
    <link href="{{ url('css/products.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'profile.my-reviews')
    <link href="{{ url('css/my-reviews.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'features')
    <link href="{{ url('css/features.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'faq')
    <link href="{{ url('css/faq.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'about-us')
    <link href="{{ url('css/about_us.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'cart')
    <link href="{{ url('css/cart.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'wishlist')
    <link href="{{ url('css/wishlist.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'checkout')
    <link href="{{ url('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'profile.edit')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'profile.editPicture')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'payment-methods')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'payment-methods.add')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'purchase-history')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
    @elseif(Route::currentRouteName() == 'purchase-history.details')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'notification.all')
    <link href="{{ url('css/notifications.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'recover.password')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/recover-password.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'purchase-history.tracking')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
    <link href="{{ url('css/purchase.css') }}" rel="stylesheet">
@endif