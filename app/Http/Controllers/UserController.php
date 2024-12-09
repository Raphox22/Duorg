<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * List all users with optional filtering by type.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'type' => 'nullable|in:ADMIN,RECEPTOR,DOADOR',
            'organ' => 'nullable|string',
            'per_page' => 'integer|min:1|max:100',
            'page' => 'integer|min:1',
        ]);
    
        $type = $request->input('type');
        $organ = $request->input('organ');
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);
    
        $query = User::query();
    
        if ($type) {
            $query->where('type', $type);
        }
    
        if ($organ) {
            $query->whereHas('MedicalInfo', function ($query) use ($organ) {
                $query->where('organs_to_donate', 'like', "%{$organ}%");
            });
        }
    
        $users = $query->paginate($per_page, ['*'], 'page', $page);
    
        return response()->json([
            'data' => $users->items(),
            'meta' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
            ],
        ]);
    }

    /**
     * Get user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(int $id): \Illuminate\Http\JsonResponse
    {
        $queryUser = User::query();

        $user = $queryUser->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        switch ($user->type) {
            case 'DOADOR':
                $user->load('MedicalInfo');
                break;
            case 'RECEPTOR':
                $user->load('MedicalInfo');
                break;
        }

        return response()->json($user);
    }

    public function store(Request $request, UserService $userService)
    {
        $data = $request->all();
    
        // Validação básica
        $baseRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => 'required|in:ADMIN,RECEPTOR,DOADOR',
        ];
    
        // Validação condicional
        $additionalRules = [];
        if ($request->input('type') === 'RECEPTOR') {
            $additionalRules = [
                'blood_type' => 'required|string|max:3',
                'rh_factor' => 'required|string|max:3',
                'required_organ' => 'required|string|max:255',
                'address.street' => 'required|string|max:255',
                'address.city' => 'required|string|max:255',
                'address.state' => 'required|string|max:2',
            ];
        } elseif ($request->input('type') === 'DOADOR') {
            $additionalRules = [
                'blood_type' => 'required|string|max:3',
                'rh_factor' => 'required|string|max:3',
                'organs_to_donate' => 'required|array',
                'organs_to_donate.*' => 'string|max:255',
                'address.street' => 'required|string|max:255',
                'address.city' => 'required|string|max:255',
                'address.state' => 'required|string|max:2',
            ];
        }
    
        // Combine as regras
        $rules = array_merge($baseRules, $additionalRules);
    
        // Validar entrada
        $validatedData = $request->validate($rules);
    
        // Criar o usuário
        $user = $userService->createUser($validatedData);
    
        return response()->json([
            'message' => 'User created successfully!',
            'data' => $user,
        ], 201);
    }

}
