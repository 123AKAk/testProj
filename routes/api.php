<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [UserController::class, 'register']); // Register
Route::post('/login', [UserController::class, 'login']); // Login

Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::post('/logout', [UserController::class, 'logout']); // Logout
    Route::get('/profile', [UserController::class, 'profile']); // User profile

    // Student routes
    Route::get('/students', [StudentController::class, 'index']); // Get all students
    Route::get('/students/{id}', [StudentController::class, 'show']); // Get a single student by ID
    Route::post('/students', [StudentController::class, 'store']); // Insert student
    Route::get('/students/search', [StudentController::class, 'search']); // Search students by name or email
});