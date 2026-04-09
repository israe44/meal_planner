<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index() {
        $meals = Meal::with('ingredients')->where('user_id', auth()->id())->get(); // only return the logged-in user's meals
        return response()->json($meals);
    }
#shorcut for validation : $meal = Meal::create($request->validated());_è
    public function store (Request $request) { //$request is a package that will have all data sent by user
        $request->validate([
            'name' => 'required|string|max:255', //max 255 characters
            'description' => 'nullable|string', //can be empty
            'category' => 'required|in:breakfast,lunch,dinner,snack', //must be one of these values
        ]);
        $meal = Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => auth()->id(), // always use the logged-in user's id, never trust user input for this
        ]);
        return response()->json($meal);
        
    }

    public function show ($id) {
        $meal = Meal::with('ingredients', 'user')->findOrFail($id); // returns 404 automatically if not found
        if ($meal->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($meal);
    }


    public function update (Request $request, $id) {
        $validated=$request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'sometimes|required|in:breakfast,lunch,dinner,snack',
        ]);
        $meal = Meal::findOrFail($id); // returns 404 automatically if not found
        if ($meal->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $meal->update($validated);
        return response()->json($meal);
    }

    public function destroy ($id) {
        $meal = Meal::findOrFail($id); // returns 404 automatically if not found
        if ($meal->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $meal->delete();
        return response()->json(['message' => 'Meal deleted successfully']);
    }
}
