<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\MBWay;
use App\Models\CreditCard;
use App\Models\User_PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentMethodController extends Controller
{

    function showPaymentMethods()
    {
        if (Auth::check() && !Auth::user()->isAdmin()) {
            $paymentMethodIds = $this->getUserMethodIds();
            $paymentMethods = PaymentMethod::with('mbway', 'creditCards')
                ->whereIn('id', $paymentMethodIds)
                ->get();

            $paymentMethods = $paymentMethods->map(function ($method) {
                $methodType = ($method->mbway->isNotEmpty()) ? 'MBWAY' : 'Credit Card';
                $method['type'] = $methodType;
                return $method;
            });

            return view('profile.paymentmethods', ['methods' => $paymentMethods]);
        }
        return redirect('/home');
    }



    function showAddPaymentMethodForm(){
        if(Auth::check() && !Auth::user()->isAdmin()){
            return view('profile.paymentmethods_add');
        }
        return redirect('/home');
    }

    public function addPaymentMethod(Request $request)
    {
        $paymentType = $request->input('payment-type');
        $paymentMethodName = $request->input('payment-method-name');

        if ($paymentType === 'mbway') {
            $validatedData = $request->validate([
                'mbway-phone-number' => [
                    'required',
                    'digits:9',
                    'regex:/^(91|92|93|96)[0-9]{7}$/'
                ],
            ], [
                'mbway-phone-number.required' => 'Please enter a phone number.',
                'mbway-phone-number.digits' => 'The phone number must have 9 digits.',
                'mbway-phone-number.regex' => 'The phone number must start with 91, 92, 93 or 96.'
            ]);


            $phoneNumber = (string) $validatedData['mbway-phone-number'];

            $paymentMethod = new PaymentMethod([
                'name' => $paymentMethodName
            ]);
            $paymentMethod->save();

            $userPaymentMethod = new User_PaymentMethod();
            $userPaymentMethod->user_id = (int) Auth::user()->id();
            $userPaymentMethod->paymentmethod_id = $paymentMethod->id;
            $userPaymentMethod->save();

            $mbway = new MBWay([
                'phonenumber' => $phoneNumber,
                'paymentmethod_id' => $paymentMethod->id
            ]);
            $mbway->save();

            return redirect('/paymentmethods');

    } elseif ($paymentType === 'credit-card') {
            $validatedData = $request->validate([
                'credit-card-number' => [
                    'required',
                    'digits:16',
                    'numeric',
                ],
                'credit-card-cvv' => [
                    'required',
                    'digits:3',
                    'numeric',
                ],
                'credit-card-date' => [
                    'required',
                    'regex:/^(0[1-9]|1[0-2])\/[0-9]{4}$/',
                    function ($attribute, $value, $fail) {
                        $dateParts = explode('/', $value);
                        $month = (int)$dateParts[0];
                        $year = (int)$dateParts[1];

                        $currentMonth = date('n');
                        $currentYear = date('Y');

                        if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
                            $fail('The expiration date must be in the future.');
                        }
                    },
                ],
            ], [
                'credit-card-number.required' => 'Please enter a credit card number.',
                'credit-card-number.digits' => 'The credit card number must have 16 digits.',
                'credit-card-number.numeric' => 'The credit card number must be numeric.',
                'credit-card-cvv.required' => 'Please enter a CVV.',
                'credit-card-cvv.digits' => 'The CVV must have 3 digits.',
                'credit-card-cvv.numeric' => 'The CVV must be numeric.',
                'credit-card-date.required' => 'Please enter an expiration date.',
                'credit-card-date.regex' => 'The expiration date must be in the format MM/YYYY.',
            ]);

            $dateParts = explode('/', $validatedData['credit-card-date']);
            $date = Carbon::createFromDate($dateParts[1], $dateParts[0], 1)->endOfMonth()->toDateString();

            $paymentMethod = new PaymentMethod([
                'name' => $paymentMethodName
            ]);
            $paymentMethod->save();

            $userPaymentMethod = new User_PaymentMethod();
            $userPaymentMethod->user_id = (int) Auth::user()->id();
            $userPaymentMethod->paymentmethod_id = $paymentMethod->id;
            $userPaymentMethod->save();

            $creditCard = new CreditCard([
                'cvv' => (string) $validatedData['credit-card-cvv'],
                'number' => (string) $validatedData['credit-card-number'],
                'date' => $date,
                'paymentmethod_id' => $paymentMethod->id
            ]);
            $creditCard->save();


        }
        return redirect('/paymentmethods');
    }

    public function deletePaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        if($paymentMethod->user_id != Auth::id()){
            return redirect('/paymentmethods');
        }

        $purchaseExists = DB::table('purchase')
            ->where('paymentmethod_id', $id)
            ->exists();

        if ($purchaseExists) {
            return redirect('/paymentmethods')->withErrors(['You cannot delete a payment method that has been used in a purchase.']);
        }

        $mbwayExists = MBWay::where('paymentmethod_id', $id)->exists();
        $creditCardExists = CreditCard::where('paymentmethod_id', $id)->exists();

        if ($mbwayExists) {
            MBWay::where('paymentmethod_id', $id)->delete();
        } elseif ($creditCardExists) {
            CreditCard::where('paymentmethod_id', $id)->delete();
        } else {
            return redirect('/paymentmethods');
        }

        User_PaymentMethod::where('paymentmethod_id', $id)->delete();
        PaymentMethod::where('id', $id)->delete();

        return redirect('/paymentmethods');
    }



    public function getUserMethodIds()
    {
        $userId = Auth::id();

        return DB::table('user_paymentmethod')
            ->where('user_id', $userId)
            ->pluck('paymentmethod_id');
    }
}