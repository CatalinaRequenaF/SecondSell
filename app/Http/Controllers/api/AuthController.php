<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'lastname'     => 'required|string',
            'username'     => 'required|string',

            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);        $user = new \App\Models\User([
            'name'     => $request->name,
            'lastname'     => $request->lastname,
            'username'     => $request->username,


            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);        $user->save();        return response()->json([
            'message' => 'Usuario creado satisfactoriamente!'], 201);
    }    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
           // 'remember_me' => 'boolean',
        ]);        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }        $token->save();        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();        return response()->json(['message' => 
            'Has salido de la sesión satisfactoriamente']);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

