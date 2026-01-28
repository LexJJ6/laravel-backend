<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request)
    {
        $data = $request->validated();

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            $user = Auth::user();
            $token = $user->createToken('Challenge')->plainTextToken;

            return response()->json([
                'message' => 'Login efetuado com sucesso',
                'token' => $token
            ], 200);
        }

        return response()->json([
            'message' => 'Email ou palavra-passe errados'
        ], 401);
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Logout efetuado com sucesso'
        ], 200);
    }
}
