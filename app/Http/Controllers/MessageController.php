<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //

    public function index($id)
    {
        $currentUserId = auth()->guard('login')->user()->id;
        $messages = Message::where(function($query) use ($id, $currentUserId) {
            $query->where('sender_id', $currentUserId)->where('receiver_id', $id);
        })->orWhere(function($query) use ($id, $currentUserId) {
            $query->where('sender_id', $id)->where('receiver_id', $currentUserId);
        })->orderBy('created_at', 'asc')->get();

        $email = auth()->guard('login')->user()->email;
        $usersLogin = Login::all();
        $user = Login::findOrFail($id);
        $receiver_id = $id;
        return view('messageView.chat', compact('email', 'usersLogin', 'user', 'receiver_id', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $receiver_id = $request->input('receiver_id');
        $sender_id = auth()->guard('login')->user()->id;

        // Here you can implement the logic to save the message to the database
        // For example, you can create a new Message model and save it

        Message::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message,
        ]);

        return redirect("/chat/{$receiver_id}");
    }
}
