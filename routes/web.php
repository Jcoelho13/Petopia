<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    if(Auth::check() && Auth::user()->isAdmin()) {
        return redirect('/admin');
    }
    return redirect('/home');
});

// Home
Route::get('/home', [HomePageController::class, 'showHomePage'])->name('home');

// Static Pages
Route::get('/about-us', function () {return view('static.aboutus');})->name('about-us');
Route::get('/contacts', function () {return view('static.contacts');})->name('contacts');
Route::get('/features', function () {return view('static.features');})->name('features');
Route::get('/faq', function () {return view('static.faq');})->name('faq');

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/recover-password', 'showRecoverPasswordForm')->name('recover.password');
    Route::get('/recover-password/{token}', 'showResetPasswordForm')->name('reset.password');
    Route::post('/recover-password/{token}', 'resetPassword')->name('update.password');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Profile
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'showProfile')->name('profile.show');
    Route::get('/profile/edit', 'editProfile')->name('profile.edit');
    Route::post('/profile/edit', 'updateProfile')->name('profile.update');
    Route::get('/profile/my-reviews', 'myReviews')->name('profile.my-reviews');
    Route::get('/profile/edit-picture', 'editProfilePicture')->name('profile.editPicture');
    Route::post('/profile', 'updateProfilePicture')->name('profile.updatePicture');
    Route::delete('/profile/{id}', 'deleteAccount')->name('profile.delete');
});

// Products
Route::controller(ProductController::class)->group(function () {
    Route::get('/products','list')->name('products');
    Route::get('/products/{id}','show')->name('products.show');
    Route::get('/products/{productId}/get-average-rating', [ProductController::class, 'getAverageRating']);
});

// Shopping Cart
Route::controller(CartController::class)->group(function () {
    Route::get('/cart','displayCart')->name('cart');
    Route::post('/cart/add/{productId}','addProduct')->name('cart.add');
    Route::get('/cart/remove/{product}','removeProduct')->name('cart.remove');
    Route::get('/cart/remove','removeAllProducts')->name('cart.remove-all');
});

// Checkout
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'showCheckout')->name('checkout');
    Route::post('/checkout', 'processCheckout')->name('checkout.process');
});

Route::controller(ReviewController::class)->group(function () {
    Route::post('/reviews', [ReviewController::class, 'addReview'])->name('reviews.add');
    Route::delete('/products/{productId}/reviews/{reviewId}', [ReviewController::class, 'deleteReview'])->name('reviews.delete');
    Route::put('/products/{productId}/reviews/{reviewId}', [ReviewController::class, 'updateReview'])->name('reviews.update');
});

Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'displayWishlist'])->name('wishlist');
    Route::get('/wishlist/add/{product}', [WishlistController::class, 'addProduct'])->name('wishlist.add');
    Route::get('/wishlist/remove/{product}', [WishlistController::class, 'removeProduct'])->name('wishlist.remove');
    Route::get('/wishlist/remove', [WishlistController::class, 'removeAllProducts'])->name('wishlist.remove-all');
});

// Notifications
Route::controller(NotificationController::class)->group(function() {
    Route::get('/notifications','notifications')->name('notification.all');
    Route::post('/notification/{id}', 'markAsRead')->name('notification.read');

});

// Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'adminDashboard')->name('admin.admin');

    //Rotas User
    Route::get('/admin/users', 'adminViewUsers')->name('admin.users');
    Route::get('/admin/users/{id}', 'adminUserInfo')->name('admin.user');

    Route::get('admin/createUser', 'createUserForm')->name('admin.create.user');
    Route::post('admin/createUser', 'createUser');

    Route::get('admin/users/{id}/{purchase_id}/tracking', 'updatePurchaseTracking')->name('admin.user.review.del');
    Route::post('admin/users/{id}/manage', 'banOrUnbanUser')->name('admin.ban.unban.user');

    Route::get('admin/users/{id}/edit', 'editUser')->name('admin.user.edit');
    Route::post('admin/users/{id}', 'updateUser')->name('admin.user.update');
    Route::get('admin/users/{id}/{review_id}', 'deleteUserReview')->name('admin.user.review.delete');
    Route::delete('admin/users/{id}', 'deleteUser')->name('admin.user.delete');

    //Rotas Product
    Route::get('admin/products', 'viewProducts')->name('admin.products');
    Route::get('admin/products/{id}', 'viewProduct')->name('admin.product');

    Route::get('admin/products/{id}/edit', 'editProduct')->name('admin.product.edit');
    Route::get('admin/products/{id}/edit/category', 'addCategoryToProduct')->name('admin.product.category.add');
    Route::post('admin/products/{id}/edit/image', 'updateProductImage')->name('admin.product.image.update');
    Route::post('admin/products/{id}', 'updateProduct')->name('admin.product.update');

    Route::get('admin/createProduct', 'createProductPage')->name('admin.product.create');
    Route::post('admin/createProduct/addImage', 'addNewProductImage')->name('admin.product.create.image.add');
    Route::post('admin/createProduct/addCategory', 'addCategoryNewProduct')->name('admin.product.create.category.add');
    Route::post('admin/createProduct', 'createProduct');
    Route::delete('admin/products/{id}', 'deleteProduct')->name('admin.product.delete');
    Route::get('admin/products/{id}/{review_id}', 'deleteProductReview')->name('admin.product.review.delete');

    Route::get('admin/profile', 'adminProfile')->name('admin.profile');
    Route::post('admin/profile', 'updateAdminProfile')->name('admin.profile.update');

    //Rotas Category
    Route::get('admin/categories', 'viewCategories')->name('admin.categories');
    Route::get('admin/categories/create', 'createCategory')->name('admin.category.create');
    Route::get('admin/categories/delete', 'deleteCategory')->name('admin.category.delete');
});


// static

Route::get('/about-us', function () {
    return view('static.aboutus');
})->name('about-us');
Route::get('/contacts', function () {
    return view('static.contacts');
})->name('contacts');
Route::get('/features', function () {
    return view('static.features');
})->name('features');
Route::get('/faq', function () {
    return view('static.faq');
})->name('faq');


// payment method
Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('/paymentmethods', 'showPaymentMethods')->name('payment-methods');
    Route::get('/paymentmethods/add', 'showAddPaymentMethodForm')->name('payment-methods.add');
    Route::post('/paymentmethods/add', 'addPaymentMethod');
    Route::delete('/paymentmethods/{id}', 'deletePaymentMethod')->name('payment-methods.delete');
});

Route::controller(PurchaseHistoryController::class)->group(function () {
    Route::get('/purchasehistory', 'showPurchaseHistory')->name('purchase-history');
    Route::get('/purchasehistory/{id}', 'showPurchaseDetails')->name('purchase-history.details');
    Route::post('/purchasehistory/{id}', 'cancelOrder')->name('purchase-history.cancel');
    Route::get('/track', 'trackingForm')->name('purchase-history.tracking');
    Route::post('/track', 'track');
});

Route::controller(MailController::class)->group(function () {
    Route::post('/recover-password/mail', 'send')->name('password.email');
});
