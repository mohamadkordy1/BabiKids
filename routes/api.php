<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\childrenController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProgressController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\StaffController;


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

route::get('/Attendance',[AttendanceController::class, 'index']);
route::get('/Attendance/{id}',[AttendanceController::class, 'show']);
route::post('/Attendance',[AttendanceController::class, 'store']);
route::put('/Attendance/{id}',[AttendanceController::class, 'update']);
route::delete('/Attendance/{id}',[AttendanceController::class, 'destroy']);

route::get('/children',[childrenController::class, 'index']);
route::get('/children/{id}',[childrenController::class, 'show']);
route::post('/children',[childrenController::class, 'store']);
route::put('/children/{id}',[childrenController::class, 'update']);
route::delete('/children/{id}',[childrenController::class, 'destroy']);

route::get('/Payment',[PaymentController::class, 'index']);
route::get('/Payment/{id}',[PaymentController::class, 'show']);
route::post('/Payment',[PaymentController::class, 'store']);
route::put('/Payment/{id}',[PaymentController::class, 'update']);
route::delete('/Payment/{id}',[PaymentController::class, 'destroy']);

route::get('/Progress',[ProgressController::class, 'index']);
route::get('/Progress/{id}',[ProgressController::class, 'show']);
route::post('/Progress',[ProgressController::class, 'store']);
route::put('/Progress/{id}',[ProgressController::class, 'update']);
route::delete('/Progress/{id}',[ProgressController::class, 'destroy']);

route::get('/Report',[ReportController::class, 'index']);
route::get('/Report/{id}',[ReportController::class, 'show']);
route::post('/Report',[ReportController::class, 'store']);
route::put('/Report/{id}',[ReportController::class, 'update']);
route::delete('/Report/{id}',[ReportController::class, 'destroy']);

route::get('/Staff',[StaffController::class, 'index']);
route::get('/Staff/{id}',[StaffController::class, 'show']);
route::post('/Staff',[StaffController::class, 'store']);
route::put('/Staff/{id}',[StaffController::class, 'update']);
route::delete('/Staff/{id}',[StaffController::class, 'destroy']);

