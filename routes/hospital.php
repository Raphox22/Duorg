<?php

use App\Http\Controllers\HospitalController;
use Illuminate\Support\Facades\Route;

Route::apiResource('hospitals', HospitalController::class)->middleware('auth:sanctum');
