<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function redirectTo()
    {
        // dd(Auth::user()->role);


        // if (Auth::user()->role != config('constant.STUDENT')) {
        //    return redirect(route('login'));
        // }
        switch (Auth::user()->role) {
            case "1":
                $this->redirectTo = '/admin/dashboard';
                return $this->redirectTo;
                break;
            case "2":
                $this->redirectTo = '/admin/dashboard';
                return $this->redirectTo;
                break;
            case "3":
                $this->redirectTo = '/';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/admin/dashboard'; //if user doesn't have any role
                return $this->redirectTo;
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->middleware('guest')->except('logout');
    }
}
