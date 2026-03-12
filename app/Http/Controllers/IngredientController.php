<?php

namespace App\Http\Controllers;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index() {
        $ingredients = Ingredient::all();
        return response()->json($ingredients);
    }

    public function store(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'unit'     => 'required|in:grams,ml,pieces',
        ]);

        $ingredient = Ingredient::create([
            'name'     => $request->name,
            'calories' => $request->calories,
            'unit'     => $request->unit,
        ]);

        return response()->json($ingredient, 201); 
    }

    public function show($id) {
        $ingredient = Ingredient::with('meals')->findOrFail($id);
        return response()->json($ingredient);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'calories' => 'sometimes|required|integer|min:0',
            'unit'     => 'sometimes|required|in:grams,ml,pieces',
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($validated);
        return response()->json($ingredient);
    }

    public function destroy($id) {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}

