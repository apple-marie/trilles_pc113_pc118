<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileUploadController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
 
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::post('/setup', [UserController::class, 'setupUser']);
Route::post('/save', [UserController::class, 'savePassword']);

Route::post('/users/login', [UserController::class,'login']);
Route::get('/users/logout', [UserController::class,'logout']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
Route::post('/reset-password', [UserController::class, 'resetPassword']);
Route::post('/setup/student', [StudentController::class, 'setupStudent']);

Route::middleware('auth:sanctum')->group(function() {
    // user
    Route::get('/users',[UserController::class,'index']);
    Route::post('/user',[UserController::class,'create']);
    Route::post('/user/update',[UserController::class,'update']);
    Route::post('/user/delete',[UserController::class,'delete']);
    Route::get('/get/user', [UserController::class, 'getUser']);

    Route::get('/students', [StudentController::class, 'index']);
    // Route::middleware('allowed.roles')->group(function (){
        Route::get('/students/search', [StudentController::class, 'search']);
        Route::post('/create', [StudentController::class, 'create']);
        Route::post('/update', [StudentController::class, 'update']);
        Route::post('/delete', [StudentController::class, 'delete']);
        Route::post('/students/login', [StudentController::class, 'login']);
        Route::post('/get/student', [StudentController::class, 'getStudent']);
    
    
        Route::get('/course', [CourseController::class, 'getCourse']);
        Route::post('/course', [CourseController::class, 'create']);
        Route::post('/course/update', [CourseController::class, 'update']);
        Route::post('/course/delete', [CourseController::class, 'delete']);
});



    


// });