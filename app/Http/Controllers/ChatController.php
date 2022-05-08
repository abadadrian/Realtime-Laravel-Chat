<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import MessageSent class
use App\Events\MessageSent;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChat()
    {
        return view('chat.show');
    }

    public function messageReceived(Request $request)
    {
        // Define rules for the request
        $rules = [
            'message' => 'required',
        ];
        // Validate the request
        $this->validate($request, $rules);
        // Return the event MessageSent
        broadcast(new MessageSent($request->user(), $request->message));
        // Return response to json
        return response()->json('Message broadcasted');
    }
}
