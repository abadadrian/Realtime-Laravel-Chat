<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Function constructor with middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        // Order by likes
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function like($image_id)
    {
        // Get user and image data
        $user = Auth::user();

        // Check if the user already liked the image
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();
        // Make Like object
        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            // Save the like
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'You already like the image'
            ]);
        }
    }


    public function dislike($image_id)
    {
        // Get user and image data
        $user = Auth::user();

        // Check if the user already liked the image
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();
        // Make Like object
        if ($like) {
            // Delete the like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'You do not like the image anymore'
            ]);
        } else {
            return response()->json([
                'message' => 'Like not found'
            ]);
        }
    }
}
