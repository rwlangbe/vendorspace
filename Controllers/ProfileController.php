<?php

namespace vendorspace\Http\Controllers;

use Auth;
use vendorspace\models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function getProfile($username)
	{
		$user = User::where('username', $username)->first();

		if (!$user) {
			abort(404);
		}

		$statuses = $user->statuses()->notReply()->get();

		return view('user.profile.index')
			->with('user', $user)
			->with('statuses', $statuses)
			->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
	}

	public function getEdit()
	{
		return view('user.profile.edit');
	}

	public function postEdit(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'alpha|max:50',
		    'last_name' => 'alpha|max:50',
			'city' => 'alpha_spaces|max:50',
			'state' => 'alpha|max:50',
			'country' => 'alpha_spaces|max:150'
		]);

		Auth::user()->update([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'city' => $request->input('city'),
			'state' => $request->input('state'),
			'country' => $request->input('country'),
		]);
		return redirect()->route('profile.edit')
			->with('info', 'Profile updated.');
	}

	public function getEdit2()
	{
		return view('user.profile.edit');
	}

	public function postEdit2(Request $request)
	{
		$this->validate($request, [
			'oldpassword' => 'required|min:6',
		    'newpassword' => 'required|min:6|confirmed',
		]);

		Auth::user()->update([
			'password' => bcrypt($request->input('newpassword')),
		]);
		return redirect()->route('profile.edit')
			->with('info', 'Password updated.');
	}
}