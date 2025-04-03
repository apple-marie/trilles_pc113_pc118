<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;

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
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'delete']);
    Route::post('/students/login', [StudentController::class, 'login']);

    Route::get('/employees', [EmployeeController::class, 'employee']);
    Route::get('/employees/search', [EmployeeController::class, 'search']);
    Route::post('/employees', [EmployeeController::class, 'create']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'delete']);
    Route::post('/employees/login', [EmployeeController::class, 'login']);


// });