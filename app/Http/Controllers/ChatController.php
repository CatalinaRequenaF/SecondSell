<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chatHistory;

    public function __construct()
    {
        $this->chatHistory = [];
    }

    public function addMessage(Request $request)
    {
        $user = $request->input('user');
        $message = $request->input('message');

        $this->chatHistory[] = [
            'user' => $user,
            'message' => $message,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Message added successfully.',
        ]);
    }

    public function getChatHistory()
    {
        return response()->json($this->chatHistory);
    }
}
