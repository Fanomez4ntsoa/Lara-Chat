<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new NewMessage($message))->toOthers();
        return response()->json(['success' => true]);
    }

    public function getMessages()
    {
        $messages = Message::with('user')->latest()->limit(10)->get();
        return response()->json($messages);
    }
}
