<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\MealPlanController;

Route::middleware('auth:sanctum')->group(function(){

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/meals', [MealController::class, 'index']);
Route::post('/meals', [MealController::class, 'store']);
Route::get('/meals/{id}', [MealController::class, 'show']);
Route::put('/meals/{id}', [MealController::class, 'update']);
Route::delete('/meals/{id}', [MealController::class, 'destroy']);

//Ingredient routes
Route::get('/ingredients', [IngredientController::class, 'index']);
Route::post('/ingredients', [IngredientController::class, 'store']);
Route::get('/ingredients/{id}', [IngredientController::class, 'show']);
Route::put('/ingredients/{id}', [IngredientController::class, 'update']);
Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy']);
});


//AUTH routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// GOAL routes
Route::get('/goals', [GoalController::class, 'index']);
Route::post('/goals', [GoalController::class, 'store']);
Route::get('/goals/{id}', [GoalController::class, 'show']);
Route::put('/goals/{id}', [GoalController::class, 'update']);
Route::delete('/goals/{id}', [GoalController::class, 'destroy']);

// MEAL PLANNER routes
Route::get('/meal-plans', [MealPlannerController::class, 'index']);
Route::post('/meal-plans', [MealPlannerController::class, 'store']);
Route::get('/meal-plans/{id}', [MealPlannerController::class, 'show']);
Route::put('/meal-plans/{id}', [MealPlannerController::class, 'update']);
Route::delete('/meal-plans/{id}', [MealPlannerController::class, 'destroy']);
