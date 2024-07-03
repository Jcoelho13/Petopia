@if(Route::currentRouteName() == 'register' || Route::currentRouteName() == 'login')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/responsive.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'products')
    <link href="{{ url('css/products.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'products.show')
    <link href="{{ url('css/product_show.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'products.search')
    <link href="{{ url('css/products.css') }}" rel="stylesheet">
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
@elseif(Route::currentRouteName() == 'admin.admin')
    <link href="{{ url('css/admin_css/admin_dashboard.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.users')
    <link href="{{ url('css/admin_css/users.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.user')
    <link href="{{ url('css/admin_css/user.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.user.edit')
    <link href="{{ url('css/admin_css/edit_user.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.create.user')
    <link href="{{ url('css/admin_css/create_user.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.products')
    <link href="{{ url('css/admin_css/products.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.product')
    <link href="{{ url('css/admin_css/product.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.product.edit')
    <link href="{{ url('css/admin_css/edit_product.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.product.create')
    <link href="{{ url('css/admin_css/create_product.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.profile')
    <link href="{{ url('css/admin_css/profile.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@elseif(Route::currentRouteName() == 'admin.categories')
    <link href="{{ url('css/admin_css/categories.css') }}" rel="stylesheet">
    <link href="{{ url('css/top_bar.css') }}" rel="stylesheet">
@endif