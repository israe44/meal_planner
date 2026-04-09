<?php

namespace App\Http\Controllers;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    
    public function index() {
        $mealPlans = MealPlan::where('user_id', auth()->id())
                             ->with('meal')
                             ->get();
        return response()->json($mealPlans);
    }

    public function store(Request $request) {

        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'date'    => 'required|date',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
        ]);


        $mealPlan = MealPlan::create([
            'user_id' => auth()->id(),
            'meal_id' => $request->meal_id,
            'date'    => $request->date,
            'meal_type' => $request->meal_type,
        ]);

        return response()->json($mealPlan, 201);
    }
    public function show($id) {
        $mealPlan = MealPlan::with('meal', 'user')->findOrFail($id);
        if ($mealPlan->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($mealPlan);
    }

    public function update(Request $request, $id) {

        $validated = $request->validate([
            'meal_id' => 'sometimes|required|exists:meals,id', //sometimes means it's optional, but if provided it must be valid
            'date'    => 'sometimes|required|date',
            'meal_type' => 'sometimes|required|in:breakfast,lunch,dinner,snack',
        ]);

        $mealPlan = MealPlan::findOrFail($id);
        if ($mealPlan->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $mealPlan->update($validated);

        return response()->json($mealPlan);
    }
    public function destroy($id) {
        $mealPlan = MealPlan::findOrFail($id);
        if ($mealPlan->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $mealPlan->delete();

        return response()->json(['message' => 'Meal plan deleted successfully']);
    }
}