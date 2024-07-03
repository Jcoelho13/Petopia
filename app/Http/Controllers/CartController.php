<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the contents of the shopping cart.
     */
    public function displayCart()
    {
        $user = Auth::user();

        if ($user && !$user->isAdmin()) {
            $cart = Cart::getCartByUserId($user->getAuthIdentifier());
            return view('cart.cart', ['cart' => $cart]);
        }

        else if($user && $user->isAdmin()){
            return redirect()->route('home')->with('error', 'You are not allowed to do this.');
        }

        $guestCartId = session('guest_cart_id');

        if (!$guestCartId) {
            $guestCartId = $this->generateGuestCartId();
            session(['guest_cart_id' => $guestCartId]);
        }

        $guestCart = session('guest_cart');

        return view('cart.cart', ['cart' => $guestCart]);
    }

    /**
     * Remove a product from the shopping cart.
     */
    public function removeProduct($productId)
    {
        $user = Auth::user();
        if($user && $user->isAdmin()){
            return redirect()->route('home')->with('error', 'You are not allowed to do this.');
        }
        $cart = null;

        if (!$user) {
            $guestCart = session('guest_cart');

            if ($guestCart && array_key_exists($productId, $guestCart)) {
                unset($guestCart[$productId]);
                session(['guest_cart' => $guestCart]);
                return redirect()->route('cart')->with('success', 'Product removed from cart.');
            }
            return redirect()->route('cart')->with('error', 'Product not found.');
        }

        $cart = Cart::getCartByUserId($user->getAuthIdentifier());

        if ($cart) {
            $cart->removeProduct($productId);
            return redirect()->route('cart')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cart')->with('error', 'Cart not found.');
    }

    public function removeAllProducts()
    {
        $user = Auth::user();
        if($user && $user->isAdmin()){
            return redirect()->route('home')->with('error', 'You are not allowed to do this.');
        }
        $cart = null;

        if (!$user) {
            $guestCart = session('guest_cart');

            if ($guestCart) {
                session(['guest_cart' => []]);
                return redirect()->route('cart')->with('success', 'All products removed from cart.');
            }
            return redirect()->route('home')->with('error', 'Cart not found.');
        }

        $cart = Cart::getCartByUserId($user->getAuthIdentifier());

        if ($cart) {
            $cart->removeAllProducts();
            return redirect()->route('cart')->with('success', 'All products removed from cart.');
        }
        return redirect()->route('cart')->with('error', 'Cart not found.');
    }


    public function addProduct(Request $request, $productId)
    {
        $user = Auth::user();

        if (!$user) {
            $guestCartId = session('guest_cart_id');

            if (!$guestCartId) {
                $guestCartId = $this->generateGuestCartId();
                session(['guest_cart_id' => $guestCartId]);
            }

            $guestCart = session('guest_cart');
            $quantity = $request->input('quantity');
            $existingQuantity = isset($guestCart[$productId]) ? $guestCart[$productId] : 0;
            $guestCart[$productId] = $existingQuantity + $quantity;
            session(['guest_cart' => $guestCart]);

            return redirect('/cart')->with('success', 'Product added to cart successfully');
        } else if ($user->isAdmin()) {
            return redirect()->route('home')->with('error', 'You are not allowed to do this.');
        } else if ($user && !$user->isAdmin()) {
            $cart = Cart::getCartByUserId($user->getAuthIdentifier());
        }

        $quantity = $request->input('quantity');
        $product = Product::findOrFail($productId);

        if (!$product || $product->stock <= 0) {
            return redirect('products/'.$productId)->with('error', 'Product not available.');
        }

        if ($cart->addProduct($productId, $quantity)) {
            return redirect('/cart')->with('success', 'Product added to cart successfully');
        } else {
            return redirect('products/'.$productId)->with('error', 'Insufficient stock');
        }
    }

    private function generateGuestCartId()
    {
        return 'guest_' . uniqid();
    }
}
