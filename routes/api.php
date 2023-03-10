<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('posts', PostController::class);
// Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

// Route::post("login",[UserController::class,'index']);

Route::post("send-sms",[UserController::class,'sendSMS']);

// Route::post('/auth/register', [AuthController::class, 'createUser']);
// Route::post('/auth/login', [AuthController::class, 'loginUser']);



