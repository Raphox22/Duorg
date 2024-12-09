<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Realiza o login e retorna o token de autenticação.
     */
    public function store(Request $request): JsonResponse
    {
        $result = $this->authService->login($request);

        return response()->json([
            'token' => $result['token'],
            'user' => $result['user'],
        ], 200);
    }

    /**
     * Realiza o logout e revoga o token do usuário.
     */
    public function destroy(Request $request): JsonResponse
    {
        $this->authService->logout($request);

        return response()->json([
            'message' => 'Logout realizado com sucesso.',
        ], 200);
    }
}