<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

/**
* Home
*/
Route::get('current/user_id', function () {
   return Auth::id();
});

Route::get('current/user_name/{id}', [
   'uses' => '\vendorspace\Http\Controllers\ArticlesController@getNameOrUsername'
]);

Route::get('/', [
   'uses' => '\vendorspace\Http\Controllers\HomeController@index',
   'as' => 'home',
]);

Route::get('/index', [
   'uses' => '\vendorspace\Http\Controllers\HomeController@index',
   'as' => 'home',
]);
/**
* Alert
*/
Route::get('/alert', function () {
    return redirect()->route('home')->with('info', 'You have signed up!');
});
/**
* Authentication
*/
Route::get('/reset', [
   'uses' => '\vendorspace\Http\Controllers\VerifyController@getReset',
   'as' => 'verify.reset',
   'middleware' => ['guest'],
]);

Route::post('/reset', [
   'uses' => '\vendorspace\Http\Controllers\VerifyController@postReset',
   'middleware' => ['guest'],
]);

Route::get('/preset', [
   'uses' => '\vendorspace\Http\Controllers\VerifyController@getPreset',
   'as' => 'verify.preset',
   'middleware' => ['guest'],
]);

Route::post('/preset', [
   'uses' => '\vendorspace\Http\Controllers\VerifyController@postPreset',
   'middleware' => ['guest'],
]);

Route::get('/signup', [
   'uses' => '\vendorspace\Http\Controllers\AuthController@getSignup',
   'as' => 'auth.signup',
   'middleware' => ['guest'],
]);

Route::post('/signup', [
   'uses' => '\vendorspace\Http\Controllers\AuthController@postSignup',
   'middleware' => ['guest'],
]);

Route::get('/signin', [
   'uses' => '\vendorspace\Http\Controllers\AuthController@getSignin',
   'as' => 'auth.signin',
   'middleware' => ['guest'],
]);

Route::post('/signin', [
   'uses' => '\vendorspace\Http\Controllers\AuthController@postSignin',
   'middleware' => ['guest'],
]);

Route::get('/signout', [
   'uses' => '\vendorspace\Http\Controllers\AuthController@getSignout',
   'as' => 'auth.signout',
]);

Route::get('/vendorarea', [
   'uses' => '\vendorspace\Http\Controllers\GuestController@getVendorarea',
   'as' => 'guest.vendorarea',
]);

Route::get('/plannerarea', [
   'uses' => '\vendorspace\Http\Controllers\GuestController@getPlannerarea',
   'as' => 'guest.plannerarea',
]);

Route::get('/entertainerarea', [
   'uses' => '\vendorspace\Http\Controllers\GuestController@getEntertainerarea',
   'as' => 'guest.entertainerarea',
]);

/**
* Search
*/

Route::get('search', [
	'uses' => '\vendorspace\Http\Controllers\SearchController@getResults',
	'as' => 'search.results',
]);

/**
* User Profile
*/
Route::get('/verify/{email_token}', 'VerifyController@verify')->name('verify');
Route::get('/preset/{email_token}', 'VerifyController@preset')->name('preset');

Route::get('/user/{username}',[
	'uses' => '\vendorspace\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile.index',
]);

Route::get('/profile/edit', [
   'uses' => '\vendorspace\Http\Controllers\ProfileController@getEdit',
   'as' => 'profile.edit',
   'middleware' => ['auth'],	
]);

Route::post('/profile/edit', [
   'uses' => '\vendorspace\Http\Controllers\ProfileController@postEdit',
   'middleware' => ['auth'],	
]);

Route::get('/profile/edit', [
   'uses' => '\vendorspace\Http\Controllers\ProfileController@getEdit2',
   'as' => 'profile.edit',
   'middleware' => ['auth'],  
]);

Route::post('/profile/edit', [
   'uses' => '\vendorspace\Http\Controllers\ProfileController@postEdit2',
   'middleware' => ['auth'],  
]);
/**
* Friends
*/
Route::get('/friends', [
   'uses' => '\vendorspace\Http\Controllers\FriendController@getIndex',
   'as' => 'friend.index',
   'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}', [
   'uses' => '\vendorspace\Http\Controllers\FriendController@getAdd',
   'as' => 'friend.add',
   'middleware' => ['auth'],
]);

Route::get('/friends/accept/{username}', [
   'uses' => '\vendorspace\Http\Controllers\FriendController@getAccept',
   'as' => 'friend.accept',
   'middleware' => ['auth'],
]);

Route::post('/friends/delete/{username}', [
   'uses' => '\vendorspace\Http\Controllers\FriendController@postDelete',
   'as' => 'friend.delete',
   'middleware' => ['auth'],
]);
/**
* Statuses
*/
Route::post('/status', [
   'uses' => '\vendorspace\Http\Controllers\StatusController@postStatus',
   'as' => 'status.post',
   'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/reply', [
   'uses' => '\vendorspace\Http\Controllers\StatusController@postReply',
   'as' => 'status.reply',
   'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like', [
   'uses' => '\vendorspace\Http\Controllers\StatusController@getLike',
   'as' => 'status.like',
   'middleware' => ['auth'],  
]);

/**
* Event
*/
Route::get('/event/create', [
   'uses' => '\vendorspace\Http\Controllers\EventController@getEventCreate',
   'as' => 'event.createevent',
   'middleware' => ['auth'],
]);

Route::get('/event/finder', [
   'uses' => '\vendorspace\Http\Controllers\EventController@getEventFinder',
   'as' => 'event.findevent',
   'middleware' => ['auth'],
]);

Route::get('/event/calendar', [
   'uses' => '\vendorspace\Http\Controllers\EventController@getCalendar',
   'as' => 'event.calendar',
   'middleware' => ['auth'],
]);

Route::post('/event/calendar', [
   'uses' => '\vendorspace\Http\Controllers\EventController@postCalendar',
   'as' => 'event.calendar',
   'middleware' => ['auth'],
]);

