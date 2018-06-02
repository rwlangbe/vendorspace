<?php

namespace vendorspace\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use vendorspace\models\User;


class AuthController extends Controller
{
    public function getSignup()
    {
         return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
         $this->validate($request, [
             'email' => 'required|unique:users|email|max:255',
             'username' => 'required|unique:users|alpha_dash|max:25|min:6',
             'password' => 'required|min:6|confirmed',     	
             ]);

         $user = User::create([
         	'email' => $request->input('email'),
         	'username' => $request->input('username'),
         	'password' => bcrypt($request->input('password')),
            'email_token' => md5($request->input('email')),
            'login_ip' => $request->getClientIp(),
         ]);

         $user->sendVerificationEmail($user);

         return redirect()->route('index')->with('info', 
            'Verification email sent. Follow the link in your email to verify your identity.');
    }

    public function getSignin()
    {
    	return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        if (isset($_POST['login'])) {
        	$this->validate($request, [
        		'username' => 'required',
        		'password' => 'required',
        		]);

        	if (!Auth::attempt($request->only(['username', 'password']), 
        		$request->has('remember'))) {
                return redirect()->back()->with('info', 
                    'Sign in failed.  Enter your username to log in.');
        	}

        	return redirect()->route('landing.index');
        }

        elseif (isset($_POST['reset'])) {
            
            return redirect()->route('verify.reset');
        }
    }

    public function getSignout()
    {
    	Auth::logout();
    	return redirect()->route('index')->with('info', 'signed out successfully.');
    }
}