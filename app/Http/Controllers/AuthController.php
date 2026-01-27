<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = Auth::user();
            $token = $user->createToken('Challenge')->plainTextToken;

            return response()->json([
                'message' => 'Login efetuado com sucesso',
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'Email ou palavra-passe errados'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Logout efetuado com sucesso'
        ]);
    }
}
