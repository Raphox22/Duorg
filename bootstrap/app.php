<?php

use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([\Illuminate\Session\Middleware\StartSession::class]);
        $middleware->use([\App\Http\Middleware\CorsMiddleware::class]);
        $middleware->alias([
            'verified' => EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception) {
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json(['message' => $exception->getMessage()], 422);
            }
            if ($exception instanceof \Illuminate\Database\QueryException) {
                return response()->json(['message' => "Erro de servidor. Comunique o administrador!"], 500);
            }

            return response()->json(['message' => $exception->getMessage()], 500);
        });
    })->create();
