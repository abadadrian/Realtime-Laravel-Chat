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

// Welcome Route
Route::get('/', function () {
	return view('welcome');
});


// Route (get) to show chat
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'showChat'])->name('chat.show');
// Route (post) message received
Route::post('/chat/message', [App\Http\Controllers\ChatController::class, 'messageReceived'])->name('chat.message');
// GENERAL ROUTES
Auth::routes();
// Home Route
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
// Shows users avatar img
Route::get('/user/avatar/{filename}', 'App\Http\Controllers\ProfileController@getImage')->name('user.avatar');

// ROUTE FOR COMMENTS
// Store the comment into an image
Route::post('/comment/store', 'App\Http\Controllers\CommentController@store')->name('comment.store');
// Delete you own message
Route::get('/comment/delete/{id}', 'App\Http\Controllers\CommentController@destroy')->name('comment.destroy');
// Get user comment image
Route::get('/comment/image/{filename}', 'App\Http\Controllers\CommentController@getImage')->name('comment.avatar');


// ROUTES FOR LIKES
// Store the like into an image
Route::get('/like/{image_id}', 'App\Http\Controllers\LikeController@like')->name('like.save');
// Delete the like into an image
Route::get('/dislike/{image_id}', 'App\Http\Controllers\LikeController@dislike')->name('like.delete');
// List of all likes
Route::get('/likes', 'App\Http\Controllers\LikeController@index')->name('likes');

// ROUTE FOR IMAGES
// Delete image
Route::get('/image/delete/{id}', 'App\Http\Controllers\ImageController@delete')->name('image.delete');
// Edit image
Route::get('/image/edit/{id}', 'App\Http\Controllers\ImageController@edit')->name('image.edit');
// Shows users avatar img IN HOME
Route::get('/image/file/{filename}', 'App\Http\Controllers\ImageController@getImage')->name('image.file');
// Show the image alone
Route::get('/image/{id}', 'App\Http\Controllers\ImageController@detail')->name('image.detail');
// Update image
Route::post('/image/update', 'App\Http\Controllers\ImageController@update')->name('image.update');
// Upload the image
Route::get('/upload', 'App\Http\Controllers\ImageController@create')->name('upload.image');
// Store the image
Route::post('/image/store', 'App\Http\Controllers\ImageController@store')->name('upload.store');

// ROUTES FOR ADMIN
// Show the admin panel users
Route::get('/admin/users', 'App\Http\Controllers\AdminController@viewUsers')->name('admin.users');
// Show the admin panel images
Route::get('/admin/images', 'App\Http\Controllers\AdminController@viewImages')->name('admin.images');

// Delete the user by id
Route::get('/admin/user/delete/{id}', 'App\Http\Controllers\AdminController@destroyUser')->name('admin.user.delete');
// Delete the image by id
Route::get('/admin/image/delete/{id}', 'App\Http\Controllers\AdminController@destroyImage')->name('admin.image.delete');

// Edit the user by id
Route::get('/admin/user/edit/{id}', 'App\Http\Controllers\AdminController@editUser')->name('admin.user.edit');
// Edit the image by id
Route::get('/admin/image/edit/{id}', 'App\Http\Controllers\AdminController@editImage')->name('admin.image.edit');

// Update the user by id
Route::put('/admin/user/update/{id}', 'App\Http\Controllers\AdminController@updateUser')->name('admin.user.update');

// Show the user by id
Route::get('/admin/user/show/{id}', 'App\Http\Controllers\AdminController@showUser')->name('admin.user.show');
// Show the image by id
Route::get('/admin/image/show/{id}', 'App\Http\Controllers\AdminController@showImage')->name('admin.image.show');


//Show all users and search (optional)
Route::get('/people/{search?}', 'App\Http\Controllers\ProfileController@index')->name('profile.index');

// Users in realtime using api
Route::view('/usersapi', 'user.showAll')->name('user.all');

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

// Route to delete a profile by id
Route::get('/profile/delete/{id}', 'App\Http\Controllers\ProfileController@destroy')->name('profile.delete');
// Delete and set to default the profile image
Route::get('/profile/image/delete/{id}', 'App\Http\Controllers\ProfileController@deleteImageProfile')->name('profile.image.delete');

Route::group(['middleware' => 'auth', 'language'], function () {
	// Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('profile/{id}', ['as' => 'profile.show', 'uses' => 'App\Http\Controllers\ProfileController@show']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
