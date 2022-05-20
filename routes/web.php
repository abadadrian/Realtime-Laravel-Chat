<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

// View to show all users
Route::view('/users', 'users.showAll')->name('users.all');

// Route (get) to show chat
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'showChat'])->name('chat.show');
// Route (post) message received
Route::post('/chat/message', [App\Http\Controllers\ChatController::class, 'messageReceived'])->name('chat.message');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware(['auth', 'language']);

Route::get('/upload', 'App\Http\Controllers\ImageController@create')->name('upload.image')->middleware(['auth', 'language']);
Route::post('/image/store', 'App\Http\Controllers\ImageController@store')->name('upload.store')->middleware(['auth', 'language']);

// Shows users avatar img
Route::get('/user/avatar/{filename}', 'App\Http\Controllers\ProfileController@getImage')->name('user.avatar');

// Shows users avatar img IN HOME
Route::get('/image/file/{filename}', 'App\Http\Controllers\ImageController@getImage')->name('image.file');

// Show the image alone
Route::get('/image/{id}', 'App\Http\Controllers\ImageController@detail')->name('image.detail');

// Store the comment into an image
Route::post('/comment/store', 'App\Http\Controllers\CommentController@store')->name('comment.store')->middleware(['auth', 'language']);

// Delete you own message
Route::get('/comment/delete/{id}', 'App\Http\Controllers\CommentController@destroy')->name('comment.destroy')->middleware(['auth', 'language']);

// Store the like into an image
Route::get('/like/{image_id}', 'App\Http\Controllers\LikeController@like')->name('like.save')->middleware(['auth', 'language']);

// Delete the like into an image
Route::get('/dislike/{image_id}', 'App\Http\Controllers\LikeController@dislike')->name('like.delete')->middleware(['auth', 'language']);

// List of all likes
Route::get('/likes', 'App\Http\Controllers\LikeController@index')->name('likes.index')->middleware(['auth', 'language']);

// Delete image
Route::get('/image/delete/{id}', 'App\Http\Controllers\ImageController@delete')->name('image.delete')->middleware(['auth', 'language']);


Route::group(['middleware' => 'language', 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth', 'language'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
