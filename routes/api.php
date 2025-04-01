<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

// API Routes
Route::get('/users', [UserController::class, 'users']);

// Fallback for API routes
Route::fallback(function () {
    return response()->json(['error' => 'API endpoint not found'], 404);
}); 