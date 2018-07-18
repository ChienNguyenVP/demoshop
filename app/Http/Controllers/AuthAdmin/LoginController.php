<?php

namespace App\Http\Controllers\AuthAdmin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
	use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('authadmin.login');
    }
     public function logout(Request $request)
    {
        $this->guard()->logout();

        // $request->session()->invalidate();

        return redirect('/admin/login');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
