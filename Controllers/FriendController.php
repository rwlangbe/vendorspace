<?php

namespace vendorspace\Http\Controllers;

use Auth;
use vendorspace\models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();

		return view('friends.index')
			->with('friends', $friends)
			->with('requests', $requests);
	}

	public function getAdd($username)
	{
		$user = User::where('username', $username)->first();
		if (!$user) {
			return redirect()->route('home')
				->with('info', 'User not found.');
		}

		if (Auth::user()->id === $user->id) {
			return redirect()->route('home');
		}

		if (Auth::user()->hasFriendRequestsPending($user) ||
			$user->hasFriendRequestsPending(Auth::user())) {
			return redirect()
				->route('profile.index', ['username' => $user->username])
				->with('info', 'Friend request already pending.');
		}

		if (Auth::user()->isFriendsWith($user)) {
			return redirect()
				->route('profile.index', ['username' => $user->username])
				->with('info', 'Already friends.');
		}
		Auth::user()->addFriend($user);

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request sent.');

	}

	public function getAccept($username)
	{
		$user = User::where('username', $username)->first();

		if (!$user) {
			return redirect()->route('home')
				->with('info', 'User not found.');
		}

		if (!Auth::user()->hasFriendRequestsReceived($user)) {
			return redirect()->route('home');
		}

		Auth::user()->acceptFriendRequest($user);

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request accepted.');
	}

	public function postDelete($username)
	{
		$user = User::where('username', $username)->first();
		if (!Auth::user()->isFriendsWith($user)) {
			return redirect()->back();
		}
		Auth::user()->deleteFriend($user);
		return redirect()->back()->with('info', 'Friendship Cancelled.');
	}

}