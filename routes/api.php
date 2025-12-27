<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\ChildrenController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProgressController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\StaffController;
use App\Http\Controllers\API\UserController;

use App\Http\Controllers\API\ClassroomController;


// Public routes
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

// Protected routes (requires authentication)
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {

    // Current authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Activities
    Route::middleware([RoleMiddleware::class . ':admin,teacher,parent'])->group(function () {
        Route::get('/activities', [ActivityController::class, 'index']);
        Route::get('/activities/{id}', [ActivityController::class, 'show']);
    });
    Route::middleware([RoleMiddleware::class . ':admin,teacher'])->group(function () {
        Route::post('/activities', [ActivityController::class, 'store']);
        Route::put('/activities/{id}', [ActivityController::class, 'update']);
    });
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::delete('/activities/{id}', [ActivityController::class, 'destroy']);
    });

    // Attendance
    Route::middleware([RoleMiddleware::class . ':admin,teacher,parent'])->group(function () {
        Route::get('/attendance', [AttendanceController::class, 'index']);
        Route::get('/attendance/{id}', [AttendanceController::class, 'show']);
    });
    Route::middleware([RoleMiddleware::class . ':admin,teacher'])->group(function () {
        Route::post('/attendance', [AttendanceController::class, 'store']);
        Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
    });
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);
    });


    

    // Children
    Route::middleware([RoleMiddleware::class . ':admin,teacher,parent'])->group(function () {
        Route::get('/children', [ChildrenController::class, 'index']);
        Route::get('/children/{id}', [ChildrenController::class, 'show']);
   Route::get('/children/{id}/classrooms', [ChildrenController::class, 'classrooms']);
 });




    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::post('/children', [ChildrenController::class, 'store']);
        Route::put('/children/{id}', [ChildrenController::class, 'update']);
        Route::delete('/children/{id}', [ChildrenController::class, 'destroy']);
    });

    // Payments
    Route::middleware([RoleMiddleware::class . ':admin,parent'])->group(function () {
        Route::get('/payments', [PaymentController::class, 'index']);
        Route::get('/payments/{id}', [PaymentController::class, 'show']);
    });
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::post('/payments', [PaymentController::class, 'store']);
        Route::put('/payments/{id}', [PaymentController::class, 'update']);
        Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);
    });

    // Progress
    Route::middleware([RoleMiddleware::class . ':admin,teacher,parent'])->group(function () {
        Route::get('/progresses', [ProgressController::class, 'index']);
        Route::get('/progresses/{id}', [ProgressController::class, 'show']);
    });
    Route::middleware([RoleMiddleware::class . ':admin,teacher'])->group(function () {
        Route::post('/progresses', [ProgressController::class, 'store']);
        Route::put('/progresses/{id}', [ProgressController::class, 'update']);
    });
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::delete('/progresses/{id}', [ProgressController::class, 'destroy']);
    });

    // Reports
    Route::middleware([RoleMiddleware::class . ':admin,teacher,parent'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index']);
        Route::get('/reports/{id}', [ReportController::class, 'show']);
    });
    Route::middleware([RoleMiddleware::class . ':admin,teacher'])->group(function () {
        Route::post('/reports', [ReportController::class, 'store']);
        Route::put('/reports/{id}', [ReportController::class, 'update']);
    });
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::delete('/reports/{id}', [ReportController::class, 'destroy']);
    });

    // Staff (admin only)
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/staff', [StaffController::class, 'index']);
        Route::get('/staff/{id}', [StaffController::class, 'show']);
        Route::post('/staff', [StaffController::class, 'store']);
        Route::put('/staff/{id}', [StaffController::class, 'update']);
        Route::delete('/staff/{id}', [StaffController::class, 'destroy']);
    });

    // Users (admin only)
    Route::middleware([RoleMiddleware::class . ':admin,teacher,parent'])->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });

  Route::get('/classrooms', [ClassroomController::class, 'index']);          // List all classrooms
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show']);      // Show single classroom
    Route::post('/classrooms', [ClassroomController::class, 'store']);         // Create a classroom
    Route::put('/classrooms/{id}', [ClassroomController::class, 'update']);    // Update classroom
    Route::delete('/classrooms/{id}', [ClassroomController::class, 'destroy']); // Delete classroom

    // Manage children in classroom (pivot table)
    Route::post('/classrooms/{id}/add-children', [ClassroomController::class, 'addChildren']);       // Attach children
    Route::post('/classrooms/{id}/remove-children', [ClassroomController::class, 'removeChildren']); // Detach children
    Route::get('/classrooms/{id}/children', [ClassroomController::class, 'listChildren']);           // List children



});
