<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Image;


class ProfileController extends Controller
{
    public function index($search = null)
    {
        if (!empty($search)) {
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('surname', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(4);
        } else {
            $users = User::orderBy('id', 'desc')
                ->paginate(4);
        }

        return view('profile.index', [
            'users' => $users
        ]);
    }

    public function edit()
    {
        return view('profile.edit', array('user' => auth()->user()));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

        // Upload image
        $image_path = $request->file('image_path');
        if ($image_path) {
            // Unique filename
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Storage in users disk the image
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // Set filename into the object
            auth()->user()->image = $image_path_name;
        }
        auth()->user()->update($request->all());
        // dd(auth()->user()->image);

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function show($nick)
    {
        $user = User::find($nick);
        return view('profile.show', ['user' => $user]);
    }

    //Function to delete the user
    public function destroy($id)
    {
        $user = User::find($id);
        $comments = Comment::where('user_id', $id)->get();
        $likes = Like::where('user_id', $id)->get();
        $images = Image::where('user_id', $id)->get();

        // If profile image of user is different than default, delete from disk to save local space
        if ($user->image != 'default.jpg') {
            Storage::disk('users')->delete($user->image);
        }

        // If user can delete the user
        if (Auth::user()->id == $user->id) {
            // Delete all comments of user
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
        }
        return redirect('/profile')->with('success', 'User has been deleted');
    }

    // Delete and set to default the profile image
    public function deleteImageProfile($id)
    {
        $user = User::find($id);
        // If profile image of user is different than default, delete from disk to save local space
        if ($user->image != 'default.jpg') {
            Storage::disk('users')->delete($user->image);
        }
        // Delete user image from database
        $user->image = '';
        $user->save();
        return back()->withStatus(__('Image successfully deleted.'));
    }
}
