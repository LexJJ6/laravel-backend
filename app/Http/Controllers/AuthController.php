<?php

// namespace App\Http\Controllers;

// use App\Http\Requests\LoginAuthRequest;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class AuthController extends Controller
// {
//     public function login(LoginAuthRequest $request)
//     {
//         $data = $request->validated();

//         if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
//         {
//             $request->session()->regenerate();

//             // $user = Auth::user();
//             // $token = $user->createToken('Challenge')->plainTextToken;

//             return response()->json([
//                 'message' => 'Login efetuado com sucesso',
//                 'user' => Auth::user(),
//                 // 'token' => $token
//             ], 200);
//         }

//         return response()->json([
//             'message' => 'Email ou palavra-passe errados'
//         ], 401);
//     }

//     public function logout(Request $request)
//     {
//         // $request->user()->currentAccessToken()->delete();
//         // $request->user()->tokens()->each(function ($token) {
//         //     $token->delete();
//         // });

//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return response()->json([
//             'message' => 'Logout efetuado com sucesso'
//         ], 200);
//     }
// }

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email ou palavra-passe errados'
            ], 401);
        }

        $token = $user->createToken('Challenge')->plainTextToken;

        return response()->json([
            'message' => 'Login efetuado com sucesso',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout efetuado com sucesso'
        ], 200);
    }
}