<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    //He realizado las validaciones aquí pero no tiene por qué (middleware auth en la ruta). En realidad eventualmente habría que separarlo
    //en archivos Request.
    public function index()
    {
        $user = Auth::user();
        $chats = $user->chats;
        return response()->json($chats);
    }

    public function show($id)
    {
        $user = Auth::user();
        $chat = $user->chats()->find($id);
        if (!$chat) {
            return response()->json(['message' => 'Chat not found'], 404);
        }
        return response()->json($chat);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'message' => 'required'
        ]);

        $chat = $user->chats()->create($validatedData);

        return response()->json($chat, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $chat = $user->chats()->find($id);
        if (!$chat) {
            return response()->json(['message' => 'Chat not found'], 404);
        }

        $validatedData = $request->validate([
            'message' => 'required'
        ]);

        $chat->update($validatedData);

        return response()->json($chat);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $chat = $user->chats()->find($id);
        if (!$chat) {
            return response()->json(['message' => 'Chat not found'], 404);
        }

        $chat->delete();

        return response()->json(['message' => 'Chat deleted']);
    }
}
