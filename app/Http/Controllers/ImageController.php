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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view for create image
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validación
        $validate = $this->validate($request, [
            'description' => 'required',
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
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
