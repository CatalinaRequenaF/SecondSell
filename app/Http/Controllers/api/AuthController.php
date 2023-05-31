<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Sanctum;

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
        ]);
        $user = new \App\Models\User([
            'name'     => $request->name,
            'lastname'     => $request->lastname,
            'username'     => $request->username,


            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Usuario creado satisfactoriamente!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            // 'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Correo o contraseña incorrectos'
            ], 401);
        }
        
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'status'=>true,
            'message'=>'Usuario loggeado satisfactoriamente',
            'data' => $user,
            'token' => $user->createToken('bearer Token')->plainTextToken], 200);
       
    }
    



    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
        'Has salido de la sesión satisfactoriamente']);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
