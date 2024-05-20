<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes d'authentification
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Routes des publications
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store'])->middleware('auth:api');
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth:api');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth:api');

// Routes des commentaires
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware('auth:api');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth:api');

// Routes des utilisateurs
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:api');


