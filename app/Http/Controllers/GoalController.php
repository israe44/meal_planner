<?php

namespace App\Http\Controllers;
use App\Models\Goal;
use Illuminate\Http\Request;


class GoalController extends Controller
{
    public function index () {
$goal = Goal::all(); //get all goals from db
return response()->json($goal);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $goal = Goal::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);
        return response()->json($goal, 201); //201 created
    }

    public function show($id) {
        $goal = Goal::findOrFail($id); // returns 404 automatically if not found
        return response()->json($goal);
    }
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
        ]);

        $goal = Goal::findOrFail($id);
        $goal->update($validated);
        return response()->json($goal);
    }
    public function destroy($id) {
        $goal = Goal::findOrFail($id);
        $goal->delete();
        return response()->json(['message' => 'Goal deleted successfully']);
    }
}
