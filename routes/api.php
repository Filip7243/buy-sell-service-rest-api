<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('logout', [AuthController::class, 'logout']);

//    Route::get('categories', [CategoryController::class, 'index']);
//    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::apiResource('categories', CategoryController::class);
});

