<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'E-mail ou senha invalido!'
            ], 400);
        }

        return response()->json([
            'message' => 'Login realiado com sucesso!',
            'data' => [
                'user' => $user,
                'token' => $user->createToken('access_token')->plainTextToken
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'ok',
            'message' => 'Logged out!'
        ]);
    }

    // A classe RegisterRequest validara as informações enviadas pelo front
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] =  Hash::make($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'data' => [
                'user' => $user,
                'token' => $user->createToken('access_token')->plainTextToken
            ]
        ], 201);
    }

    public function verifyToken(Request $request)
    {
        return $request->user();
    }
}
