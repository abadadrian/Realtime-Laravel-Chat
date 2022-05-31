<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;



class ImageController extends Controller
{

    //Access Control Only Auth
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        // Return view for create image
        return view('image.create');
    }

    public function store(Request $request)
    {

        //Validación
        $validate = $this->validate($request, [
            'image_path'  => 'required|image'
        ]);

        // Recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Asignar valores nuevo objeto
        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        // Subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        // Save attributes to image object
        $image->save();
        // Redirect to home
        return redirect('/home')->with('success', 'Image Uploaded');
    }

    // Get image from disk
    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    //Recieve id of the image I want to see
    public function detail($id)
    {
        $image = Image::find($id);
        return view('image.detail', ['image' => $image]);
    }

    public function edit($id)
    {
        // Get auth user
        $user = Auth::user();
        // Get image
        $image = Image::find($id);
        // Check if user is the owner of the image or role admin
        if ($user && ($user->id == $image->user_id || $user->role == 'ADMIN')) {
            return view('image.edit', ['image' => $image]);
        } else {
            return redirect('/home')->with('error', 'Unauthorized');
        }
    }

    public function update(Request $request)
    {
        //Validate
        $validate = $this->validate($request, [
            'image_path'  => 'image'
        ]);

        // Get data
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Get image object
        $image = Image::find($image_id);
        $image->description = $description;

        // Upload files
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        // Update
        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id])
            ->withStatus(__('Image successfully updated.'));
    }

    //Function to delete the image and its comments
    public function delete($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        // Search all comments and likes of the image
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        // Check you can delete the image
        if ($user && $image && $image->user->id == $user->id || Auth::user()->role == 'admin') {
            // Delete all comments
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            // Delete all likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            // Delete image from storage
            Storage::disk('images')->delete($image->image_path);

            // Delete image
            $image->delete();
            // Redirect to home
            return redirect('/home')->with('success', 'Image Deleted');
        } else {
            return redirect('/home')->with('error', 'Unauthorized action');
        }
    }
}
