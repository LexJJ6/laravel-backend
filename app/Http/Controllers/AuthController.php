<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return response()->json([
                'message' => 'Login efetuado com sucesso'
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        // adicionar funcionalidade de logout em todos os dispositivos como já tive
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout efetuado com sucesso'
        ], 200);
    }
}