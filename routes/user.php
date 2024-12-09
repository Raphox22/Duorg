<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('users')->middleware(['auth:sanctum'])->group(function () {
    // Listagem de usuários com paginação e filtros
    Route::get('/', [UserController::class, 'list'])->name('users.list');

    // Busca de usuário por ID
    Route::get('{id}', [UserController::class, 'getById'])->name('users.getById');
});
