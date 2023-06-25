<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            if (auth()->user()->role == 3) {
                if (!auth()->user()->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice');
                }
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else if (auth()->user()->role == 2) {
                if (!auth()->user()->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice');
                } else {
                    $request->session()->regenerate();
                    return redirect()->intended('/seller');
                }
            } else if (auth()->user()->role == 1) {

                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
            $request->session()->forget('count');
        }
    }

    public function username()
    {
        return 'username';
    }
}
