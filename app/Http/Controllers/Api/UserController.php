<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        // Return all users
        return User::all();
    }

    public function store(Request $request)
    {
        // Get data and create a new user
        $data = $request->all();
        //Bcrypt the password
        $data['password'] = bcrypt($request->password);

        // Return user created
        return User::create($data);
    }

    public function show(User $user)
    {
        // Return the user
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        //Bcrypt the password
        $data['password'] = bcrypt($request->password);
        // Fill the data
        $user->fill($data);
        // Save the user
        $user->save();
        // Return the user
        return $user;
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();
        // Return the user
        return $user;
    }
}
