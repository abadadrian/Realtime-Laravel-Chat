<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Models\User;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// View to show all users
Route::view('/users', 'users.showAll')->name('users.all');

// Route (get) to show chat
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'showChat'])->name('chat.show');
// Route (post) message received
Route::post('/chat/message', [App\Http\Controllers\ChatController::class, 'messageReceived'])->name('chat.message');

