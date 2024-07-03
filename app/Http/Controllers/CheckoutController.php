<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function showCheckout(){
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }
        $cart = Cart::getCartByUserId($user->getAuthIdentifier());
        if ($cart->products()->count() === 0) {
            return redirect('/cart');
        }
        $paymentMethodIds = DB::table('user_paymentmethod')
            ->where('user_id', $user->getAuthIdentifier())
            ->pluck('paymentmethod_id');

        $paymentMethods = PaymentMethod::with('mbway', 'creditCards')
            ->whereIn('id', $paymentMethodIds)
            ->get();

        $data = [
            'cart' => $cart,
            'paymentMethods' => $paymentMethods,
        ];
        return view('static.checkout', $data);
    }

    public function processCheckout(Request $request)
    {
        $selectedMethod = $request->input('payment_method');
        if ($selectedMethod === 'add_payment_method') {
            return redirect('/paymentmethods')->with('message', 'Please add a payment method');
        }

        $user_id = auth::user()->getAuthIdentifier();
        $paymentMethodId = $request->input('payment_method');
        $shippingAddress = $request->input('shipping_address');
        $cart = Cart::getCartByUserId($user_id);
        $products = $cart->products()->get();
        if ($products->count() === 0) {
            return redirect('/cart');
        }
        DB::beginTransaction();

        try {

            $purchase = Purchase::create([
                'user_id' => $user_id,
                'paymentmethod_id' => $paymentMethodId,
                'tracking_status' => 'Pending',
                'tracking_number' => null,
                'address' => $shippingAddress,
            ]);

            foreach ($products as $product) {
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->product_id,
                    'quantity' => $product->quantity,
                    'price' => $product->price*$product->quantity,
                ]);
            }

            Cart::clearCart();

            DB::commit();

            return redirect()->route('purchase-history.details', ['id' => $purchase->id]);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return redirect()->route('error-page');
        }
    }
}