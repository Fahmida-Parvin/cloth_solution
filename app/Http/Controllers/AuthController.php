<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //show login page
    public function showLogin()
    {
        return view('pages.login');
    }

    //show reg page
    public function showRegister()
    {
        return view('pages.register');
    }
    //reg user

    public function postRegister(Request $request)
    {
        //validation
        $request->validate([

            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        //registration
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        //login

        Auth::login($user);

        //retrun

        return back();
    }

    //login user
    public function postLogin(Request $request)
    {
        //validation
        $details = $request->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        //login

        if(Auth::attempt($details))
        {
            return redirect()->intended('/');
        }

        //retrun

        return back()->withErrors([
            'email' => 'Invalid Login Details'
        ]);
    }
    //reset pass

    //logout

    public function logout(){
        Auth::logout();
        return back();
    }
}
