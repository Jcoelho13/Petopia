<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\GlobalUser;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->getAuthIdentifier())
            ->where('tracking_status', '!=', 'Canceled')
            ->get();

        $purchaseDetails = [];

        foreach ($purchases as $purchase) {
            $details = PurchaseDetail::where('purchase_id', $purchase->id)->get();
            $purchaseDetails[$purchase->id] = $details;
        }
        if (Auth::check() && !$user->isAdmin()) {
            return view('profile.profile_page', compact('user', 'purchases', 'purchaseDetails'));
        } else {
            return redirect('/login');
        }
    }

    public function editProfile()
    {
        $user = Auth::user();
        if (Auth::check() && !$user->isAdmin()) {
            return view('profile.edit_profile', compact('user'));
        } else {
            return redirect('/login');
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|alpha|string|max:100',
            'last_name' => 'required|alpha|string|max:100',
            'email' => 'required|email|max:250|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|min:8|strong_password|confirmed'
        ], [
            'first_name.required' => 'The first name field is required.',
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
        if (Auth::check() && !$user->isAdmin()) {
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
            return redirect('/profile')->withSuccess('Profile updated successfully!');
        } else {
            return redirect('/login');
        }
    }

    public function editProfilePicture()
    {
        $user = Auth::user();
        if (Auth::check() && !$user->isAdmin()) {
            return view('profile.edit_picture', compact('user'));
        } else {
            return redirect('/login');
        }
    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user(); // Use Auth::user() to get the authenticated user

        if (Auth::check() && !$user->isAdmin()) {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'profile_picture' => 'image|mimes:jpeg,png,jpg|max:1024|dimensions:max_width=1200,max_height=1200',
            ]);

            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect('/profile/edit-picture')
                    ->withErrors($validator)
                    ->withInput();
            }
            // If validation passes, process the image and save it
            if ($request->hasFile('profile_image')) {
                $filename = $request->file('profile_image')->store('image/profile_pictures', 'public');
                $user->profile_image = "storage/".$filename;
                $user->save();
                return redirect('/profile')->withSuccess('Profile picture updated successfully!');
            }

            return redirect('/profile/edit-picture')->with('error', 'Error updating profile picture.');
        } else {
            return redirect('/login');
        }
    }

    public function myReviews()
    {
        $user = Auth::user();
        if (Auth::check() && !$user->isAdmin()) {
            $reviews = DB::select('
            SELECT r.product_id, r.date, r.title, r.body, r.rating, p.name, p.image
            FROM review r JOIN product p ON r.product_id = p.id
            WHERE r.user_id = ?
            ', [$user->getAuthIdentifier()]);
            return view('profile.my-reviews', compact('reviews'));
        } else {
            return redirect('/login');
        }
    }

    public function deleteAccount($id){
        $user = Auth::user();
        if (Auth::check() && !$user->isAdmin()) {
            $user = User::findOrFail($id);
            $globalUser = GlobalUser::findOrFail($id);
            $cart = Cart::findOrFail($user->shoppingcart_id);
            $reviews = Review::where('user_id', $id)->get();
            $wishlist = Wishlist::where('user_id', $id)->first();
            $anonymousUser = User::where('id', 999999999)->first();

            foreach($reviews as $review){
                $review->update([
                    'user_id' => $anonymousUser->id
                ]);
            }

            DB::delete('delete from cartdetail where shoppingcart_id = ?', [$cart->id]);

            DB::delete('delete from shoppingcartnotification where shoppingcart_id = ?', [$cart->id]);

            DB::delete('delete from product_wishlist where wishlist_id = ?', [$wishlist->id]);

            DB::delete('delete from wishlistnotification where wishlist_id = ?', [$wishlist->id]);

            $userPurchases = Purchase::where('user_id', $user->id)->get();
            foreach($userPurchases as $userPurchase){
                $userPurchase->update([
                    'user_id' => $anonymousUser->id
                ]);
            }

            DB::delete('delete from user_paymentmethod where user_id = ?', [$user->id]);

            DB::delete('delete from notification where user_id = ?', [$user->id]);


            $user->delete();
            $cart->delete();
            $wishlist->delete();
            $globalUser->delete();

            return redirect()->route('home')->with('success', 'User deleted successfully');}
        else {
            return redirect('/home');
        }
    }
}
