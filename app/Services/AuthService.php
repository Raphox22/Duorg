<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        
        if (!Auth::attempt($credentials)) {
            abort(401, 'Credenciais inválidas.');
        }

        // Gere um token para o usuário autenticado
        $user = Auth::user();
        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user,
        ];
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete(); // Revoga todos os tokens do usuário
        return ['message' => 'Logout realizado com sucesso.'];
    }
};