<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    // Function constructor with middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Function to store a comment into the image
    public function store(Request $request)
    {
        // Validate the request
        $validate = $this->validate($request, [
            'image_id' => 'required|integer',
            'content' => 'required|string'
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->image_id = $request->input('image_id');
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;

        // Save the comment
        $comment->save();

        // Return to detail image view
        return redirect()->route('image.detail', ['id' => $comment->image_id])
            ->with([
                'message' => 'Comment created successfully'
            ]);
    }


    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get data from Auth::user()
        $user = Auth::user();
        // Get object comment
        $comment = Comment::find($id);
        // Check if the user is the owner of the comment || admin || owner of the image
        if ($user && ($comment->user_id == $user->id || $user->role == 'admin' || $comment->image->user_id == $user->id)) {
            // Delete the comment
            $comment->delete();
            // Return to detail image view
            return redirect()->route('image.detail', ['id' => $comment->image_id])
                ->with([
                    'message' => 'Comment deleted successfully'
                ]);
        } else {
            // Return to detail image view
            return redirect()->route('image.detail', ['id' => $comment->image_id])
                ->with([
                    'message' => 'You cannot delete this comment'
                ]);
        }
    }
}
