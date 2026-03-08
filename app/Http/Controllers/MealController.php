<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index() {
        $meals = Meal::with('ingredients')->get();
        return response()->json($meals);
    }
#shorcut for validation : $meal = Meal::create($request->validated());
    public function store (Request $request) { //$request is a package that will have all data sent by user
        $request->validate([
            'name' => 'required|string|max:255', //max 255 characters
            'description' => 'nullable|string', //can be empty
            'category' => 'required|in:breakfast,lunch,dinner,snack', //must be one of these values
            'user_id' => 'required|exists:users,id', //must exists in users table
        ]);
        $meal = Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => $request->user_id,
        ]);
        return response()->json($meal);
        
    }

    public function show ($id) {
        $meal = Meal::with('ingredients', 'user')->find($id);
        return response()->json($meal);
    }


    public function update (Request $request, $id) {
        $validated=$request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'sometimes|required|in:breakfast,lunch,dinner,snack',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);
        $meal = Meal::find($id);
        $meal->update($validated);
        return response()->json($meal);
    }

    public function destroy ($id) {
        $meal = Meal::find($id);
        $meal->delete();
        return response()->json(['message' => 'Meal deleted successfully']);
    }
}
