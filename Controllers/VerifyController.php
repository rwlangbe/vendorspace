<?php

namespace vendorspace\Http\Controllers;

use DB;
use Auth;
use vendorspace\models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
	public function verify($token)
	{
		User::where('email_token', $token)->first()
			->update([
				'verified' => true,
		]);

		return redirect()->route('auth.signin')->with('success', 
			'Account verification completed. Thank you.');
	}

	public function preset($token)
	{
		return redirect()->route('verify.preset')
			->with('info', 'Choose a new password.')
			->with('token',$token);
	}

	public function getReset()
    {
        return view('verify.reset');
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
             'email' => 'required|email|max:255',
             'username' => 'required|alpha_dash|max:25|min:6',
        ]);

        $user = User::where([
        	['username', '=' ,$request->username],
        	['email', '=', $request->email],
        	])->first()
       		->update([
        		'verified' => false,
        ]);

		$user = User::where('username', $request->username)->first();

		$user->sendResetPasswordEmail($user);

        return redirect()->route('home')->with('info', 'Password Reset Sent.');
    }

    public function getPreset()
    {
        return view('verify.preset');
    }

    public function postPreset(Request $request)
    {
		$this->validate($request, [
            'username' => 'required|alpha_dash|max:25|min:6',
		    'newpassword' => 'required|min:6|confirmed',
		]);

		$user = User::where([
			['username', '=', $request->username],
			['verified', '=' , false],
			])->first()
			->update([
				'password' => bcrypt($request->input('newpassword')),
				'verified' => true,
		]);

        return redirect()->route('auth.signin')->with('info', 'Password Updated.');
    }
}