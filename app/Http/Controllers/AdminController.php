<?php

namespace App\Http\Controllers;


use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\GlobalUser;
use App\Models\User;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Purchase;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public $timestamps  = false;

    public function adminDashboard()
    {
        // Fetch all users that are not admins
        $nonAdminUsers = GlobalUser::where('is_admin', false)->get();

        // Pass the non-admin users to the view
        if(Auth::check() && Auth::user()->isAdmin()) {
            return view('admin.admin')->with('nonAdminUsers', $nonAdminUsers);
        } else {
            return redirect('/login');
        }
    }
    
    /* User management related functions */

    public function adminViewUsers(Request $request){
        $query = GlobalUser::where('is_admin', false);  

        $sortBy = $request->input('sort_by', 'id_asc'); // Default sorting by ID ascending
        if ($sortBy === 'name_asc') {
            $query->orderBy('name');
        } elseif ($sortBy === 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sortBy === 'id_asc') {
            $query->orderBy('id');
        } elseif ($sortBy === 'id_desc') {
            $query->orderBy('id', 'desc');
        }

        if ($request->has('search')) {
            $searchQuery = $request->input('search');
            $searchField = $request->input('search_by');

            if ($searchField === 'email') {
                $query->where('email', 'ILIKE', '%' . $searchQuery . '%');
            } elseif ($searchField === 'name') {
                $query->where('name', 'ILIKE', '%' . $searchQuery . '%');
            }
        } 
        
        $query->where('id', '!=', 999999999);

        $nonAdminUsers = $query->get();

        if(Auth::check() && Auth::user()->isAdmin()) {
            return view('admin.users', compact('nonAdminUsers'));
        } else {
            return redirect('/login');
        }
    }

    public function adminUserInfo($id){
        if(Auth::check() && Auth::user()->isAdmin()) {
            $user = User::find($id);
            $globalUser = GlobalUser::find($id);
            $data = [
                'user' => $user,
                'globalUser' => $globalUser
            ];

            return view('admin.user', $data);

        } else {
            return redirect('/');
        }
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $globalUser = GlobalUser::findOrFail($id);

        $data = [
            'user' => $user,
            'globalUser' => $globalUser
        ];

        if(Auth::check() && Auth::user()->isAdmin()){
            return view('admin.edit_user', $data);
        } else {
            return redirect('/');
        }
    }

    public function updateUser(Request $request, $id)
    {
        if(Auth::check() && Auth::user()->isAdmin()){

        $user = User::findOrFail($id);
        $globalUser = GlobalUser::findOrFail($id);
        
        $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:250|unique:users,email,' . $id,
            'password' => 'nullable|min:8|strong_password',
            'address' => 'nullable|string|max:400',
            'wallet' => 'nullable|numeric|min:0',
        ]);
        
        if ($request->has('name') && $request->name != $globalUser->name) {
            $globalUser->name = $request->name;
        }

        if ($request->has('email') && $request->email != $globalUser->email) {
            $globalUser->email = $request->email;
        }

        if ($request->has('password') && !Hash::check($request->password, $globalUser->password)) {
            $globalUser->password = Hash::make($request->password);
        }

        if ($request->has('address') && $request->address != $user->address) {
            $user->address = $request->address;
        }

        if ($request->has('wallet') && $request->wallet != $user->wallet) {
            $user->wallet = $request->wallet;
        }
        
        $globalUser->save();
        $user->save();
        
        return redirect()->route('admin.user', ['id' => $globalUser->id])->with('success', 'User info updated successfully');}
        else {
            return redirect('/');
        }
    }

    public function deleteUser($id)
    {
        if(Auth::check() && Auth::user()->isAdmin()){
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

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');}
        else {
            return redirect('/login');
        }
    }

    public function deleteUserReview($user_id, $review_id)
    {
        if(Auth::check() && Auth::user()->isAdmin()){
            $review = Review::findOrFail($review_id);
            $review->delete();

            return redirect()->route('admin.user', $user_id)->with('success', 'Review deleted successfully');
        }
        else {
            return redirect('/login');
        }
    }

    public function createUserForm()
    {
        if(Auth::check() && Auth::user()->isAdmin()){
        return view('admin.create_user');
    }
    else {
        return redirect('/login');
    }
    }

    public function createUser(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'first_name' => 'required|alpha|string|max:100',
                'last_name' => 'required|alpha|string|max:100',
                'email' => 'required|email|max:250|unique:users',
                'password' => 'required|min:8|strong_password|confirmed',
                'is_Admin' => 'nullable|boolean'
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

            $globalUser = GlobalUser::create([
                'name' => $fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->has('is_Admin') ? 1 : 0
            ]);

            if($request->is_Admin){
                $admin = Admin::create([
                    'id' => $globalUser->id
                ]);
            }

            else{              
                //Falta a wishlist
                $user = User::create([
                    'id' => $globalUser->id,
                    'wallet' => 0
                ]);

                $cart = Cart::create([
                    'user_id' => $user->id,
                ]);

                $user->update([
                    'shoppingcart_id' => $cart->id,
                ]);
            }

            return redirect()->route('admin.users')->withSuccess('Account created successfully!');
        } 
        
        else {
            return redirect('/');
        }
    }

    public function banOrUnbanUser($id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $globalUser = GlobalUser::findOrFail($id);

            if($globalUser->isbanned == 0){
                $globalUser->update([
                    'isbanned' => 1
                ]);
            }

            else{
                $globalUser->update([
                    'isbanned' => 0
                ]);
            }

            return redirect()->route('admin.user', ['id' => $globalUser->id])->with('success', 'User updated successfully!');
        }

        else {
            return redirect('/');
        }
    }

    /* Product management related functions */

    public function viewProducts(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $query = Product::where('description', '!=', '');

            $sortBy = $request->input('sort_by', 'id'); // Default sorting by ID
            if ($sortBy === 'name_asc') {
                $query->orderBy('name');
            } elseif ($sortBy === 'name_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($sortBy === 'id_asc') {
                $query->orderBy('id');
            } elseif ($sortBy === 'id_desc') {
                $query->orderBy('id', 'desc');
            }

            if ($request->has('search')) {
                $searchQuery = $request->input('search');
                $query->where('name', 'ILIKE', '%' . $searchQuery . '%');
            }

            $products = $query->get();

            return view('admin.products', ['products' => $products]);
        } else {
            return redirect('/');
        }
    }

    public function viewProduct($id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $product = Product::find($id);
            return view('admin.product', ['product' => $product]);
        } else {
            return redirect('/');
        }
    }

    public function deleteProduct($product_id){
        if(Auth::check() && Auth::user()->isAdmin()){
            ProductCategory::where('product_id', $product_id)->delete();
            
            $product = Product::findOrFail($product_id);
            $product->delete();
                
            return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
        }
        else {
            return redirect('/login');
        }
    }

    /*
    public function deleteProductReview($product_id, $review_id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $review = Review::findOrFail($review_id);
            $review->delete();
    
            return redirect()->route('admin.product', $product_id)->with('success', 'Review deleted successfully');
        }
        else {
            return redirect('/login');
        }
    }
    */

    public function createProduct(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'product_name' => 'required|alpha|string|max:100',
                'description' => 'required|alpha|string|max:300',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'tags' => 'required|alpha|string|max:200',
            ], ['product_name.required' => 'The product name field is required.',
                'product_name.alpha' => 'The product name must only contain letters.',
                'product_name.max' => 'The product name must not exceed 100 characters.',
                'description.required' => 'The description field is required.',
                'description.alpha' => 'The description must only contain letters.',
                'description.max' => 'The description must not exceed 300 characters.',
                'price.required' => 'The price field is required.',
                'price.min' => 'The price must be greater than 0.',
                'stock.required' => 'The stock field is required.',
                'stock.min' => 'The stock must be greater than 0.',
                'tags.required' => 'The tags field is required.',
                'tags.alpha' => 'The tags must only contain letters.',
                'tags.max' => 'The tags must not exceed 200 characters.',
            ]);

            $selectedCategories = Collection::wrap($request->input('categoriy', []))->map(fn($category) => intval($category))->toArray();
            if($request->has('product_image')){
                $filename = $request->file('product_image')->store('image/products', 'public');
            }
                
            else{
                $filename = 'image/products/default_product.png';
            }

            $product = Product::create([
                'name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'tags' => $request->tags,
                'image' => "storage/".$filename,
            ]);

            foreach($selectedCategories as $requestCategory){
                $category = Category::where('name', $requestCategory)->first();
                $productCategory = ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category->id
                ]);
            }

            return redirect()->route('admin.products')->withSuccess('Product created successfully!');
        }

        else {
            return redirect('/login');
        }
    }    

    public function editProduct($id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $product = Product::findOrFail($id);
            $categories = Category::all();
            return view('admin.edit_product', ['product' => $product, 'categories' => $categories]);
        }
        else {
            return redirect('/login');
        }
    }

    public function addCategoryToProduct(Request $request, $id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $product = Product::findOrFail($id);
            $category = Category::where('id', $request->categoryID)->first();
            $action = $request->action;

            if($action === 'Add'){
                $productCategory = ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category->id
                ]);
            }

            else{
                $productCategory = ProductCategory::where('product_id', $product->id)->where('category_id', $category->id)->first();
                $productCategory->delete();
            }

            return redirect()->route('admin.product.edit', ['id' => $product->id])->with('success', 'Category added successfully!');
        }

        else {
            return redirect('/login');
        }
    }

    public function updateProduct(Request $request, $id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'product_name' => 'required|string|max:100',
                'description' => 'required|string|max:300',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'tags' => 'required|string|max:200',
                'product_image' => 'image|mimes:jpeg,png,jpg|max:1024|dimensions:max_width=1200,max_height=1200',
            ], ['product_name.required' => 'The product name field is required.',
                'product_name.max' => 'The product name must not exceed 100 characters.',
                'description.required' => 'The description field is required.',
                'description.max' => 'The description must not exceed 300 characters.',
                'price.required' => 'The price field is required.',
                'price.min' => 'The price must be greater than 0.',
                'stock.required' => 'The stock field is required.',
                'stock.min' => 'The stock must be greater than 0.',
                'tags.required' => 'The tags field is required.',
                'tags.max' => 'The tags must not exceed 200 characters.',
                'product_image.image' => 'The product image must be an image.',
                'product_image.max' => 'The product image must not exceed 1024MB.',
                'product_image.dimensions' => 'The product image must not exceed 1200x1200 pixels.',
                'product_image.mimes' => 'The product image must be a jpeg, png or jpg file.',
            ]);

            $product = Product::findOrFail($id);

            $old_product_stock = $product->stock;
            $old_product_price = $product->price;

            $product->update([
                'name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'tags' => $request->tags,
            ]);

            $product->save();

            return redirect()->route('admin.product', ['id' => $product->id])->with('success', 'Product updated successfully!');
        }

        else {
            return redirect('/login');
        }
    }

    public function updateProductImage(Request $request, $id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $product = Product::findOrFail($id);

            // Validate the request data
            $validator = Validator::make($request->all(), [
                'product_image' => 'image|mimes:jpeg,png,jpg|max:1024|dimensions:max_width=1200,max_height=1200',
            ]);

            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect('/admin/products/' . $id . '/edit')
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->hasFile('product_image')) {
                $filename = $request->file('product_image')->store('image/products', 'public');
                $product->image = "storage/".$filename;
                $product->save();
                return redirect()->route('admin.product.edit', ['id' => $product->id])->with('success', 'Product image updated successfully!');
            }

            return redirect('/profile/edit-picture')->with('error', 'Error updating profile picture.');
        }
        else {
            return redirect('/login');
        }
    }

    public function createProductPage(){
        if(Auth::check() && Auth::user()->isAdmin()){
            return view('admin.create_product', ['categories' => Category::all()]);
        }
        else {
            return redirect('/login');
        }
    }

    public function adminProfile(){
        if(Auth::check() && Auth::user()->isAdmin()){
            $admin = GlobalUser::find(Auth::user()->id);
            return view('admin.profile', ['admin' => $admin]);
        }
        else {
            return redirect('/login');
        }
    }

    public function updateAdminProfile(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'name' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:250|unique:users,email,' . Auth::user()->id,
                'password' => 'nullable|min:8|strong_password',
            ]);
            
            $admin = GlobalUser::find(Auth::user()->id);
            
            if ($request->has('name') && $request->name != $admin->name) {
                $admin->name = $request->name;
            }
    
            if ($request->has('email') && $request->email != $admin->email) {
                $admin->email = $request->email;
            }
    
            if ($request->has('password') && !Hash::check($request->password, $admin->password)) {
                $admin->password = Hash::make($request->password);
            }
            
            $admin->save();
            
            return redirect()->route('admin.admin')->with('success', 'Admin info updated successfully');
        }
        else {
            return redirect('/login');
        }
    }

    /* Purchase related functions */
    public function updatePurchaseTracking(Request $request, $user_id, $purchase_id){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'tracking' => 'required|string|max:100',
            ], ['tracking.required' => 'The tracking field is required.',
                'tracking.max' => 'The tracking must not exceed 100 characters.',
            ]);

            $purchase = Purchase::findOrFail($purchase_id);

            if ($request->tracking === 'Shipped' && $purchase->tracking_status !== 'Shipped') {

                $unique = false;
                $trackingNumber = '';

                while (!$unique) {
                    $trackingNumber = Str::random(mt_rand(5, 8));

                    $existingPurchase = Purchase::where('tracking_number', $trackingNumber)->first();

                    if (!$existingPurchase) {
                        $unique = true;
                    }
                }

                $purchase->update([
                    'tracking_status' => $request->tracking,
                    'tracking_number' => $trackingNumber,
                ]);

                $purchase->save();

                return redirect()->route('admin.user', ['id' => $user_id])->with('success', 'Tracking updated successfully!');
            }

            $purchase->update([
                'tracking_status' => $request->tracking,
            ]);

            $purchase->save();

            return redirect()->route('admin.user', ['id' => $user_id])->with('success', 'Tracking updated successfully!');
        }

        else {
            return redirect('/login');
        }
    }

    /* Categories */
    public function viewCategories(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $query = Category::where('name', '!=', '');

            $sortBy = $request->input('sort_by', 'id'); // Default sorting by ID
            if ($sortBy === 'name_asc') {
                $query->orderBy('name');
            } elseif ($sortBy === 'name_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($sortBy === 'id_asc') {
                $query->orderBy('id');
            } elseif ($sortBy === 'id_desc') {
                $query->orderBy('id', 'desc');
            }

            if ($request->has('search')) {
                $searchQuery = $request->input('search');
                $query->where('name', 'ILIKE', '%' . $searchQuery . '%');
            }

            $categories = $query->get();

            return view('admin.categories', ['categories' => $categories]);
        }
        else {
            return redirect('/login');
        }
    }

    public function createCategory(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'category_name' => 'required|string|max:100',
            ], ['category_name.required' => 'The category name field is required.',
                'category_name.max' => 'The category name must not exceed 100 characters.',
            ]);

            $category = Category::create([
                'name' => $request->category_name,
            ]);

            return redirect()->route('admin.categories')->withSuccess('Category created successfully!');
        }

        else {
            return redirect('/login');
        }
    }

    public function deleteCategory(Request $request){
        if(Auth::check() && Auth::user()->isAdmin()){
            $request->validate([
                'category_id' => 'required|numeric',
            ], ['category_id.required' => 'The category id field is required.',
                'category_id.numeric' => 'The category id must be a number.',
            ]);

            $category = Category::findOrFail($request->category_id);
            $category->delete();

            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
        }

        else {
            return redirect('/login');
        }
    }
}