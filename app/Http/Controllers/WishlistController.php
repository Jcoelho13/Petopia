<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class WishlistController extends Controller
{
    /**
     * Show the contents of the shopping cart.
     */
    public function displayWishlist()
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }
        $wishlist = Wishlist::getWishlistByUserId($user->getAuthIdentifier());
        return view('wishlist.wishlist', ['wishlist' => $wishlist]);
    }

    public function removeProduct($productId)
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }
        $wishlist = Wishlist::getWishlistByUserId($user->getAuthIdentifier());

        $product = Product::findOrFail($productId);

        if (!$product) {
            return redirect()->route('wishlist')->with('error', 'Product not found.');
        }

        $wishlist->removeProduct($productId);

        return redirect()->route('wishlist')->with('success', 'Product removed from wishlist.');
    }

    public function removeAllProducts()
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }
        $wishlist = Wishlist::getWishlistByUserId($user->getAuthIdentifier());

        $wishlist->removeAllProducts();

        return redirect()->route('wishlist')->with('success', 'All products removed from wishlist.');
    }

    public function addProduct($productId)
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }
        $wishlist = Wishlist::getWishlistByUserId($user->getAuthIdentifier());

        $product = Product::findOrFail($productId);

        try {
            $wishlist->addProduct($productId);
            return redirect()->route('wishlist')->with('success', 'Product added to wishlist.');
        } catch (\Exception $e) {
            return redirect('products/'.$productId)->with('error', $e);
        }
    }
}