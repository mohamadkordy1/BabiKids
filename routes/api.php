<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ActivityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('/register', [AuthController::class, 'register']);
route::post('/login', [AuthController::class, 'login']);
route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

route::get('/activities',[ActivityController::class, 'index']);
route::get('/activities/{id}',[ActivityController::class, 'show']);
route::post('/activities',[ActivityController::class, 'store']);
route::put('/activities/{id}',[ActivityController::class, 'update']);
route::delete('/activities/{id}',[ActivityController::class, 'destroy']);