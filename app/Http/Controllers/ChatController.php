<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $message = $user->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new NewMessage($message))->toOthers();
        return response()->json([
            'user'      => $user,
            'success'   => $message->message
        ]);
    }

    public function getMessages()
    {
        $messages = Message::with('user')->latest()->limit(10)->get();
        return response()->json($messages);
    }
}
