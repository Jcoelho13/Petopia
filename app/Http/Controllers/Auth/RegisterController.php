<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\View\View;

use App\Models\GlobalUser;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a login form.
     */
    public function showRegistrationForm()
    {
        if(Auth::check()) {
            return redirect('/home');
        }
        return view('auth.register');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha|string|max:100',
            'last_name' => 'required|alpha|string|max:100',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|strong_password|confirmed'    
        ], ['first_name.required' => 'The first name field is required.',
            'first_name.alpha' => 'The first name must only contain letters.',
            'first_name.max' => 'The first name must not exceed 100 characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.alpha' => 'The last name must only contain letters.',
            'last_name.max' => 'The last name must not exceed 100 characters.',
            'email.required' => 'The email field is required.',
            'email.max' => 'The email must not exceed the 250 characters.',
            'email.unique' => 'The email provided already exists.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must have at least 8 characters.',
            'password.confirmed' => 'The password should include an uppercase letter, a lowercase letter, a number, and a symbol.'
        ]);

        $fullName = $request->first_name . ' ' . $request->last_name;

        $user = GlobalUser::create([
            'name' => $fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $shoppingCart = new Cart([
            'user_id' => $user->id,
        ]);

        $shoppingCart->save();

        $wishlist = new Wishlist([
            'user_id' => $user->id,
        ]);

        $wishlist->save();

        $wishlist_id = Wishlist::where('user_id', $user->id)->value('id');

        $shoppingCart_id = Cart::where('user_id', $user->id)->value('id');

        $user_details = new User([
            'id' => $user->id,
            'wishlist_id' => $wishlist_id,
            'shoppingcart_id' => $shoppingCart_id,
        ]);

        $user_details->save();


        $this->mergeGuestCart($user);
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
    }

    private function mergeGuestCart($user){
        $guestCart = session('guest_cart');
        if ($guestCart) {
            $userCart = Cart::getCartByUserId($user->id);
            $this->mergeCarts($guestCart, $userCart);
            session(['guest_cart' => []]);
        }
    }

    public function mergeCarts($guestCart, $userCart){
        foreach ($guestCart as $productId => $quantity) {
            if ($userCart->hasProduct($productId)) {
                $userCart->updateProductQuantity($productId, $quantity);
            } else {
                $userCart->addProduct($productId, $quantity);
            }
        }

        return $userCart;
    }
}
