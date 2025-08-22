<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProjectController,TaskController,UserController};
use App\Http\Controllers\AuthController;

Route::apiResource('projects', ProjectController::class);
Route::post('projects/{id}/restore', [ProjectController::class, 'restore']);
Route::delete('projects/{id}/force', [ProjectController::class, 'forceDelete']);

Route::apiResource('tasks', TaskController::class);
Route::post('tasks/{id}/restore', [TaskController::class, 'restore']);
Route::delete('tasks/{id}/force', [TaskController::class, 'forceDelete']);

Route::apiResource('users', UserController::class);
Route::post('users/{id}/restore', [UserController::class, 'restore']);
Route::delete('users/{id}/force', [UserController::class, 'forceDelete']);

Route::post('/login', [AuthController::class, 'login']);

?>