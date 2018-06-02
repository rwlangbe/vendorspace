<?php

namespace vendorspace\Http\Controllers;

use Auth;
use vendorspace\models\Status;

class HomeController extends Controller
{
	public function index()
	{
		if (Auth::check()){
			$statuses = Status::notReply()->where(function($query) {
				return $query
					->where('user_id', Auth::user()->id)
					->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
			})
			->orderBy('created_at', 'desc')
			->paginate(10);
			return view('landing.index')
				->with('statuses', $statuses);
		}

		return redirect()->route('index');
	}
}