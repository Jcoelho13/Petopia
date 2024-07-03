<?php
 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\GlobalUser;
use App\Models\Token;
use App\Models\Cart;

class LoginController extends Controller
{

    /**
     * Display a login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/home');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            if($user->isbanned == 1){
                Auth::logout();
                return redirect('/login')->with('error', 'Your account has been banned.');
            }

            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->isAdmin()) {
                $guestCart = session('guest_cart');
                if ($guestCart) {
                    $userCart = Cart::getCartByUserId($user->getAuthIdentifier());
                    $this->mergeCarts($guestCart, $userCart);
                    session(['guest_cart' => []]);
                }
            }

            if ($user->isAdmin()) {
                return redirect('/admin');
            } else {
                return redirect()->intended('/home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')
            ->withSuccess('You have logged out successfully!');
    }

    public function showRecoverPasswordForm(){
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.recover_password');
    }

    public function showResetPasswordForm($token){
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('emails.recover_password_form', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        if (Auth::check()) {
            return redirect('/home');
        }

        $token = $request->input('token');

        $tokenRecord = Token::where('token_value', $token)->where('is_active', 1)->first();

        if (!$tokenRecord) {
            return redirect('/login')->with('error', 'Invalid or expired token.');
        }

        $password = $request->input('password');
        $password_conf = $request->input('password_confirmation');

        if($password!=$password_conf){
            return redirect()->back()->withErrors(['passwords' => 'Passwords are not the same'])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'strong_password',
            ],
        ], [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must have at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.strong_password' => 'The password must have at least an uppercase letter, a lowercase letter, a number, and a symbol.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newPassword = Hash::make($request->password);

        $userId = $tokenRecord->user_id;
        $user = GlobalUser::find($userId);
        $user->password = $newPassword;
        $user->save();

        $tokenRecord->is_active = 0;
        $tokenRecord->save();

        return redirect('/login')->with('success', 'Password reset successfully. Please log in with your new password.');
    }
    public function mergeCarts($guestCart, $userCart){
        foreach ($guestCart as $productId => $quantity) {
            if ($userCart->hasProduct($productId)) {
                $userCart->updateQuantity($productId, $quantity);
            } else {
                $userCart->addProduct($productId, $quantity);
            }
        }

        return $userCart;
    }
}
