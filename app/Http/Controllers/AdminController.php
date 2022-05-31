<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Image;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;




class AdminController extends Controller
{

    public function viewUsers()
    {
        //Get all users
        $users = User::all();
        //Return view with users
        // Paginate
        $users = User::paginate(8);
        return view('admin.index', ['users' => $users]);
    }

    // Get all the images and return to the view
    public function viewImages()
    {
        // Get all the images
        $images = Image::all();
        //Return view with images
        // Paginate
        $images = Image::paginate(8);
        return view('admin.images', ['images' => $images]);
    }

    public function showUser($id)
    {
        // Get user
        $user = User::find($id);
        // Return to the profile view of the user
        return view('profile.show', ['user' => $user]);
    }

    // Show image by id
    public function showImage($id)
    {
        // Get image
        $image = Image::find($id);
        // Return to the image view of the image
        return view('image.detail', ['image' => $image]);
    }


    public function editUser($id)
    {
        //Edit user by id
        $user = User::find($id);
        return view('admin.editUser', ['user' => $user]);
    }

    // Edit the image by id
    public function editImage($id)
    {
        //Edit image by id
        $image = Image::find($id);
        return view('admin.editImage', ['image' => $image]);
    }

    public function updateUser(Request $request, $id)
    {
        // Update user by id
        $user = User::find($id);
        // Upload image
        $image_path = $request->file('image_path');
        if ($image_path) {
            // Unique filename
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Storage in users disk the image
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // Set filename into the object
            $user->image = $image_path_name;
        }
        $user->update($request->all());
        dd($user);

        return back()->withStatus(__('Profile successfully updated.'));
    }


    public function destroyUser($id)
    {
        $user = User::find($id);
        $comments = Comment::where('user_id', $id)->get();
        $likes = Like::where('user_id', $id)->get();
        $images = Image::where('user_id', $id)->get();

        // If profile image of user is different than default, delete from disk to save local space
        if ($user->image != 'default.jpg') {
            Storage::disk('users')->delete($user->image);
        }

        // Delete all comments of usere
        foreach ($comments as $comment) {
            $comment->delete();
        }
        // Delete all likes of user
        foreach ($likes as $like) {
            $like->delete();
        }
        // Delete all comments in the images of user
        foreach ($images as $image) {
            $comments = Comment::where('image_id', $image->id)->get();
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }
        // Delete all likes in the images of user
        foreach ($images as $image) {
            $likes = Like::where('image_id', $image->id)->get();
            foreach ($likes as $like) {
                $like->delete();
            }
        }
        // Delete all images of user
        foreach ($images as $image) {
            $image->delete();
        }
        // Delete user
        $user->delete();
        return back()->withStatus(__('User successfully deleted.'));
    }

    // Delete image by id
    public function destroyImage($id)
    {
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        // Delete all comments in the image
        foreach ($comments as $comment) {
            $comment->delete();
        }
        // Delete all likes in the image
        foreach ($likes as $like) {
            $like->delete();
        }
        // Delete image
        $image->delete();
        return back()->withStatus(__('Image successfully deleted.'));
    }
}
