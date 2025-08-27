<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\ChildrenController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProgressController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\StaffController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {


route::post('/register', [AuthController::class, 'register']);
route::post('/login', [AuthController::class, 'login']);
route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

route::get('/activities',[ActivityController::class, 'index']);
route::get('/activities/{id}',[ActivityController::class, 'show']);
route::post('/activities',[ActivityController::class, 'store']);
route::put('/activities/{id}',[ActivityController::class, 'update']);
route::delete('/activities/{id}',[ActivityController::class, 'destroy']);


route::get('/attendance',[AttendanceController::class, 'index']);
route::get('/attendance/{id}',[AttendanceController::class, 'show']);
route::post('/attendance',[AttendanceController::class, 'store']);
route::put('/attendance/{id}',[AttendanceController::class, 'update']);
route::delete('/attendance/{id}',[AttendanceController::class, 'destroy']);

route::get('/children',[ChildrenController::class, 'index']);
route::get('/children/{id}',[ChildrenController::class, 'show']);
route::post('/children',[ChildrenController::class, 'store']);
route::put('/children/{id}',[ChildrenController::class, 'update']);
route::delete('/children/{id}',[ChildrenController::class, 'destroy']);

route::get('/payments',[PaymentController::class, 'index']);
route::get('/payments/{id}',[PaymentController::class, 'show']);
route::post('/payments',[PaymentController::class, 'store']);
route::put('/payments/{id}',[PaymentController::class, 'update']);
route::delete('/payments/{id}',[PaymentController::class, 'destroy']);

route::get('/progresses',[ProgressController::class, 'index']);
route::get('/progresses/{id}',[ProgressController::class, 'show']);
route::post('/progresses',[ProgressController::class, 'store']);
route::put('/progresses/{id}',[ProgressController::class, 'update']);
route::delete('/progresses/{id}',[ProgressController::class, 'destroy']);

route::get('/reports',[ReportController::class, 'index']);
route::get('/reports/{id}',[ReportController::class, 'show']);
route::post('/reports',[ReportController::class, 'store']);
route::put('/reports/{id}',[ReportController::class, 'update']);
route::delete('/reports/{id}',[ReportController::class, 'destroy']);

route::get('/staff',[StaffController::class, 'index']);
route::get('/staff/{id}',[StaffController::class, 'show']);
route::post('/staff',[StaffController::class, 'store']);
route::put('/staff/{id}',[StaffController::class, 'update']);
route::delete('/staff/{id}',[StaffController::class, 'destroy']);
});
