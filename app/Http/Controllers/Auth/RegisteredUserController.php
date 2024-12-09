<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class RegisteredUserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        // Validação inicial
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'type' => 'required|in:ADMIN,DOADOR,RECEPTOR',
            'cpf' => 'required|string|size:11|unique:users,cpf',
            'address.street' => 'required|string|max:255',
            'address.number' => 'nullable|string|max:10',
            'address.city' => 'required|string|max:255',
            'address.state' => 'required|string|max:2',
            'address.zipcode' => 'nullable|string|max:10',
        ]);

        // Validações adicionais para tipos específicos
        if ($validated['type'] === 'DOADOR') {
            $additionalRules = [
                'blood_type' => 'required|string|max:3',
                'rh_factor' => 'required|in:+,-',
            ];
            $validated = array_merge($validated, $request->validate($additionalRules));
        } elseif ($validated['type'] === 'RECEPTOR') {
            $additionalRules = [
                'blood_type' => 'required|string|max:3',
                'rh_factor' => 'required|in:+,-',
                'required_organ' => 'nullable|string|max:255',
            ];
            $validated = array_merge($validated, $request->validate($additionalRules));
        }

        // Criação do usuário
        $user = $this->userService->createUser($validated);

        // Retorno da resposta
        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
            ],
        ], 201);
    }

    public function list(Request $request)
    {
        return response()->json($this->userService->filterUsers($request));
    }
}