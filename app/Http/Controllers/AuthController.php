<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(!Auth::attempt(
            $request->only('email','password')
        )){
            return response()
            ->json(['msg' => 'Unauthorized'], 401);
        }
        $user = User::where('email',$request->email)->firstOrFail();

        $token = $user->createToken('auth-sanctum')->plainTextToken;

        return response([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return response()->json([
            'msg' => 'Logout berhasil'
        ]);
    }
}
