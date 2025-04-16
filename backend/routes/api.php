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

Route::post('/users/login', [UserController::class,'login']);
Route::post('/users',[UserController::class,'create']);
Route::get('/students', [StudentController::class, 'index']);
// Route::middleware('allowed.roles')->group(function (){
    Route::get('/students/search', [StudentController::class, 'search']);
    Route::post('/students', [StudentController::class, 'create']);
    Route::post('/update', [StudentController::class, 'update']);
    Route::post('/delete', [StudentController::class, 'delete']);
    Route::post('/students/login', [StudentController::class, 'login']);


    Route::get('/course', [CourseController::class, 'getCourse']);
    Route::post('/course', [CourseController::class, 'create']);
    Route::post('/course/update', [CourseController::class, 'update']);
    Route::post('/course/delete', [CourseController::class, 'delete']);

    
    Route::post('/fileupload', [FileUploadController::class, 'fileUpload']);
    Route::get('/fileuploads', [FileUploadController::class, 'index']);

// });