<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;


Route::middleware('auth:sanctum')->group(function(){

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/meals', [MealController::class, 'index']);
Route::post('/meals', [MealController::class, 'store']);
Route::get('/meals/{id}', [MealController::class, 'show']);
Route::put('/meals/{id}', [MealController::class, 'update']);
Route::delete('/meals/{id}', [MealController::class, 'destroy']);
});


//AUTH routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

