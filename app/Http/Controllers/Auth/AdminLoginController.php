<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //Validate request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Define login credentials
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //Attempt to log the user in
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            //If successful, redirect to the intended destination
            return redirect()->intended(route('admin.dashboard'));
        }

        //If unsuccessful, redirect back to the login page with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
