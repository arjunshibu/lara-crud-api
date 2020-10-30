<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::post('users/signup', [AuthController::class, 'signup']);
Route::post('users/login', [AuthController::class, 'login']);
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::get('users/{id}/posts', [UserController::class, 'showPosts']);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('users/logout/current', [AuthController::class, 'logout']);
    Route::get('users/logout/all', [AuthController::class, 'logoutAll']);
    Route::post('posts', [PostController::class, 'store']);
    Route::patch('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
});