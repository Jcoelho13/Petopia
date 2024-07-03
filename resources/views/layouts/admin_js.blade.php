@if(Route::currentRouteName() == 'admin.users')
    <script src="{{ url('js/admin_js/users.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.user')
    <script src="{{ url('js/admin_js/user.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.create.user')
    <script src="{{ url('js/admin_js/create_user.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.products')
    <script src="{{ url('js/admin_js/products.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.product')
    <script src="{{ url('js/admin_js/product.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.product.edit')
    <script src="{{ url('js/admin_js/edit_product.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.categories')
    <script src="{{ url('js/admin_js/categories.js') }}" defer></script>
@elseif(Route::currentRouteName() == 'admin.profile')
    <script src="{{ url('js/admin_js/profile.js') }}" defer></script>
@endif