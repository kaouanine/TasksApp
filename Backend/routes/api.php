<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return $request->user()->id; });
Route::post('/registre', [UserController::class, 'register'])->name("R_register");
Route::post('/login', [UserController::class, 'login'])->name("R_login");
Route::middleware(['sanctum.auth','auth:sanctum'] )->post('/storeTask', [TasksController::class, 'storeTasks'])->name("R_storeTask");

Route::middleware('auth:sanctum')->get('/getTask', [TasksController::class, 'getTasks'])->name("R_getTask");
Route::middleware('auth:sanctum')->delete('/deleteTask/{id}', [TasksController::class, 'deleteTasks'])->name("R_deleteTask");
Route::middleware(['auth:sanctum','sanctum.auth'])->put('/completeTask/{id}', [TasksController::class, 'completeTask'])->name("R_completeTask");
