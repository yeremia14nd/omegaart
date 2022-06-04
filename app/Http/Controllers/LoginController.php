<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials) && Gate::any(['superadmin', 'admin', 'estimator', 'teknisi'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard');
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user_id = Auth::user()->id;
            $cart = session('cart');

            if($cart) { //jika ada data session, maka data cart akan masuk ke db setelah login
                Cart::addToCart($user_id, $cart);
            }

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
