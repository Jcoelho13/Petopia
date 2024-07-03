<?php

namespace App\Http\Controllers;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PurchaseHistoryController extends Controller
{
    public function showPurchaseHistory()
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your purchase history.');
        }
        $purchases = Purchase::where('user_id', $user->getAuthIdentifier())->get();

        $purchaseDetails = [];

        foreach ($purchases as $purchase) {
            $details = PurchaseDetail::where('purchase_id', $purchase->id)->get();
            $purchaseDetails[$purchase->id] = $details;
        }

        $data = [
            'purchases' => $purchases,
            'purchaseDetails' => $purchaseDetails,
        ];

        return view('profile.purchasehistory', $data);
    }


    public function showPurchaseDetails($id){
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your purchase history.');
        }
        $purchase = Purchase::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        if (!$purchase) {
            return redirect()->route('purchase-history')->with('error', 'Purchase not found or unauthorized access.');
        }
        $purchaseDetails = PurchaseDetail::where('purchase_id', $id)->get();


        $data = [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ];

        return view('profile.purchasedetails', $data);
    }

    public function cancelOrder($id) {
        $purchase = Purchase::find($id);
        $purchaseDetails = PurchaseDetail::where('purchase_id', $id)->get();

        if (!$purchase) {
            return redirect()->back()->withErrors(['error' => 'Purchase not found']);
        }

        if ($purchase->tracking_status === 'Delivered') {
            return redirect()->back()->withErrors(['error' => "Can't cancel an order that has been delivered"]);
        }

        if ($purchase->tracking_status === 'Canceled') {
            return redirect()->back()->withErrors(['error' => "Can't cancel an order that has been canceled"]);
        }

        if ($purchase->tracking_status === 'Shipped') {
            return redirect()->back()->withErrors(['error' => "Can't cancel an order that has been shipped"]);
        }

        DB::beginTransaction();

        try {
            $purchase->tracking_status = 'Canceled';
            $purchase->save();

            foreach ($purchaseDetails as $purchaseDetail) {
                $product = $purchaseDetail->product;
                $product->stock += $purchaseDetail->quantity;
                $product->save();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Order canceled successfully');
        } catch (\Exception $e) {
            DB::rollback();

            \Log::error($e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Failed to cancel the order']);
        }
    }

    public function trackingForm() {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return redirect()->route('login')->with('error', 'Please login to view your purchase history.');
        }
        return view('profile.tracking');
    }

    public function track(Request $request) {
        $user = Auth::user();
        if (!$user || $user->isAdmin()) {
            return response()->json(['error' => 'Please login to view your purchase history.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'tracking_number' => 'required|max:8',
        ], [
            'tracking_number.required' => 'Tracking number is required.',
            'tracking_number.max' => 'Tracking number must not exceed 8 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $trackingNumber = $request->input('tracking_number');

        $purchase = DB::table('purchase')
            ->where('tracking_number', $trackingNumber)
            ->first();

        if (!$purchase) {
            return response()->json(['error' => 'Tracking number not found.'], 404);
        }

        $trackingStatus = $purchase->tracking_status;
        $deliveryDate = now()->addDays(2)->format('l, F jS');

        return response()->json(['trackingStatus' => $trackingStatus, 'purchase' => $purchase, 'deliveryDate' => $deliveryDate]);
    }

}